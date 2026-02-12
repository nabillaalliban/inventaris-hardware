<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;      
use Illuminate\Http\Request;

class ItemController extends Controller {
  public function index(){
    $items = Item::with('category')->latest()->get();
    return view('admin.items.index', compact('items'));
  }

  public function create(){
    $categories = Category::orderBy('nama_kategori')->get();
    return view('admin.items.create', compact('categories'));
  }

  public function store(Request $r){
    $r->validate([
      'category_id'=>'required|exists:categories,id',
      'nama_barang'=>'required',
      'harga'=>'required|integer|min:0',
      'stok'=>'required|integer|min:0',
      'tanggal'=>'nullable|date',
      'foto'=>'nullable|image|max:2048',
    ]);

    $path = null;
    if($r->hasFile('foto')){
      $path = $r->file('foto')->store('items','public');
    }

    Item::create([
      'category_id'=>$r->category_id,
      'nama_barang'=>$r->nama_barang,
      'harga'=>$r->harga,
      'stok'=>$r->stok,
      'tanggal'=>$r->tanggal,
      'foto'=>$path,
    ]);

    return redirect()->route('admin.items.index')->with('success','Barang dibuat');
  }
}

