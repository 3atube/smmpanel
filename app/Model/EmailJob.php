<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailJob extends Model
{
    protected $table = 'email_jobs';
    protected $fillable =[
        'content',
        'user_id',
        'status',
    ];
}
