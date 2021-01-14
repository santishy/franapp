<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product; 
use App\Http\Resources\ProductResource;
use App\Http\Resources\TransactionResource;

class SaleController extends Controller
{
    public function create(){
        $sale = Sale::find(session()->get('sale_id'));
        return view('sales.create',['sale' => TransactionResource::make($sale)]);
    }

    public function store(Product $product){
        $sale = Sale::getTransaction();
        $sale->transactions($product);
        return response()->json([
            'product' => ProductResource::make($product),
            'sale' => $sale
        ]) ;
        
    }
}
