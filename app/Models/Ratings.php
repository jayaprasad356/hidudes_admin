<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $fillable = [
        'user_id','call_user_id','ratings','title','description',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
    public function callusers()
    {
        return $this->belongsTo(Users::class, 'call_user_id'); // Assuming the foreign key is 'call_user_id'
    }
}   
