<?php

namespace Tests\Feature;

use Database\Seeders\ShopSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from shops');

    }

    public function testAddSuccess()
    {
        $image = UploadedFile::fake()->image('test_img.png');

        $this->withSession([
            'user' => 'Asep Yaman Suryaman'
        ])->post('/shop-add',[
            'name' => 'mencintai',
            'img' => $image
        ])->assertSessionHas('success', 'Data berhasil di tambahkan');
    }

}
