<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatars extends Model
{
    protected $fillable = [
        'image',
        'gender',
    ];
    public function customers()
    {
        return $this->hasMany(Customers::class, 'avatar_id');
    }

}
