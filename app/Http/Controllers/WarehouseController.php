<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('warehouses.index', ['inventories' => $inventories]);
    }
    
    public function edit(Inventory $inventory)
    {
        return view('warehouses.edit',compact('inventory'));
    }
    public function update(Inventory $inventory)
    {
        
        $fields = request()->validate([
            'name' => ['required',Rule::unique('inventories')->ignore($inventory->id)],
            'address' => ['required']
        ]);

        return response()->json([
            'updated' => $inventory->update($fields)
        ]);
    }
    public function destroy(Inventory $inventory)
    {
        if ($inventory->hasStock()) {
            return response()->json([
                'message' => 'El inventario tiene existencias, no se puede eliminar',
                'deleted' => false
            ]);
        }
        $inventory->products()->detach();
        return response()->json(['deleted' => $inventory->delete()]);
    }
}
