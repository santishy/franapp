<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use App\Models\Sale;


class SaleController extends Controller
{
    public function index()
    {
        dd(now()->day());
    }
    public function create()
    {
        $sale = Sale::find(session()->get('sale_id'));
        return view('sales.create', ['sale' => $sale ? TransactionResource::make($sale) : null]);
    }



    public function store(Request $request, Sale $sale)
    {
        $fields = $request->validate([
            'status' => ['required', 'regex:/completed|cancelled|pending/'],
            'total' => 'numeric|required',
            'phone_number' => 'exists:clients,phone_number|required'
        ]);
        if ($fields['status'] === 'completed')
            request()->session()->forget('sale_id');
        else
            request()->session()->put('sale_id', $sale->id);
        $sale->update($fields);
        $sale->client()
            ->associate(
                Client::where(
                    'phone_number',
                    $fields['phone_number']
                )->first()
            );
        return response()->json([
            'sale_status' => $sale->status
        ]);
    }
}
