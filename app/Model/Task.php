<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'user_id',
        'order_id',
        'service_id',
        'type',
        'task_type',
        'task_status',
        'task_date',
        'refill_orderid',
        'details',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Model\Order', 'order_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Model\Service', 'service_id');
    }
}
