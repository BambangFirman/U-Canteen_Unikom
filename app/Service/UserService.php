<?php

namespace App\Service;

use App\Http\Requests\UserRequest;
use App\Models\User;

interface UserService
{

    public function login(string $username, string $password): bool;

    public function forgotPassword(string $email): bool;

    public function logout(): void;

}
