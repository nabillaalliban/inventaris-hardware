<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventaris;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahKategori = Category::count();
        $jumlahBarang   = Inventaris::count();
        $baik           = Inventaris::where('kondisi', 'Baik')->count();
        $rusak          = Inventaris::where('kondisi', 'Rusak')->count();

       
        $inventarisTerbaru = Inventaris::with('category')
            ->latest()
            ->take(8)
            ->get();

        $rusakTerbaru = Inventaris::with('category')
            ->where('kondisi', 'Rusak')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'jumlahKategori',
            'jumlahBarang',
            'baik',
            'rusak',
            'inventarisTerbaru',
            'rusakTerbaru'
        ));
    }
}
