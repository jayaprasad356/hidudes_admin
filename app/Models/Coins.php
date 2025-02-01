<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    protected $fillable = ['coins', 'price','save','popular','best_offer'];
}
