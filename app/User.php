<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
      'avatar'
    ];


    public function picture ()
    {
        return $this->hasOne(UserAvatar::class, 'user_id', 'id');
    }

    public function getAvatarAttribute ()
    {
        if($this->relationLoaded('picture') && $this->picture) {
            return $this->picture->url;
        }
        return asset('/assets/images/avatar.jpg');
    }
}
