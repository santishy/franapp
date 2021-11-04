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
        $this->authorize('view', new Product());
        if (request()->wantsJson()) {
            return ProductResource::collection(Product::with('category')->applyFilters()->paginate(21));
        }
        $categories = Category::all();
        return view('products.index', compact('categories'));
    }
    public function create()
    {
        $this->authorize('create', new Product());

        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $this->authorize('create', new Product());
        $this->validateProduct($request);

        $product = new Product($request->except('image'));

        $product->image = $product->uploadImage();



        $product->save();

        return $product;

        return Product::create($request->all());
    }
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('products.edit', compact('categories', 'product'));
    }
    public function update(Request $request, Product $product)
    {

        $this->authorize('update', $product);
        $this->validateProduct($request);
        $data['image'] = $product->uploadImage();

        $product->update(array_merge( $request->except('_method'),$data));
        return ProductResource::make($product);
    }
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        if ($product->purchases()->exists())
            return response()->json(['message' => 'No se puede eliminar, existen compras con este producto.']);
        if ($product->sales()->exists())
            return response()->json(['message' => 'No se puede eliminar, existen ventas con este producto.']);
        return response()->json(['deleted' => $product->delete()]);
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
            'category_id' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
            'image.image' => 'El archivo enviado no es una imagén valida.',
            'image.max' => 'El archivo excede el tamaño establecido para la imagen.'
        ]);
    }
}
