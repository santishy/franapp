<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeAdd(Builder $query){
        $query->attach(request()->product_id, [
            'sale_price' => request()->sale_price,
            'qty' => 1
        ]);
    }

    public function scopeFindOrCreateTheTransaction(Builder $query){
        if(! session()->has('sale_id')){
            $sale = $query->create();
            session()->put('sale_id',$sale->id);
        }
        return $query->find(session()->get('sale_id'));
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('qty', 'sale_price');
    }

    public function productInTransaction($product){
        return $this->products()->where('product_id',$product->id);
    }

    public function scopeUpdateTransactionProduct(Builder $query,$transaction,$product){
        $transaction->updateExistingPivot(
            $product->id,
            [
                'qty' => (
                    $transaction->where('product_id',$product->id)->first()->pivot->qty + 1
                ),
                'sale_price' => $product->retail_price
            ]
        );
    }

    public function scopeTotal(Builder $query){
        $this->sum(DB::raw('qty * sale_price'));
    }
}
