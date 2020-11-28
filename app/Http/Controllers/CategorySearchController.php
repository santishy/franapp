<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategorySearchController extends Controller
{
    public function index(Request $request){
        return Category::where('name','LIKE',"%{$request->name}%")->paginate();
    }
}
