<?php

namespace App;

//vendor
use Laravel\Passport\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

    use HasApiTokens, Notifiable;

    

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "user";
 
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
}
