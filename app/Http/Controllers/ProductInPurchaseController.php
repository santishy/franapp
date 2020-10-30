<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ProductInPurchaseController extends Controller
{
    //corregir parametro en el update
    public function update(Request $request,Product $product){
        request()->validate([
            'id' => 'required|exists:products,id',
            'pivot.qty' => 'required|numeric|min:1',
            'pivot.purchase_price' => 'required|numeric|min:1',
        ]);
        Purchase::find(session()->get('purchase_id'))->products()->updateExistingPivot($request->id,[
            'qty' => $request->pivot['qty'],
            'purchase_price' => $request->pivot['purchase_id']
        ]);
    }
    public function destroy(Product $product){
        return Purchase::find(session()->get('purchase_id'))->products()->detach($product->id);
    }
}