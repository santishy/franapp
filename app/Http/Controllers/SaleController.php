<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product; 

class SaleController extends Controller
{
    public function create(){
        return view('sales.create');
    }

    public function store(Product $product){
        $sale = Sale::getTransaction();
        dd($sale->id);
        return response()->json([
            'qty' => $sale->products()->where('product_id', $request->product_id)->sum('qty'),
            'sale_id' => $sale->id,
        ]);
    }
}
