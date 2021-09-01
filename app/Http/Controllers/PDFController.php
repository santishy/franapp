<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Dompdf;

class PDFController extends Controller
{
    function __invoke(Sale $sale)
    {
        $now = Carbon::now()->format('Y-m-d');
        $products = $sale->products;
        $ticketConfig = Ticket::first();
        $height = '200mm';
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale', 'now', 'products', 'ticketConfig', 'height')
        );
        return $pdf->stream();
    }
}
