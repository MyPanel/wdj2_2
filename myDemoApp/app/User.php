<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){
<<<<<<< HEAD
        return $this->hasMany(Question::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
=======
        return $this->hasMany(Question::class,'user_email', 'email');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'user_email', 'email');
    }

>>>>>>> 2b15fd97ce299bc783a96ad441a23c2ce84951b1
}
