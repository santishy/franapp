<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale; 

class SaleController extends Controller
{
    public function create(){
        return view('sales.create');
    }

    public function store(Request $request){
        
        $sale = Sale::transactions();
        return response()->json([
            'qty' => $sale->products()->where('product_id', $request->product_id)->sum('qty'),
            'sale_id' => $sale->id,
        ]);
    }
}
