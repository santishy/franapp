<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    function __invoke(Sale $sale)
    {
        $products = $sale->products;
        $ticketConfig = Ticket::first();
        $pdf = PDF::loadView('tickets.pdf', compact('sale','products','ticketConfig'));
        return $pdf->stream();
    }
}
