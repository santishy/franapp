<?php

namespace App\Http\Responses;

use App\Http\Resources\ProductResource;
use Illuminate\Contracts\Support\Responsable;

class TransactionResponse implements Responsable
{

    public $transaction;

    function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    function toResponse($request)
    {
        return response()->json([
            'product' => ProductResource::make($request->product),
            'sale' => $this->transaction
        ]) ;
    }
}
