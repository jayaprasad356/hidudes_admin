<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'title',
        'description',
        'datetime',
        'gender',
        'language',
        'logo',
        'image',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
} 
