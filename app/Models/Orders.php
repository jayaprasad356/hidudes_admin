<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coins_id',
        'order_id',
        'price',
        'status',
        'datetime',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
    public function coins()
    {
        return $this->belongsTo(Coins::class, 'coins_id');
    }

}
