<?php

namespace App\Service\Impl;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserServiceImpl implements UserService
{
    public function login(string $username, string $password): bool
    {
        return Auth::attempt([
            'username' => $username,
            'password' => $password
        ]);
    }

    public function forgotPassword(string $email): bool
    {
        // TODO: Implement forgotPassword() method.
    }

    public function logout(): void
    {
        Session::forget(['name', 'username']);
    }


}
