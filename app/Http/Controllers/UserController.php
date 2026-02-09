<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Models\Category;

class UserController extends Controller
{
    public function inventaris()
    {
        $inventaris = Inventaris::with('category')
            ->where('user_id', auth()->id())
            ->get();

        return view('user.inventaris', compact('inventaris'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'category_id' => 'required',
        ]);

        Inventaris::create([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('user.inventaris')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $inventaris = Inventaris::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $categories = Category::all();

        return view('user.edit', compact('inventaris', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'category_id' => 'required',
        ]);

        $inventaris = Inventaris::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $inventaris->update([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('user.inventaris')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $inventaris = Inventaris::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $inventaris->delete();

        return redirect()->route('user.inventaris')->with('success', 'Data berhasil dihapus!');
    }
}
