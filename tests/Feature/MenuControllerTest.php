<?php

namespace Tests\Feature;

use App\Service\MenuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class MenuControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from menus');
    }

    public function testAddSuccess()
    {
        $img = UploadedFile::fake()->image('test_image.png');

        $this->withSession([
            'user' => 'Asep Yaman Suryaman'
        ])->post('/menu-add',[
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Mie Kuah Cakalang',
            'category' => '9f6c52bb-f567-4d31-bb76-4dc95722a866',
            'shop' => '928f0b69-5760-40d8-9420-c09f8db2743b',
            'price' => 12000,
            'desc' => 'Mie kuah cakalang: hidangan lezat dengan kuah gurih dan cita rasa cakalang yang khas',
            'img' => $img
        ])->assertSessionHas('success', 'Data menu berhasil di tambahkan')
            ->assertRedirect('/menu-add');
    }


}
