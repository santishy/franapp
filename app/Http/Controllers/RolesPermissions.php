<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissions extends Controller
{
    public function store(Request $request,Role $role)
    {
        $role->givePermissionTo($request->permission_id);
    }
}
