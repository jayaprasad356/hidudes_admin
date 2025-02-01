<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cron_jobs_update extends Model
{
    use HasFactory;

    protected $table = 'cron_jobs_update';

    protected $fillable = [
        'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
