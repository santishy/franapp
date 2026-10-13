<?php

namespace App\Models;

use App\Models\Traits\ReportBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaleReturn extends Model
{
    /** @use HasFactory<\Database\Factories\SaleReturnFactory> */
    use HasFactory, ReportBy;
    protected $guarded = ["id"];
    // morphMany, no morphOne: igual que Sale (que puede tener income + refund),
    // un reembolso podría dividirse en más de un Payment (ej. parte efectivo, parte tarjeta).
    public function payments()
    {
        return $this->morphMany(Payment::class, "payable");
    }
    public function originalSale()
    {
        return $this->belongsTo(Sale::class, "original_sale_id");
    }
    public function replacementSale()
    {
        return $this->belongsTo(Sale::class, "replacement_sale_id");
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(
            "qty",
            "return_price",
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
    public function total()
    {
        return $this->products()->sum(DB::raw("return_price * qty"));
    }
}
