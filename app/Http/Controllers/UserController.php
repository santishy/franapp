<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        if (request()->wantsJson()) {
            return User::with('roles:name,id')->orderBy('id', 'desc')->get();
        }
        return view('users.index');
    }

    public function edit(User $user)
    {
        $roles  = Role::all('name', 'id');
        $user = $user->with('roles:id,name')->where('id', $user->id)->first();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $fields = Validator::make($request->all(), [
            'name' => ['string', 'max:255'],
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'roles.*' => 'exists:roles,id'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles($request->roles);
        return $user->save();
    }
}
