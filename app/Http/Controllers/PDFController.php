<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PDFController extends Controller
{
    function __invoke(Sale $sale)
    {
        $now = Carbon::now()->format('Y-m-d');
        $products = $sale->products;
        $ticketConfig = Ticket::first();
        return view('tickets.pdf', compact('sale', 'now', 'products', 'ticketConfig'));
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale', 'now', 'products', 'ticketConfig')
        )
        ->setPaper('b7','portrait');
        return $pdf->stream();
    }
}
