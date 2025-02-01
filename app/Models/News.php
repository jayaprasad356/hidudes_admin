<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'privacy_policy','support_mail','demo_video','minimum_withdrawals',
    ];
}   
