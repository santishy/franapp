<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'sku' => $this->sku,
            'description' => $this->description,
            'wholesale_price' => $this->wholesale_price,
            'retail_price' => $this->retail_price,
            'distributor_price' => $this->distributor_price,
            'formatted_wholesale_price' =>'$'.number_format($this->wholesale_price,2),
            'formatted_retail_price' => '$'.number_format($this->retail_price,2),
            'formatted_distributor_price' => '$'.number_format($this->distributor_price,2),
        ];
    }
}
