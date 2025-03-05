<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;
use App\Model\Order;

class Provider extends Model
{
    protected $table = 'service_api';
    protected $fillable = [
        'api_name',
        'api_url',
        'api_key', 
        'api_type', 
        'api_limit', 
        'api_alert', 
        'balance', 
        'currency', 
        'type_api',
        'user',
        'token',
        'password',
    ];

    protected static function boot()
    {
        parent::boot();
        self::updated(function ($model) {
            $oldApiKey = $model->getOriginal('api_key');
            $newApiKey = $model->api_key;
            if ($oldApiKey != $newApiKey) {
                $order = Order::where('history_api_provider', 'like', '%'.$oldApiKey.'%')->orderBy('id', 'desc')->first();
                if($order){
                    Order::where('history_api_provider', 'like', '%'.$oldApiKey.'%')->update(
                        [
                            "history_api_provider" => DB::raw("REPLACE(history_api_provider,  '".$oldApiKey."', '".$newApiKey."')"),
                            "api_detail" => DB::raw("REPLACE(api_detail,  '".$oldApiKey."', '".$newApiKey."')")
                        ]
                    );
                }
            }
        });
    }
    
}