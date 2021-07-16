<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;

class SaleToClientController extends Controller
{
    public function store(Request $request)
    {
        $fields = $request->validate([
            'phone_number' => 'exists:clients,phone_number|required',
        ]);

        $sale = Sale::getTransaction();

        $client = Client::where(
            'phone_number',
            $fields['phone_number']
        )->first();

        $sale->client()
            ->associate($client);
        
        return response()->json([
            'client' => $client,
            'transaction' =>  TransactionResource::make($sale)
        ]);

    }
}
