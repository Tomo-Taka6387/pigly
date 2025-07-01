<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Http\Requests\LoginRequest;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input)
    {
        $loginRequest = new LoginRequest();

        Validator::make($input, $loginRequest->rules(), $loginRequest->messages())->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],

            'password' => Hash::make($input['password']),
        ]);
    }
}
