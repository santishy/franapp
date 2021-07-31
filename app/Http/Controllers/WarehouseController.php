<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('warehouses.index',['inventories' => $inventories]);
    }
    public function destroy(Inventory $invetory){
        
    }
}
