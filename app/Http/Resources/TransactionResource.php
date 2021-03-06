<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'transactionType' => Str::lower(class_basename($this->resource)),
            'total' => $this->resource->total,
            'created_at' => $this->resource->created_at->format('Y-m-d H:m:s'),
            'status' => $this->resource->status,
            'products' => ProductResource::collection($this->products)
        ];
    }
}
