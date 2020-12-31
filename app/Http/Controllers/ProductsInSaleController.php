<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsInSaleController extends Controller
{
    public function store(Product $product){

        
        return $product;
    }
}
