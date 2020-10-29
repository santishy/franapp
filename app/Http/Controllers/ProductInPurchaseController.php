<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ProductInPurchaseController extends Controller
{
    //corregir parametro en el update
    public function update(Product $product,Request $request){

        request()->validate($request->all(),[
            'id' => 'required|exists:product,id',
            'qty' => 'required|numeric|min:1',
            'purchase_price' => 'required|numeric|min:1',
        ]);
        Purchase::find(session()->get('purchase_id'))->udpate()
    }
}
