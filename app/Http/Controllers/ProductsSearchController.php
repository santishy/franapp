<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsSearchController extends Controller
{
    public function index(Request $request)
    {
        $paginator = Product::with('category')->applyFilters()->paginate(20);
        // llena el coleccionador con los productos y les hace visible el campo distributor_price
        $paginator->getCollection()->makeVisible(
            'distributor_price'
        );
        return ProductResource::collection(
            $paginator
        );
    }
}
