<?php

namespace App\Models;

use App\Models\Traits\ReportBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory, ReportBy;
    protected $fillable=['status','total'];

    public static function findOrCreateThePurchase(){
        if(session()->has('purchase_id')){
            return Purchase::find(session()->get('purchase_id'));
        }
        $purchase = Purchase::create();
        session()->put('purchase_id',$purchase->id);
        return $purchase;
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('qty','purchase_price');
    }
    public function totalPurchase(){
        return $this->products()->sum(DB::raw('qty * purchase_price'));
    }
}
