<?php

namespace App\Http\Responses;

use App\Http\Resources\TransactionResource;
use Illuminate\Contracts\Support\Responsable;

class ReportResponse implements Responsable
{
    function __construct(
        public $model,
        public string $resource = TransactionResource::class,
    ) {}

    function toResponse($request)
    {
        $transactions = $this->model->include()->applyFilters();

        $data = [
            "data" => $this->resource::collection($transactions->paginate(20)),
        ];

        if (request("page") == 1) {
            $data["total"] = number_format($transactions->sum("total"), 2);
        }

        return response()->json($data);
    }
}
