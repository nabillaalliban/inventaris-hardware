<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\LoanRequest;
use Illuminate\Http\Request;

class MobileDataController extends Controller
{
    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);
    }

    public function items(Request $request)
    {
        $search = trim((string) $request->query('search'));

        $items = Item::with('category')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('nama_barang', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get()
            ->map(function (Item $item) {
                return [
                    'id' => $item->id,
                    'nama_barang' => $item->nama_barang,
                    'harga' => (int) $item->harga,
                    'stok' => (int) $item->stok,
                    'tanggal' => $item->tanggal,
                    'foto' => $item->foto,
                    'foto_url' => $item->foto ? asset('storage/' . $item->foto) : null,
                    'category' => [
                        'id' => $item->category?->id,
                        'nama_kategori' => $item->category?->nama_kategori,
                    ],
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'search' => $search,
            'count' => $items->count(),
            'data' => $items,
        ]);
    }

    public function loans(Request $request)
    {
        $loans = LoanRequest::with('items.item.category')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get()
            ->map(function (LoanRequest $loan) {
                return [
                    'id' => $loan->id,
                    'nama_peminjam' => $loan->nama_peminjam,
                    'tipe_peminjam' => $loan->tipe_peminjam,
                    'tanggal_pinjam' => $loan->tanggal_pinjam,
                    'due_date' => $loan->due_date,
                    'tanggal_kembali' => $loan->tanggal_kembali,
                    'catatan' => $loan->catatan,
                    'status' => $loan->status,
                    'items' => $loan->items->map(function ($row) {
                        return [
                            'id' => $row->id,
                            'qty' => (int) $row->qty,
                            'item' => [
                                'id' => $row->item?->id,
                                'nama_barang' => $row->item?->nama_barang,
                                'harga' => $row->item ? (int) $row->item->harga : null,
                                'stok' => $row->item ? (int) $row->item->stok : null,
                                'foto_url' => $row->item?->foto ? asset('storage/' . $row->item->foto) : null,
                                'category' => [
                                    'id' => $row->item?->category?->id,
                                    'nama_kategori' => $row->item?->category?->nama_kategori,
                                ],
                            ],
                        ];
                    })->values(),
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'count' => $loans->count(),
            'data' => $loans,
        ]);
    }

    public function loanStats(Request $request)
    {
        $userId = $request->user()->id;

        $returned = LoanRequest::where('user_id', $userId)
            ->where('status', 'returned')
            ->count();

        $notReturned = LoanRequest::where('user_id', $userId)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'returned' => $returned,
                'not_returned' => $notReturned,
                'total' => $returned + $notReturned,
            ],
        ]);
    }
}
