<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'refill',
        'fail',
        'status_handle',
        'details',
        'history_api_provider',
        'is_active_provider',
        'order_more_quantity',
        'order_more_id',
        'sync_api',
        'api_detail',
        'partialed',
        'partial',
        'admin_manual',
        'no_balance_api',
        'user_id',
        'service_id',
        'api_orderid',
        'order_error',
        'order_detail',
        'order_api',
        'api_serviceid',
        'api_charge',
        'api_currencycharge',
        'order_profit',
        'order_quantity',
        'order_extras',
        'order_charge',
        'order_charge_before',
        'dripfeed',
        'dripfeed_id',
        'subscriptions_id',
        'subscriptions_type',
        'dripfeed_totalcharges',
        'dripfeed_runs',
        'dripfeed_delivery',
        'dripfeed_interval',
        'dripfeed_totalquantity',
        'dripfeed_status',
        'order_url',
        'order_start',
        'order_finish',
        'order_remains',
        'order_create',
        'order_status',
        'subscriptions_status',
        'subscriptions_username',
        'subscriptions_posts',
        'subscriptions_delivery',
        'subscriptions_delay',
        'subscriptions_min',
        'subscriptions_max',
        'subscriptions_expiry',
        'last_check',
        'order_where',
        'currentmillis',
        'schedule',
        'loop',
        'schedule_time',
        'id_order_loop',
        'loop_remaining'
    ];

    protected $casts = [
        'history_api_provider' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function order_loop()
    {
        return $this->belongsToMany('App\Model\Order', 'orders_loop', 'id_order', 'id_order_loop');
    }

    public function service()
    {
        return $this->belongsTo('App\Model\Service', 'service_id');
    }
}
