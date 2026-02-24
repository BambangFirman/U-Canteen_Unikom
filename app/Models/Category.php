<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'categoryName',
        'desc',
        'created_at'
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'category_id','id');
    }
}
