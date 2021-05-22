<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $this->authorize('view',new Product());
        if (request()->wantsJson()) {
            return ProductResource::collection(Product::applyFilters()->paginate(21));
        }
        return view('products.index');
    }
    public function create()
    {
        $this->authorize('create',new Product());

        $categories = Category::all();
        return view('products.create',compact('categories'));
    }
    public function store(Request $request)
    {
        
        $this->authorize('create',new Product());
        $this->validateProduct($request);
        return Product::create($request->all());
    }
    public function edit(Product $product)
    {
        $this->authorize('update',$product);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $this->authorize('update',$product);
        $this->validateProduct($request);
        $product->update($request->except('_method'));
        return ProductResource::make($product);
    }
    public function destroy(Product $product)
    {
        $this->authorize('delete',$product);
        return $product->delete();
    }
    public function validateProduct($request)
    {
        return $request->validate([
            'sku' => $request->id
                ? "unique:products,sku,$request->id|required" : 'unique:products,sku|required',
            'description' => 'required',
            'wholesale_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'distributor_price' => 'required|numeric',
            'category_id' => 'required|numeric'
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
            'category_id.requerid' => 'La categoría es obligatoría.',
            'category_id.numeric' => 'El identificador de la categoría debe ser numerico.',
        ]);
    }
}
