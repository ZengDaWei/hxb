<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Str;

class UserRepo
{
    public function createUser($name, $email, $password)
    {
        return User::create([
            'name'      => $name,
            'email'     => $email,
            'password'  => $password,
            'api_token' => Str::random(45),
        ]);
    }
}
