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
        $this->authorize('viewAny',new Inventory);
        if(request()->wantsJson()){
            return response()->json([
                'data' => Inventory::all()
            ]);
        }
        return view('inventories.index', ['inventories' => Inventory::all()]);
    }
    public function create()
    {
        $this->authorize('create',new Inventory);
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create',new Inventory);
        $fields = $request->validate([
            'name' => ['required', 'unique:inventories,name'],
            'address' => ['required']
        ]);
        return Inventory::create($fields);
    }

    public function edit(Inventory $inventory, Request $request)
    {
    }

    public function update(Inventory $inventory, Request $request)
    {
    }

    public function destroy(Inventory $inventory)
    {
    }

    public function show(Inventory $inventory)
    {
        $this->authorize('view',$inventory);
        return InventoryResource::make(Inventory::include()->where('id', $inventory->id)->first());
    }
}
