<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Http\Resources\InventoryProductStockResource;

class ProductStockController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $products = Product::with('category')
                ->withTotalStock()
                ->applyFilters()
                ->orderBy('description');

            $data = [
                'products' => ProductResource::collection($products->paginate(25)),
            ];

            if ($request->integer('page', 1) === 1) {
                $data['total_stocks'] = DB::table('inventory_product')->sum('stock');
            }

            return response()->json($data);
        }
        return 'No se puede mostrar esta información';
    }
    public function show(Product $product)
    {
        $productWithStock = Inventory::withProductStock($product->id)
            ->select('inventories.*', DB::raw('COALESCE(inventory_product.stock,0) as stock'))->get();
        return InventoryProductStockResource::collection($productWithStock);
    }
}
