<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    protected $table = 'checkouts';
    protected $primaryKey = 'id';
    protected $keyType = 'char';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'invoice',
        'menu_id',
        'user_id',
        'billing_method',
        'pickup_time',
        'quantity'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
