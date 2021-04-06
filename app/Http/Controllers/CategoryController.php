<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $this->authorize('view',new Category);
        $categoryQuery = Category::query();
        return CategoryResource::collection($categoryQuery->applyFilters()->paginate(20));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|unique:categories,name"
        ], [
            'name.required' => "El campo categoría es requerido.",
            'name.unique' => "La categoría ya existe en la base de datos."
        ]);

        $this->authorize('create',new Category);

        return Category::create([
            'name' => $request->name
        ]);
    }

}
