<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * gate::authorize ahi que usar ese ... para las existencias y corregir las politicas para existencias y almacenes
     */
    public function index()
    {
        $this->authorize('viewAny', new Inventory);
        $inventories = Inventory::all();
        return view('warehouses.index', ['inventories' => $inventories]);
    }

    public function edit(Inventory $inventory)
    {   
        //Lo deje como view, ya que tiene que ver UN almacen en especifico
        $this->authorize('view',new Inventory);

        return view('warehouses.edit', compact('inventory'));
    }
    public function update(Inventory $inventory)
    {
        $this->authorize('update',new Inventory);
        $fields = request()->validate([
            'name' => ['required', Rule::unique('inventories')->ignore($inventory->id)],
            'address' => ['required']
        ]);

        return response()->json([
            'updated' => $inventory->update($fields)
        ]);
    }
    public function destroy(Inventory $inventory)
    {
        $this->authorize('delete',new Inventory);
        if ($inventory->hasStock()) {
            return response()->json([
                'message' => 'El inventario tiene existencias, no se puede eliminar, se tiene que vaciar el almacén previo a eliminarlo.',
                'deleted' => false
            ]);
        }
        $inventory->products()->detach();
        return response()->json(['deleted' => $inventory->delete()]);
    }
}
