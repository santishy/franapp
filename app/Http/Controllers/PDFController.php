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
        $height = '200mm';
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale', 'now', 'products', 'ticketConfig', 'height')
        );
        $GLOBALS['bodyHeight'] = 0;

        $pdf->setCallbacks(
            array(
                'myCallbacks' => array(
                    'event' => 'end_frame', 'f' => function ($infos) {
                        $frame = $infos["frame"];
                        if (strtolower($frame->get_node()->nodeName) === "body") {
                            $padding_box = $frame->get_padding_box();
                            $GLOBALS['bodyHeight'] += $padding_box['h'];
                        }
                    }
                )
            )
        );
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale', 'now', 'products', 'ticketConfig', 'height')
        )->set_paper(array(0,0,600,$GLOBALS['bodyHeight']+50));
        return $pdf->stream();
    }
}
