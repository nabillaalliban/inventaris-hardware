<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item;
use App\Models\LoanRequest;
use App\Models\LoanRequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCartController extends Controller
{
    private function activeCart()
    {
        return Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'status' => 'active'
        ]);
    }

    public function index()
    {
        $cart = $this->activeCart()->load('items.item.category');
        return view('admin.cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'qty' => 'required|integer|min:1',
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($request->qty > $item->stok) {
            return back()->with('error', 'Qty melebihi stok tersedia.');
        }

        $cart = $this->activeCart();

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('item_id', $item->id)
            ->first();

        if ($cartItem) {
            $newQty = $cartItem->qty + (int)$request->qty;
            if ($newQty > $item->stok) {
                return back()->with('error', 'Total qty di keranjang melebihi stok.');
            }
            $cartItem->update(['qty' => $newQty]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'item_id' => $item->id,
                'qty' => (int)$request->qty,
            ]);
        }

        return back()->with('success', 'Barang masuk keranjang.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = $this->activeCart();

        $cartItem = CartItem::where('cart_id', $cart->id)->findOrFail($id);
        $item = $cartItem->item;

        if ((int)$request->qty > $item->stok) {
            return back()->with('error', 'Qty melebihi stok tersedia.');
        }

        $cartItem->update(['qty' => (int)$request->qty]);
        return back()->with('success', 'Qty diperbarui.');
    }

    public function remove($id)
    {
        $cart = $this->activeCart();
        CartItem::where('cart_id', $cart->id)->findOrFail($id)->delete();
        return back()->with('success', 'Item dihapus dari keranjang.');
    }

   public function checkout(Request $request)
{
   $request->validate([
  'tanggal_pinjam' => 'required|date', // atau tanggal_pengajuan
]);


    $cart = Cart::with('items.item')
        ->where('user_id', auth()->id())
        ->where('status','active')
        ->firstOrFail();

    if ($cart->items->isEmpty()) {
        return back()->withErrors(['Keranjang kosong.']);
    }

    $loan = LoanRequest::create([
        'user_id' => auth()->id(),
        'due_date' => $request->due_date,
        'status' => 'pending',
    ]);

    foreach ($cart->items as $row) {
        LoanRequestItem::create([
            'loan_request_id' => $loan->id,
            'item_id' => $row->item_id,
            'qty' => $row->qty,
        ]);
    }

    $cart->items()->delete();

    return redirect()->route('admin.loans.index')
        ->with('success','Pengajuan berhasil dikirim.');
}



}

