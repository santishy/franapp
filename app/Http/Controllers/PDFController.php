<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class PDFController extends Controller
{
    function __invoke(Sale $sale)
    {
        $now = Carbon::now()->format('Y-m-d');

        $products = $sale->products;

        $ticketConfig = Ticket::first();


        /** Se crea el frame de pdf la primera vez para calcular que tan grande sera el ticket, mando en altura 2000 como un maximo de altura sin que se rompa el codigo */

        $pdf = PDF::setOptions([
            'dpi' => 203,                 // 203 dpi es lo típico en térmicas
            'defaultFont' => 'DejaVu Sans', // segura para acentos y símbolos
            'enable_remote' => true,      // por si sirves una fuente desde /public
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true, // incrusta solo glifos usados (más nítido)
        ])->loadView(
            'tickets.pdf',
            compact('sale', 'now', 'products', 'ticketConfig')
        )->setPaper(array(0, 0, 227.67, 2000));

        /**
         * Se obtiene la altura, la logica esta guardada en el modelo .. midiendo la altura total del body que esta dentro del padding al menos asi lo entendi
         */
        $height = $ticketConfig->getBodyHeight($pdf->getdomPDF());

        /**
         * Se vuelve a mandar a crear el frame con la altura correspondiente al documento, de forma mas precisa y se manda pintar al final
         */
        $pdf = PDF::setOptions([
            'dpi' => 203,                 // 203 dpi es lo típico en térmicas
            'defaultFont' => 'DejaVu Sans', // segura para acentos y símbolos
            'enable_remote' => true,      // por si sirves una fuente desde /public
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true, // incrusta solo glifos usados (más nítido)
        ])->loadView(
            'tickets.pdf',
            compact('sale', 'now', 'products', 'ticketConfig')
        )->setPaper(array(0, 0, 227.67, $height + 20));

        return $pdf->stream();
    }
}
