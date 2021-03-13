<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeAdd(Builder $query)
    {
        $query->attach(request()->product_id, [
            'sale_price' => request()->sale_price,
            'qty' => 1
        ]);
    }

    public function client()
    {
        return $this->belongsTo(Sale::class);
    }

    public function scopeFindOrCreateTheTransaction(Builder $query)
    {
        if (!session()->has('sale_id')) {
            $sale = $query->create();
            session()->put('sale_id', $sale->id);
        }
        return $query->find(session()->get('sale_id'));
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('qty', 'sale_price');
    }

    public function productInTransaction($product)
    {
        return $this->products()->where('product_id', $product->id);
    }

    //public function scopeUpdateTransactionProduct(Builder $query,$transaction,$product){
    public function scopeUpdateTransactionProduct(Builder $query, $request)
    {
        $query->products()
            ->updateExistingPivot(
                $request->product_id,
                [
                    'qty' => ($request->qty),
                    'sale_price' => $request->sale_price
                ]
            );
    }

    public function scopeTotal(Builder $query)
    {
        $this->sum(DB::raw('qty * sale_price'));
    }

    public function scopeYear(Builder $query, $value)
    {
        $query->whereYear('created_at', $value);
    }

    public function scopeMonth(Builder $query, $value)
    {
        $query->whereMonth('created_at', $value);
    }
    public function scopeToday(Builder $query,$value)
    {   
        
        $query->whereDate('created_at',Carbon::now()->format('Y-m-d'));

    }
    public function scopeCurrentMonth(Builder $query,$value){
        $query->whereMonth('created_at',Carbon::now()->month);
    }
    public function scopeStatus(Builder $query,$value){
        $query->where('status',$value);
    }
    public function scopeWeek(Builder $query,$value){
        $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }
}
