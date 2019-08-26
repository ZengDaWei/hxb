<?php

namespace App\Services;

interface UserService
{
    public function CreateUser(String $name, String $email, String $password);
}
