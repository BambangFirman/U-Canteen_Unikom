<?php

namespace Tests\Feature;

use App\Service\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingletonTest extends TestCase
{

    public function testSingleton()
    {
        $instance1 = $this->app->make(UserService::class);
        $instance2 = $this->app->make(UserService::class);

        self::assertSame($instance1, $instance2);

    }
}
