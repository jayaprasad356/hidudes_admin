<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admins';

    protected $table = 'admins';


    protected $fillable = [
        'email', 
        'password', 
        'is_active', 
        'is_disable', 
        'is_login_enable', 
        'type',
    ];

    public function creatorId()
{
    return $this->creator_id;  // assuming 'creator_id' is a column in the admins table
}

public function creator()
{
    return $this->belongsTo(Admin::class, 'creator_id');
}

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($email)
    {
        return $this->where('email', $email)->first();
    }
    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }
    
    public function currentLanguage()
{
    // Assuming there's a 'language' column in the 'admins' table
    return $this->language ?? 'en'; // Default to 'en' if not set
}

}
