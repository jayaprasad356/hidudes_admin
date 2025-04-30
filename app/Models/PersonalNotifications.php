<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalNotifications extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'datetime',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
} 
