<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsSearchController extends Controller
{
    public function index(Request $request)
    {
        return ProductResource::collection(
            Product::applyFilters()->paginate(6)
            //Product::where('sku', 'like', "%$request->sku%")->paginate(6)
        );
    }
}
