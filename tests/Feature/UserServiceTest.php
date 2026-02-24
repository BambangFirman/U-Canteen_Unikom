<?php

namespace Tests\Feature;

use App\Http\Requests\UserRequest;
use App\Service\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
//        DB::delete('delete from users');
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);
        $result = $this->userService->login('10122027', 'rahasia');

        self::assertTrue($result);
    }

    public function testLoginFailed()
    {
        $this->seed(UserSeeder::class);
        $result = $this->userService->login('gagal', 'rahasia');

        self::assertFalse($result);
    }

    public function testLogout()
    {
        Session::put([
            'name' => 'asep yaman suryaman',
            'username' => 'ujang'
        ]);

        self::assertEquals('asep yaman suryaman', Session::get('name'));
        self::assertEquals('ujang', Session::get('username'));

        $this->userService->logout();

        self::assertNull(Session::get('name'));
        self::assertNull(Session::get('username'));
    }


}
