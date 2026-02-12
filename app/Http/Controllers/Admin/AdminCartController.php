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
            'peminjam_tipe' => 'required|in:mahasiswa,dosen,bidang1,bidang2,bidang3',
            'nama_peminjam' => 'required',
            'keterangan' => 'nullable',
            'due_date' => 'required|date',
        ]);

        $cart = $this->activeCart()->load('items.item');

        if ($cart->items->count() === 0) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        DB::transaction(function () use ($request, $cart) {

            // validasi stok sekali lagi
            foreach ($cart->items as $ci) {
                if ($ci->qty > $ci->item->stok) {
                    throw new \Exception("Stok {$ci->item->nama_barang} tidak cukup.");
                }
            }

            // buat loan (langsung aktif/approved karena admin yang ajukan)
            $loan = LoanRequest::create([
                'user_id'        => auth()->id(),       // admin pencatat
                'status'         => 'approved',
                'tanggal_pinjam' => now()->toDateString(),
                'due_date'       => $request->due_date,
                'catatan'        => $request->keterangan,
                'approved_by'    => auth()->id(),
                'peminjam_tipe'  => $request->peminjam_tipe,
                'nama_peminjam'  => $request->nama_peminjam,
            ]);

            foreach ($cart->items as $ci) {
                LoanRequestItem::create([
                    'loan_request_id' => $loan->id,
                    'item_id' => $ci->item_id,
                    'qty' => $ci->qty,
                ]);

                // kurangi stok
                $ci->item->decrement('stok', $ci->qty);
            }

            // cart selesai
            $cart->update(['status' => 'checked_out']);
        });

        return redirect()->route('admin.loans.index')->with('success', 'Peminjaman berhasil dibuat dari keranjang.');
    }
}

