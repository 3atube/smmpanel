<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Balance extends Model
{
    public $timestamps = false;
    protected $table = 'balance';
    protected $fillable = [
        'user_id',
        'check_insert',
    ];
    
}