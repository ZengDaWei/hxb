<?php

namespace App\Services;

interface UserService
{
    public function CreateUser($name, $email, $password);
}
