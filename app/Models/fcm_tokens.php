<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fcm_tokens extends Model
{
    protected $fillable = [
        'user_id','token',
    ];
    
    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}   
