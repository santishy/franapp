<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){

    }
    public function create(){
        return view('inventories.create');
    }

    public function store(Request $request){
        $fields = $request->validate([
            
        ]);
    }

    public function edit(Inventory $inventory,Request $request){

    }

    public function update(Inventory $inventory,Request $request){}

    public function destroy(Inventory $inventory){}

    public function show(Inventory $inventory){}
    
}
