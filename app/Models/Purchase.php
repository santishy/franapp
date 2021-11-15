<?php

namespace App\Models;

use App\Models\Traits\ReportBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory, ReportBy;
    protected $fillable = ['status', 'total', 'inventory_id', 'user_id'];

    public static function findOrCreateThePurchase()
    {
        if (session()->has('purchase_id')) {
            return Purchase::find(session()->get('purchase_id'));
        }
        $purchase = Purchase::create(['user_id' => Auth::id()]);
        session()->put('purchase_id', $purchase->id);
        return $purchase;
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty', 'purchase_price');
    }
    public function totalPurchase()
    {
        return $this->products()->sum(DB::raw('qty * purchase_price'));
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getProductInPurchase($id = null)
    {
        if (is_null($id)) {
            $id = request('product_id');
        }
        $product = $this->products()->where(['product_id' => $id]);
        return $product;
    }

    public function addProduct(...$data)
    {

        if(!array_key_exists('product_id', $data)) {
            $data['product_id'] = request()->product_id;
        }
        if(!array_key_exists('purchase_price',$data)){
            $data['purchase_price'] = request()->purchase_price;
        }
        if(!array_key_exists('qty',$data)){
            $data['qty'] = request()->qty ? request()->qty : 1;
        }

        $productInPurchase = $this->getProductInPurchase();

        if ($productInPurchase->exists()) {
            $productInPurchase->updateExistingPivot(
                $data['product_id'],
                ['qty' => ($productInPurchase->first()->pivot->qty +  $data['qty'])]
            );
        } else {
            $this->products()->attach($data['product_id'], [
                'purchase_price' => $data['purchase_price'],
                'qty' => $data['qty'],
            ]);
        }

    }
}
