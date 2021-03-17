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

        $data = [
            'data' =>  TransactionResource::collection($transactions->with('products')->paginate(50)),
        ];

        if(request('page') == 1){
            $data['total'] = $transactions->sum('total');
        }
        
        return response()->json($data);
    }
}