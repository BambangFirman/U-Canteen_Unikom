<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testSave()
    {
        $category = new Category();
        $category->id = Uuid::uuid4()->toString();
        $category->categoryName = 'Ujang';
        $category->created_at = now();
        $category->desc = 'Kategori makanan "Aneka Nasi" menyajikan variasi nasi lezat dengan beragam pilihan hidangan';
        $category->save();

        $result = Category::query()->where('categoryName', '=', 'Aneka Nasi')->first();

        self::assertEquals('Aneka Nasi', $result->categoryName);

    }


}
