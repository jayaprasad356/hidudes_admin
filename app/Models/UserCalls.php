<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCalls extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'call_user_id',
        'type',
        'started_time',
        'ended_time',
        'coins_spend',
        'income',
        'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
   
    public function callusers()
    {
        return $this->belongsTo(Users::class, 'call_user_id'); // Assuming the foreign key is 'call_user_id'
    }
}
