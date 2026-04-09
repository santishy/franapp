<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', new User);

        if (request()->wantsJson()) {
            return User::with('roles:name,id')->orderBy('id', 'desc')->get();
        }
        return view('users.index');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles  = Role::all('name', 'id');
        $inventories = Inventory::all();
        $user = $user->with('roles:id,name')->where('id', $user->id)->first();
        return view('users.edit', compact('user', 'roles', 'inventories'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $fields = Validator::make($request->all(), [
            'name' => ['string', 'max:255'],
            'inventory_id' => ['integer', 'exists:inventories,id', 'nullable'],
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'password' => ['string', 'min:8', 'confirmed', 'required_with:password_confirmation'],
            'roles.*' => 'exists:roles,id'
        ]);
        $data =  $fields->validate();
        $user->password = bcrypt($data['password']);
        $user->inventory_id = $data['inventory_id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->syncRoles($data['roles']);
        return $user->save();
    }
}
