<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('warehouses.index', ['inventories' => $inventories]);
    }
    public function destroy(Inventory $inventory)
    {
        if ($inventory->hasStock()) {
            return response()->json([
                'message' => 'El inventario tiene existencias, no se puede eliminar',
                'deleted' => false
            ]);
        }
        return response()->json(['delete' => $inventory->delete()]);
    }
}
