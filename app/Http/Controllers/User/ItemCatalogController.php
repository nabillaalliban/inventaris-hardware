<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemCatalogController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->latest()->get();
        return view('user.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::orderBy('nama_kategori')->get();
        return view('user.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'  => 'required',
            'category_id'  => 'required|exists:categories,id',
            'harga'        => 'required|integer|min:0',
            'stok'         => 'required|integer|min:0',
            'tanggal'      => 'required|date',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('items', 'public'); // storage/app/public/items
        }

        Item::create([
            'nama_barang' => $request->nama_barang,
            'category_id' => $request->category_id,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'tanggal'     => $request->tanggal,
            'foto'        => $path,
        ]);

        return redirect()->route('user.items.index')->with('success', 'Barang berhasil ditambahkan.');
    }
}
