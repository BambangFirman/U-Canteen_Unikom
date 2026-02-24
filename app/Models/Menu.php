<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $keyType = 'char';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'menuName',
        'category_id',
        'price',
        'desc',
        'img',
        'shop_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'menus_carts','menu_id', 'cart_id')
            ->withPivot('menu_id', 'cart_id');
    }



}
