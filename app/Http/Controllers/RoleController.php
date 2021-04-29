<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        if (request()->wantsJson())
            return response()->json([
                'data' => Role::all()->pluck('name','id'),

            ]);
    }
    public function create()
    {
        $permissions = Permission::all('name', 'id');
        $roles = Role::all('name', 'id');
        return view('auth.roles.create', compact('permissions', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        try {
            $role = Role::create(['name' => $request->name]);
            return $role->only('id', 'name');
        } catch (RoleAlreadyExists $e) {
            throw ValidationException::withMessages([
                'name' => ['El rol ya existe en la base de datos.']
            ]);
            return false;
        }
    }

    public function show(Role $role)
    {
        return response()->json(['data' => $role->include()->where('id',$role->id)->first()]);
    }
}