<?php

namespace App\Models;

use App\Facades\InventoryContext;
use App\Models\Traits\ReportBy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory, ReportBy;

    protected $guarded = ["id"];

    public function returns()
    {
        return $this->hasMany(
            SaleReturn::class,
            foreignKey: "original_sale_id",
        );
    }
    public function returnableQty($productId)
    {
        $saleQty = $this->products()
            ->wherePivot("product_id", $productId)
            ->sum("qty");
        $saleReturnQty = $this->returns()
            ->join(
                "product_sale_return",
                "sale_returns.id",
                "=",
                "product_sale_return.sale_return_id",
            )
            ->where("product_sale_return.product_id", $productId)
            ->sum("product_sale_return.qty");
        return $saleQty - $saleReturnQty;
    }

    public function total()
    {
        return $this->products()->sum(DB::raw("sale_price * qty"));
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, "payable");
    }
    public function scopeAdd(Builder $query)
    {
        $query->attach(request()->product_id, [
            "sale_price" => request()->sale_price,
            "qty" => 1,
        ]);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeFindOrCreateTheTransaction(Builder $query)
    {
        if (!session()->has("sale_id")) {
            $sale = $query->create([
                "user_id" => auth()->guard()->id(),
                "inventory_id" => InventoryContext::id(),
            ]);
            session()->put("sale_id", $sale->id);
        }
        return $query->find(session()->get("sale_id"));
    }

    public function products()
    {
        return $this->belongsToMany("App\Models\Product")->withPivot(
            "qty",
            "sale_price",
        );
    }

    public function productInTransaction($product)
    {
        return $this->products()->where("product_id", $product->id);
    }

    public function scopeUpdateTransactionProduct(Builder $query, $request)
    {
        $query->products()->updateExistingPivot($request->product_id, [
            "qty" => $request->qty,
            "sale_price" => $request->sale_price,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
