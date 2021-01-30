<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Resources\ProductResource;

use App\Http\Responses\TransactionResponse;

class ProductInSaleController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $sale = Sale::getTransaction();
        $sale->transactions($product);
        $request->product = $product;
        return new TransactionResponse($sale);
    }
}
