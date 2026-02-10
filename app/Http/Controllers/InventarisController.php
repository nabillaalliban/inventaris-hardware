<?php

namespace App\Http\Controllers;
use App\Models\Inventaris;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
        public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $inventaris = \App\Models\Inventaris::with('category')
            ->when($q !== '', function ($query) use ($q) {
                $terms = preg_split('/\s+/', $q); // pecah per kata

                foreach ($terms as $term) {
                    $query->where(function ($sub) use ($term) {
                        $sub->where('lokasi', 'like', "%{$term}%")
                            ->orWhere('nama_perangkat', 'like', "%{$term}%")
                            ->orWhere('kode', 'like', "%{$term}%");
                    });
                }
            })
            ->latest()
            ->get();

        return view('user.inventaris.index', compact('inventaris', 'q'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama_perangkat' => 'required',
            'kondisi' => 'required|in:Baik,Rusak',
            'lokasi' => 'required',
            'tanggal_masuk' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        Inventaris::create([
            'kode' => $request->kode,
            'nama_perangkat' => $request->nama_perangkat,
            'kondisi' => $request->kondisi,
            'lokasi' => $request->lokasi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('user.inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $categories = Category::all();

        return view('user.inventaris.edit', compact('inventaris', 'categories'));
    }

     public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama_perangkat' => 'required',
            'kondisi' => 'required|in:Baik,Rusak',
            'lokasi' => 'required',
            'tanggal_masuk' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $inventaris = Inventaris::findOrFail($id);

        $inventaris->update([
            'kode' => $request->kode,
            'nama_perangkat' => $request->nama_perangkat,
            'kondisi' => $request->kondisi,
            'lokasi' => $request->lokasi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('user.inventaris.index')
            ->with('success', 'Data inventaris berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();

        return redirect()->route('user.inventaris.index')
            ->with('success', 'Data inventaris berhasil dihapus!');
    }


    public function exportPdf()
    {
        $inventaris = Inventaris::with('category')->get();
        $pdf = Pdf::loadView('pdf.inventaris', compact('inventaris'));
        return $pdf->download('laporan_inventaris.pdf');
    }
}
