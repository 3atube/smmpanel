<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'user_balance',
        'payment_amount', 
        'papara_amount', 
        'payment_privatecode', 
        'payment_method', 
        'payment_status', 
        'payment_delivery', 
        'payment_note',
        'payment_mode',
        'payment_ip',
        'payment_extra',
        'payment_bank',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function payment_methods()
    {
        return $this->belongsTo('App\Model\PaymentMethod', 'payment_method');
    }

    public function payment_banks()
    {
        return $this->belongsTo('App\Model\BankAccount', 'payment_bank');
    }
}