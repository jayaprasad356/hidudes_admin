<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appsettings extends Model
{
    protected $fillable = [
          'link', 'app_version','description','bank','upi',
    ];
}   
