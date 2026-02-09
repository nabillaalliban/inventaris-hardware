<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function export()
    {
        $locations = Location::all();
        $damagedItems = Item::where('quantity', '>', 0)->get();

        $pdf = Pdf::loadView('pdf.locations', compact('locations', 'damagedItems'));
        return $pdf->download('laporan_inventaris.pdf');
    }
}

