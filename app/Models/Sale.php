<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function scopeAdd(Builder $query){
        $query->attach(request()->product_id, [
            'purchase_price' => request()->purchase_price,
            'qty' => 1
        ]);
    }

    public function scopeFindOrCreateTheTransaction(Builder $query){
        if(session()->has('purchase_id')){
            return $query->find(session()->get('purchase_id'));
        }
        $sale = $query->create();
        session()->put('purchase_id',$sale->id);
        return $sale;
    }
}
