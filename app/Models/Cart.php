<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id';
    protected $keyType = 'char';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'quantity'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cart_items(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menus_carts', 'cart_id', 'menu_id')
            ->withPivot('menu_id', 'cart_id');
    }
}
