<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Request $request){
        request()->validate(
            [
                'product_id' => 'exists:products,id'
            ]
        );
        $purchase = Purchase::findOrCreateThePurchase();
        $purchase->products()->attach($request->product_id);
        return $purchase->products()->count();
    }
}
