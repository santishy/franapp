<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use App\Models\Sale;


class SaleController extends Controller
{
    public function create()
    {
        $sale = Sale::find(session()->get('sale_id'));
        return view('sales.create', ['sale' => $sale ? TransactionResource::make($sale) : null]);
    }



    public function store(Sale $sale, Client $client)
    {

        return $client;
        $fields = $request->validate([
            'status' => ['required', 'regex:/completed|cancelled|pending/'],
            'total' => 'numeric|required',
            'phone_number' => 'exists:clients,phone_number|required'
        ]);
        $sale->update($fields);
        $sale->client()->associate($client);
        return response()->json([
            'sale_status' => $sale->status
        ]);
    }
}
