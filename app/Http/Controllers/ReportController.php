<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Location;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function exportPdf()
    {
        $items = Item::with('category')->get();
        $locations = Location::all();

        $pdf = Pdf::loadView('reports.report', compact('items','locations'));
        return $pdf->download('laporan-inventaris.pdf');
    }
}
