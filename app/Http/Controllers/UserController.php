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
        ], [
            'roles.*.exists' => 'El rol seleccionado es inválido.',
            'inventory_id.exists' => 'El inventario seleccionado es inválido.',
            'password.required_with' => 'La contraseña es requerida cuando se proporciona la confirmación de contraseña.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'email.unique' => 'El correo electrónico ya está en uso por otro usuario.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.string' => 'El correo electrónico debe ser una cadena de texto.',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',

        ]);
        $data =  $fields->validate();
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->inventory_id = $data['inventory_id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->syncRoles($data['roles']);
        return $user->save();
    }
}
