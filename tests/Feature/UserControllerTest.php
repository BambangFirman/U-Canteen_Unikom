<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Service\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'username' => 'asep',
            'password' => 'rahasia'
        ])->assertRedirect('/');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'username' => 'salah',
            'password' => 'rahasia'
        ])->assertRedirect('/login')
            ->assertSessionHas('error', 'Username atau password salah!');
    }

    public function testLogout()
    {
        $this->withSession([
            'name' => 'asep yaman suryaman',
            'username' => 'ujang'
        ])->post('/logout')
            ->assertSessionMissing(['name', 'username'])
            ->assertRedirect('/login');
    }


}
