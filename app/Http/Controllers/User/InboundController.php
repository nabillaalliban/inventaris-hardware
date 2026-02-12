<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboundController extends Controller {
  public function index(){
    $logs = ItemInbound::with('item')->where('user_id',auth()->id())->latest()->get();
    return view('user.inbounds.index', compact('logs'));
  }

  public function create(){
    $items = Item::orderBy('nama_barang')->get();
    return view('user.inbounds.create', compact('items'));
  }

  public function store(Request $r){
    $r->validate([
      'item_id'=>'required|exists:items,id',
      'qty_masuk'=>'required|integer|min:1',
      'tanggal_masuk'=>'required|date',
      'keterangan'=>'nullable|string',
    ]);

    DB::transaction(function() use ($r){
      ItemInbound::create([
        'item_id'=>$r->item_id,
        'qty_masuk'=>$r->qty_masuk,
        'tanggal_masuk'=>$r->tanggal_masuk,
        'keterangan'=>$r->keterangan,
        'user_id'=>auth()->id(),
      ]);
      Item::where('id',$r->item_id)->increment('stok',$r->qty_masuk);
    });

    return redirect()->route('user.inbounds.index')->with('success','Barang masuk berhasil');
  }
}

