<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        if(request()->wantsJson()){
            return ProductResource::collection(Product::paginate(18));
        }
        return view('products.index');
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        $this->validateProduct($request);
        return Product::create($request->all());
    }
    public function validateProduct($request)
    {
        return $request->validate([
            'sku' => $request->id
                ? "unique:products,sku,$request->id|required" : 'unique:products,sku|required',
            'description' => 'required',
            'wholesale_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'distributor_price' => 'required|numeric'
        ], [
            'description.required' => 'La descripción es requerida',
            'sku.required' => 'El SKU es requerido',
            'sku.unique' => 'El SKU ya existe en la base de datos',
            'wholesale_price.required' => 'El precio al por mayor es requerido',
            'wholesale_price.numeric' => 'El precio al por mayor debe ser un valor númerico',
            'retail_price.required' => 'El precio al por menor es requerido',
            'retail_price.numeric' => 'El precio al por menor debe ser un valor númerico',
            'distributor_price.required' => 'El precio distribuidor es requerido',
            'distributor_price.numeric' => 'El precio distribuidor debe ser un valor númerico',

        ]);
    }
}