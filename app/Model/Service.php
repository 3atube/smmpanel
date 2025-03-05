<?php

namespace App\Model;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;
use App\Model\Provider;
use App\Model\Order;
class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'mode',
        'status',
        'category_line',
        'reviews',
        'quality',
        'service_api',
        'api_service',
        'api_servicetype',
        'speed_per_day',
        'guarantee',
        'start_time',
        'api_detail',
        'category_id',
        'service_line',
        'service_type',
        'service_package',
        'service_name',
        'service_description',
        'service_price',
        'sync_price',
        'sync_rate',
        'service_min',
        'sync_min',
        'service_max',
        'sync_max',
        'service_dripfeed',
        'service_autotime',
        'service_autopost',
        'service_speed',
        'want_username',
        'service_secret',
        'price_type',
        'price_cal',
        'start_count',
        'instagram_private',
        'order_status',
        'name_lang',
        'description_lang',
        'cancel_type',
        'refill_type',
        'refill_time',
        'sync_lastcheck',
        'provider_lastcheck'
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Model\Provider', 'service_api');
    }

    protected static function boot()
    {
        parent::boot();
        /*
        self::updated(function ($model) {
            $oldServiceApi = $model->getOriginal('service_api');
            $newServiceApi = $model->service_api;
            if ((int) $oldServiceApi != (int) $newServiceApi) {
                $providerNew = Provider::find($newServiceApi);
                $apiNew = [
                    'api_url' => $providerNew->api_url,
                    'api_key' => $providerNew->api_key,
                    'type_api' => $providerNew->type_api,
                ];
                $orders = Order::where('service_id', $model->id)->whereNotNull('history_api_provider')->whereIn('order_status', ['fail', 'pending', 'inprogress', 'partial', 'processing', 'refill'])->orderBy('id', 'desc')->get();
                foreach ($orders as $order) {
                    $historyApiProvider = $order->history_api_provider;
                    //check apiNew in historyApiProvider
                    $checkApiNew = false;
                    foreach ($historyApiProvider as $history) {
                        if($history['api_url'] == $apiNew['api_url'] && $history['api_key'] == $apiNew['api_key'] && $history['type_api'] == $apiNew['type_api']){
                            $checkApiNew = true;
                            break;
                        }
                    }
                    if($checkApiNew === false){
                        array_push($historyApiProvider, $apiNew);
                        Log::info('update service_id: '.$model->id.' history_api_provider: '.json_encode($historyApiProvider));
                        $order->update(['history_api_provider' => $historyApiProvider]);
                    }
                }
            }
        });
        */
    }
}
