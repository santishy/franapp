<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Category);
        if (request()->wantsJson()) {
            $categoryQuery = Category::query();
            return CategoryResource::collection($categoryQuery->applyFilters()->orderBy('name')->get());
        }
        return view('categories.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|unique:categories,name"
        ], [
            'name.required' => "El campo categoría es requerido.",
            'name.unique' => "La categoría ya existe en la base de datos."
        ]);

        $this->authorize('create', new Category);

        return Category::create([
            'name' => $request->name
        ]);
    }

    public function create(){
        return view('categories.create');
    }

    public function edit(Category $category)
    {

        return view('categories.edit',compact('category'));
    }
}
