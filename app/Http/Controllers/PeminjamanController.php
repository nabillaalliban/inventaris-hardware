<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // ===== PEMINJAMAN (LIST SEMUA) =====
    public function index()
    {
        $data = Peminjaman::with(['inventaris.category'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.peminjaman.index', compact('data'));
    }

    public function create()
    {
        // inventaris yang sedang dipinjam (global) -> supaya tidak bisa double pinjam
        $sedangDipinjam = Peminjaman::where('status', 'dipinjam')
            ->pluck('inventaris_id')
            ->toArray();

        $inventaris = Inventaris::with('category')
            ->whereNotIn('id', $sedangDipinjam)
            ->orderBy('nama_perangkat')
            ->get();

        return view('user.peminjaman.create', compact('inventaris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe_peminjam' => 'required|in:mahasiswa,dosen,bidang1,bidang2,bidang3',
            'nama_peminjam' => 'required|string|max:255',
            'inventaris_id' => 'required|exists:inventaris,id',
            'tanggal_pinjam' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // cek double pinjam
        $masihDipinjam = Peminjaman::where('inventaris_id', $request->inventaris_id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($masihDipinjam) {
            return back()->withErrors(['inventaris_id' => 'Barang ini sedang dipinjam.'])->withInput();
        }

        Peminjaman::create([
            'tipe_peminjam' => $request->tipe_peminjam,
            'nama_peminjam' => $request->nama_peminjam,
            'inventaris_id' => $request->inventaris_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'keterangan' => $request->keterangan,
            'status' => 'dipinjam',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('user.peminjaman.index')->with('success', 'Peminjaman berhasil disimpan!');
    }

    // ===== PENGEMBALIAN (LIST YANG DIPINJAM) =====
    public function pengembalianIndex()
    {
        $data = Peminjaman::with(['inventaris.category'])
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('user.pengembalian.index', compact('data'));
    }

    public function pengembalianForm($id)
    {
        $p = Peminjaman::with(['inventaris.category'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        if ($p->status === 'dikembalikan') {
            return redirect()->route('user.pengembalian.index')->with('success', 'Data ini sudah dikembalikan.');
        }

        return view('user.pengembalian.kembali', compact('p'));
    }

    public function pengembalian(Request $request, $id)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
            'keterangan_kembali' => 'nullable|string',
        ]);

        $p = Peminjaman::where('user_id', auth()->id())->findOrFail($id);

        if ($p->status === 'dikembalikan') {
            return redirect()->route('user.pengembalian.index')->with('success', 'Data ini sudah dikembalikan.');
        }

        $p->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => $request->tanggal_kembali,
            'keterangan_kembali' => $request->keterangan_kembali,
        ]);

        return redirect()->route('user.pengembalian.index')->with('success', 'Pengembalian berhasil!');
    }
}
