<?php

namespace App\Http\Controllers;

use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        if (request()->wantsJson())
            return response()->json([
                'data' => Role::all('name', 'id')
            ]);
    }
    public function create()
    {
        return view('auth.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        try {
            $role = Role::create(['name' => $request->name]);
            return $role;
        } catch (RoleAlreadyExists $e) {
            throw ValidationException::withMessages([
                'name' => ['El rol ya existe en la base de datos.']
            ]);
            return false;
            //return ['role' => $e->getMessage()];// or use your own message
        }
    }
}
