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
        'key_api',
        'name',
        'avatar',
        'email', 
        'password',
        'provider_id',
        'provider',
        'phone',
        'created_at',
        'updated_at',
        'balance',
        'spent',
        'debit_limit',
        'user_type',
        'balance_type',
        'currency', 
        'status', 
        'remember_token', 
        'email_verified_at',
        'log',
        'time_zone',
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
}
