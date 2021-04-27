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
        return view('inventories.index', ['inventories' => Inventory::all()]);
    }
    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
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
        return InventoryResource::make(Inventory::include()->where('id', $inventory->id)->first());
    }
}
