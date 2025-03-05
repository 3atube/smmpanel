<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    protected $fillable = [
        'method_name',
        'method_get',
        'method_min', 
        'method_max', 
        'method_type', 
        'method_extras', 
        'method_line', 
    ];
    
}