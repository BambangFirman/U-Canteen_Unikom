<?php

namespace Tests\Feature;

use App\Service\MenuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class MenuServiceTest extends TestCase
{
    private MenuService $menuService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->menuService = $this->app->make(MenuService::class);

        DB::delete('delete from menus');
    }

    public function testSaveSuccess()
    {
        $img = UploadedFile::fake()->image('test_image.png');

        $data = [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Mie Kuah Cakalang',
            'category' => '9f6c52bb-f567-4d31-bb76-4dc95722a866',
            'shop' => '928f0b69-5760-40d8-9420-c09f8db2743b',
            'price' => 12000,
            'desc' => 'Mie kuah cakalang: hidangan lezat dengan kuah gurih dan cita rasa cakalang yang khas',
            'img' => $img
        ];

        $result = $this->menuService->save($data);
        self::assertTrue($result);
    }


}
