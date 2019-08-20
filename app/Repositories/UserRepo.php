<?php

namespace App\Repositories;

use App\User;

trait UserRepo
{
    public function createUser($name, $email, $password)
    {
        return User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
        ]);
    }

}
