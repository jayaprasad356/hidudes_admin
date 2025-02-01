<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Not_repeat_call_users extends Model
{
    use HasFactory;

    protected $table = 'not_repeat_call_users';

    protected $fillable = [
        'user_id',
        'call_user_id',
        'reason',
        'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
