<?php

namespace App\Services\Implments;

use App\Repositories\UserRepo;
use App\Services\UserService;

class UserServiceImpl implements UserService
{

    protected $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function CreateUser(String $name, String $email, String $password)
    {
        return $this->userRepo->createUser($name, $email, $password);
    }
}
