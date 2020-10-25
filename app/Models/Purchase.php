<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
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
        return $this->belongsToMany(Product::class);
    }
}
