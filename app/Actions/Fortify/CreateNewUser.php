<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules,AuthorizesRequests;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $this->authorize('create',new User);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'inventory_id' => ['required'],
            'password' => $this->passwordRules(),
            'roles.*' => 'exists:roles,id'
        ])->validate();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'inventory_id' => $input['inventory_id'],
        ]);
        return $user->assignRole(request()->roles);


    }

}
