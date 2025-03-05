<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPrice extends Model
{
    protected $table = 'user_prices';
    public $timestamps = false;
    protected $fillable =[
        'user_id',
        'service_id',
        'service_price',
    ];
}