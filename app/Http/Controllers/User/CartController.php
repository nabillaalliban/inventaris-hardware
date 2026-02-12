<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
  private function activeCart()
  {
    return Cart::firstOrCreate(
      ['user_id'=>auth()->id(),'status'=>'active'],
      ['status'=>'active']
    );
  }

  public function index()
  {
    $cart = $this->activeCart()->load('items.item.category');
    return view('user.cart.index', compact('cart'));
  }

  public function add(Request $r)
  {
    $r->validate(['item_id'=>'required|exists:items,id','qty'=>'required|integer|min:1']);
    $cart = $this->activeCart();

    $row = CartItem::firstOrNew(['cart_id'=>$cart->id,'item_id'=>$r->item_id]);
    $row->qty = ($row->exists ? $row->qty : 0) + (int)$r->qty;
    $row->save();

    return back()->with('success','Barang masuk keranjang');
  }

  public function update(Request $r, $id)
  {
    $r->validate(['qty'=>'required|integer|min:1']);
    $row = CartItem::where('cart_id',$this->activeCart()->id)->findOrFail($id);
    $row->update(['qty'=>$r->qty]);
    return back()->with('success','Keranjang diupdate');
  }

  public function remove($id)
  {
    $row = CartItem::where('cart_id',$this->activeCart()->id)->findOrFail($id);
    $row->delete();
    return back()->with('success','Item dihapus');
  }

  public function checkout(Request $r)
  {
    $r->validate([
      'tipe_peminjam'=>'required|in:mahasiswa,dosen,bidang1,bidang2,bidang3',
      'nama_peminjam'=>'required|string|max:255',
      'tanggal_pinjam'=>'required|date',
      'due_date'=>'nullable|date|after_or_equal:tanggal_pinjam',
      'catatan'=>'nullable|string',
    ]);

    $cart = $this->activeCart()->load('items.item');
    if($cart->items->count()==0){
      return back()->withErrors(['cart'=>'Keranjang kosong']);
    }

    // validasi stok cukup saat checkout (biar user tau dari awal)
    foreach($cart->items as $ci){
      if($ci->qty > $ci->item->stok){
        return back()->withErrors(['cart'=>"Stok {$ci->item->nama_barang} tidak cukup"]);
      }
    }

    DB::transaction(function() use ($r,$cart){
      $loan = LoanRequest::create([
        'user_id'=>auth()->id(),
        'tipe_peminjam'=>$r->tipe_peminjam,
        'nama_peminjam'=>$r->nama_peminjam,
        'tanggal_pinjam'=>$r->tanggal_pinjam,
        'due_date'=>$r->due_date,
        'catatan'=>$r->catatan,
        'status'=>'pending',
      ]);

      foreach($cart->items as $ci){
        LoanRequestItem::create([
          'loan_request_id'=>$loan->id,
          'item_id'=>$ci->item_id,
          'qty'=>$ci->qty,
        ]);
      }

      // cart jadi checked_out, buat cart baru active
      $cart->update(['status'=>'checked_out']);
      Cart::create(['user_id'=>auth()->id(),'status'=>'active']);
    });

    return redirect()->route('user.loans.index')->with('success','Pengajuan peminjaman dikirim (menunggu admin)');
  }
}

