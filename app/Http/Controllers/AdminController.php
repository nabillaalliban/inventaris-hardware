<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventaris;
use App\Models\Peminjaman; // pastikan model ini ada

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahKategori = Category::count();
        $jumlahBarang   = Inventaris::count();
        $baik           = Inventaris::where('kondisi', 'Baik')->count();
        $rusak          = Inventaris::where('kondisi', 'Rusak')->count();

        // data inventaris (yang sudah kamu punya)
        $inventarisTerbaru = Inventaris::with('category')->latest()->take(8)->get();
        $rusakTerbaru      = Inventaris::with('category')->where('kondisi', 'Rusak')->latest()->take(6)->get();

        // ✅ aktivitas terbaru: peminjaman terbaru 5 data
        $peminjamanTerbaru = Peminjaman::with(['inventaris', 'inventaris.category'])
            ->latest()
            ->take(5)
            ->get();

        // ✅ grafik kondisi (buat Chart.js)
        $chartKondisi = [
            'labels' => ['Baik', 'Rusak'],
            'data'   => [$baik, $rusak],
        ];

        return view('admin.dashboard', compact(
            'jumlahKategori',
            'jumlahBarang',
            'baik',
            'rusak',
            'inventarisTerbaru',
            'rusakTerbaru',
            'peminjamanTerbaru',
            'chartKondisi'
        ));
    }
}
