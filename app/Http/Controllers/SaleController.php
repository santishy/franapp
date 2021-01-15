<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TransactionResource;
use App\Http\Responses\TransactionResponse;

class SaleController extends Controller
{
    public function create()
    {
        $sale = Sale::find(session()->get('sale_id'));
        return view('sales.create', ['sale' => $sale ? TransactionResource::make($sale) : null]);
    }

    public function store(Request $request, Product $product)
    {
        $sale = Sale::getTransaction();
        $sale->transactions($product);
        $request->product = $product;
        return new TransactionResponse($sale);
    }
}
