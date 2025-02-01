<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DeletedUsers extends Authenticatable
{
    use Notifiable;

    protected $guard = 'deleted_users';

    protected $table = 'deleted_users';


    protected $fillable = [
        'name', 'avatar_id', 'mobile', 'coins', 'total_coins','language','user_id','delete_reason', // Add 'mobile' to the fillable fields
    ];

    public function avatars()
    {
        return $this->belongsTo(Avatars::class, 'avatar_id');
    }

  
    public $timestamps = true;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($mobile)
    {
        return $this->where('mobile', $mobile)->first();
    }
    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }
}
