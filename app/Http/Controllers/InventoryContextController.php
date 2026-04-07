<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryContextController extends Controller
{
    public function show()
    {
        $inventories = Inventory::all();

        return view('inventories.select', compact('inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'exists:inventories,id|required',
        ], [
            'inventory_id.required' => 'El inventario es requerido.',
            'inventory_id.exists' => 'El inventario no existe en la base de datos.',
        ]);
        session(['inventory_id' => $request->inventory_id]);

        return response()->json(['message' => 'Inventario seleccionado correctamente.', 'inventory_id' => $request->inventory_id]);
    }
}
