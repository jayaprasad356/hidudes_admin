<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Users extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'users';
    protected $table = 'users';


    protected $fillable = [
        'name', 'email', 'mobile', 'age', 'profile', 'gender', 'refer_code', 
        'referred_by', 'profession_id', 'datetime', 'points', 'total_points', 
        'state', 'city', 'unique_name', 'verified', 'last_seen', 'online_status',
        'cover_img', 'dummy', 'introduction', 'message_notify', 'add_friend_notify',
        'view_notify', 'profile_verified', 'cover_img_verified', 'verification_end_date',
        'language', 'voice', 'describe_yourself', 'interests', 'status','balance','audio_status','video_status','bank','branch','ifsc','account_num','holder_name','total_income','attended_calls','missed_calls','avg_call_percentage','blocked',
    ];

    public function avatar()
    {
        return $this->belongsTo(Avatars::class, 'avatar_id');
    }

  
    public $timestamps = true;

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

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
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
 
    public function getJWTCustomClaims()
    {
        return [];
    }
    // public function authenticate($payload)
    // {
    //     return $this->where('mobile', $payload['mobile'])->first();
    // }
}
