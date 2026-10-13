<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class SaleReturnResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->id,
            "transactionType" => "return",
            "total" => $this->resource->total,
            "original_sale_id" => $this->resource->original_sale_id,
            "resolution" => $this->resource->resolution,
            "created_at" => $this->resource->created_at->format("Y-m-d H:i:s"),
            "products" => ProductResource::collection(
                $this->whenLoaded("products"),
            ),
            "inventory_id" => $this->inventory_id,
            "username" => $this->resource->user->name,
        ];
    }
}
