<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    function __invoke(Sale $sale)
    {
        $products = $sale->products();
        $size = array(0,0,302.36220472,null);
        $pdf = PDF::loadView('tickets.pdf', compact('sale'));
        return $pdf->stream();
    }
}
