<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScreenNotifications extends Model
{
    protected $fillable = [
        'title',
        'description',
        'time',
        'gender',
        'language',
        'logo',
        'image',
        'day',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
} 
