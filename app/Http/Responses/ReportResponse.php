<?php

namespace App\Http\Responses;

use App\Http\Resources\TransactionResource;
use Illuminate\Contracts\Support\Responsable;

class ReportResponse implements Responsable
{

    public $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    function toResponse($request)
    {
        $transactions = $this->model->applyFilters();

        return response()->json([
            'data' =>  TransactionResource::collection($transactions->with('products')->paginate(50)),
            'total' => $transactions->sum('total')
        ]);
    }
}