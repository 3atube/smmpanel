<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class CashFlow extends Model
{
    protected $table = 'cash_flows';
    protected $fillable = [
        'user_id',
        'order_id',
        'type',
        'total_cash',
        'cash',
        'type_cash',
        'currentmillis'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Model\Order','order_id');
    }
}