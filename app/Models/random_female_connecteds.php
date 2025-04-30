<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class random_female_connecteds extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'female_user_id',
        'connected_time',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
   
    public function callusers()
    {
        return $this->belongsTo(Users::class, 'female_user_id'); // Assuming the foreign key is 'call_user_id'
    }
}
