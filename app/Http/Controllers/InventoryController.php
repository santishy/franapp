<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', new Inventory);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => Inventory::all()
            ]);
        }
        return view('inventories.index', ['inventories' => Inventory::all()]);
    }
    public function create()
    {
        $this->authorize('create', new Inventory);
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Inventory);
        $fields = $request->validate([
            'name' => ['required', 'unique:inventories,name'],
            'address' => ['required']
        ]);
        return Inventory::create($fields);
    }

    public function edit(Inventory $inventory, Request $request)
    {
    }
    /**
     * Update the stock of a product
     */
    public function update(Inventory $inventory, Request $request)
    {
        request()->validate([
            'product_id' => ['required', 'exists:products,id'],
            'stock' => ['min:0', 'required', 'numeric']
        ], [
            'stock.required' => 'Las existencias son requiredas.',
            'stock.min' => 'Las existencias deben ser al menos cero',
            'stock.numeric' => 'El tipo de dato debe ser númerico'
        ]);

        $updated = $inventory->updateStock(request('product_id'), request('stock'));

        return response()->json([
            'newStock' => request('stock')
        ]);
    }

    /**
     * Empty stocks
     */
    public function destroy(Inventory $inventory)
    {
        return response()->json(['empty' => $inventory->epmtyStock()]);
    }

    public function show(Inventory $inventory)
    {
        $this->authorize('view', $inventory);

        return ProductResource::collection(
            $inventory->products()->applyFilters()->paginate(25)
        );
        // return InventoryResource::make(
        //     $inventory->include()->where('id', $inventory->id)->first()
        // );
    }
}
