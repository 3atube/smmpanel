<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admins';

    protected $fillable = [
        'name', 'email', 'password', 'count_order', 'ip_login', 'verify_code', 'admin_level', 'send_email'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
