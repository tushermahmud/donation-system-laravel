<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
    protected $fillable = [
        'name', 'email', 'password','slug','role','avater','verify_token','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function donations(){
        return $this->hasMany(Donation::class,'entrepreneur_id');
    }
    public function orders(){
        return $this->hasMany(Order::class,'entrepreneur_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'entrepreneur_id');
    }
    public function getRouteKeyName() {
        return 'slug';
    }
    public function messages(){
        return hasMany(Message::class);
    }
    
}
