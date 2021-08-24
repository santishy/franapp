<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    function __invoke(Sale $sale)
    {
        $pdf = PDF::loadView('pdf.invoice', compact('sale'));
        return $pdf->download('tickets.pdf');
    }
}
