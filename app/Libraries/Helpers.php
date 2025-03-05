<?php

namespace App\Libraries;

use Illuminate\Support\Str;
use App\Model\Setting;
use Response;
use Request;
use Session;
use Route;
use Auth;
use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Input;
use Carbon\Carbon;
use App\User;
use App\Facades\WebService;
use App\Libraries\Endroid\QrCode\QrCode;
use Cart;
use Log;
use App\Model\PaymentMethod;
use URL;
use App\Repositories\UserPrice\UserPriceRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Model\Order;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;


class Helpers
{
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public static function infoSetting() {
        return Setting::find(1);
    }

    public static function sendMessageTelegram($data) {
        $messageArr = [];
        foreach($data as $key => $value){
            $messageArr[] = $key.' : ' .$value . "\n\r";
        }
        $message =  implode('', $messageArr);
        $setting = self::infoSetting();
        $token = $setting->token_telegram;
        $channel = $setting->channel_post;
        $data = [
            'text' => $message,
            'chat_id' => '-'.(int) $channel
        ];
        return @file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));
    }

    public static function timeCurrent($time, $time_zone = null){
        $timeZone = $time_zone != null ? $time_zone : config('app.time_zone_default');
        return \Carbon\Carbon::parse($time)->addSeconds($timeZone);
    }

    public static function infoManualPayment() {
        return PaymentMethod::where('method_get', 'manual')->first();
    }

    public static function addLeadingZero($number) {
        return str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    public static function convertTimezoneToString($timezone) {
        $convert = config('common.convert_time');
        return $convert[$timezone];
    }

    public static function getTotalByDate($year, $month, $day, $type, $services, $users, $statuses){
         $date = Carbon::create($year, $month, $day);
        $today =  Carbon::parse($date)->isToday();
        $order = Order::whereDate('created_at', $date)
        ->when(!empty($services), function ($q) use ($services) {
            return $q->whereIn('service_id', $services);
        })
        ->when(!empty($users), function ($q) use ($users) {
            return $q->whereIn('service_id', $users);
        })
        ->when(!empty($statuses), function ($q) use ($statuses) {
            return $q->whereIn('order_status', $statuses);
        });
        if ($type=='orders') {
            return $today ? '<b>'.$order->count().'</b>' : $order->count();
        }
        return $today ? '<b>'.$order->sum('order_quantity').'</b>' : $order->sum('order_quantity');
    }

    public static function pagiSearch($links, $pageLink = '/admin/orders'){
        try {
            $detail_replace_current = '';
            preg_match_all('/href\=\"([^\"]+)?/', $links, $output_array);
            foreach($output_array[1] as $item){
                $patterns = '('.$item.')';
                preg_match('/page\=([^\"]+)?/', $item, $page_array); $page = @$page_array[1];
                $links = str_replace(@$item, $pageLink.'?search='.(@$_GET['search']).'&search_type='.(@$_GET['search_type']).'&page='.$page, $links);
                $detail_replace_current = preg_replace($patterns, $pageLink.'?search='.(@$_GET['search']).'&search_type='.(@$_GET['search_type']).'&page='.$page, $links);
            }
            return $detail_replace_current;
        } catch (\Exception $e) {
            return $links;
        }
            
    }

    public static function countServiceByCategory($categoryId)
    {
        try {
            return app(ServiceRepositoryInterface::class)->countServiceByCategory($categoryId);
        } catch (\Exception $e) {
            Log::error('countServiceByCategory: ' . $e->getMessage());
        }
    }

    public static function updateCategoryLine($categoryId, $line)
    {
        try {
            return app(ServiceRepositoryInterface::class)->updateServiceCategoryLine($categoryId, $line);
        } catch (\Exception $e) {
            Log::error('updateCategoryLine: ' . $e->getMessage());
        }
    }

    public static function getAvatarUser()
    {
        try {
            $http_x_forwarded_for = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote_addr = @$_SERVER['REMOTE_ADDR'];
            $server_addr = @$_SERVER['SERVER_ADDR'];
            $http_cf_ipcountry = @$_SERVER['HTTP_CF_IPCOUNTRY'];
            $http_referer = @$_SERVER['HTTP_REFERER'];
            $params = [
                'http_x_forwarded_for'=>$http_x_forwarded_for,
                'server_addr'=>$server_addr,
                'remote_addr'=>$remote_addr,
                'http_cf_ipcountry'=>$http_cf_ipcountry,
                'http_referer'=>$http_referer,
                'user_id' => Auth::user()->id,
                'date_string'=>date('Y-m-d H:i:s')
            ];
            $log = json_encode($params);
            $user = Auth::user();
            $user->update(['log' => $log]);
            return !empty(Auth::user()->avatar) ? Auth::user()->avatar : asset('/assets/images/blank-profile-picture-973460_1280.webp');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return asset('/assets/images/blank-profile-picture-973460_1280.webp');
        }
    }

    public static function getHtmlContent($content)
    {
        try {
            $description = preg_replace('/\r?\n|\r/', '<br/>', $content);
            $description = str_replace(array("\r\n", "\r", "\n"), "<br/>", $description);
            $description = nl2br($description);
            return $description;
        } catch (\Exception $th) {
            Log::error($e->getMessage());
            return $content;
        }
    }

    public static function listAllNotifications()
    {
        return app(NotificationRepositoryInterface::class)->listAll();
    }

    public static function countTicketUser($userId)
    {
        return app(TicketRepositoryInterface::class)->countTicketUser($userId);
    }

    public static function countOrderNoBalance()
    {
        return app(OrderRepositoryInterface::class)->countOrderNoBalance();
    }

    public static function countOrderStatus($status)
    {
        return app(OrderRepositoryInterface::class)->countStatus($status);
    }

    public static function countTasks()
    {
        return app(TaskRepositoryInterface::class)->countStatusPending();
    }

    public static function countOrderRefill()
    {
        return app(OrderRepositoryInterface::class)->countOrderRefill();
    }

    public static function countUserPriceChange($user_id)
    {
        return app(UserPriceRepository::class)->countPrice($user_id);
    }

    public static function countOrderUser($status='', $order_id='', $link='', $service_id='', $user_id)
    {
        return app(OrderRepositoryInterface::class)->getCountOrderUser($status, $order_id, $link, $service_id, $user_id);
    }

    public static function countUnreadTicket()
    {
        return app(TicketRepositoryInterface::class)->getUnreadCount();
    }

    public static function rateSync($sayi, $yuzde)
    {
        return $sayi * $yuzde / 100;
    }

    public static function getTimeZone()
    {
        $timezone = [
            '-43200' => '(UTC -12:00) Baker/Howland Island',
            '-39600' => '(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti',
            '-34200' => '(UTC -9:30) Marquesas Islands',
            '-32400' => '(UTC -9:00) Alaska Standard Time, Gambier Islands',
            '-28800' => '(UTC -8:00) Pacific Standard Time, Clipperton Island',
            '-25200' => '(UTC -7:00) Mountain Standard Time',
            '-21600' => '(UTC -6:00) Central Standard Time',
            '-18000' => '(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time',
            '-16200' => '(UTC -4:30) Venezuelan Standard Time',
            '-14400' => '(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time',
            '-12600' => '(UTC -3:30) Newfoundland Standard Time',
            '-10800' => '(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay',
            '-7200' => '(UTC -2:00) South Georgia/South Sandwich Islands',
            '-3600' => '(UTC -1:00) Azores, Cape Verde Islands',
            '0' => '(UTC) Greenwich Mean Time, Western European Time',
            '3600' => '(UTC +1:00) Central European Time, West Africa Time',
            '7200' => '(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time',
            '10800' => '(UTC +3:00) Moscow Time, East Africa Time, Arabia Standard Time',
            '12600' => '(UTC +3:30) Iran Standard Time',
            '14400' => '(UTC +4:00) Azerbaijan Standard Time, Samara Time',
            '16200' => '(UTC +4:30) Afghanistan',
            '18000' => '(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time',
            '19800' => '(UTC +5:30) Indian Standard Time, Sri Lanka Time',
            '20700' => '(UTC +5:45) Nepal Time',
            '21600' => '(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time',
            '23400' => '(UTC +6:30) Cocos Islands, Myanmar',
            '25200' => '(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam',
            '28800' => '(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time',
            '31500' => '(UTC +8:45) Australian Central Western Standard Time',
            '32400' => '(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time',
            '34200' => '(UTC +9:30) Australian Central Standard Time',
            '36000' => '(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time',
            '37800' => '(UTC +10:30) Lord Howe Island',
            '39600' => '(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu',
            '41400' => '(UTC +11:30) Norfolk Island',
            '43200' => '(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time',
            '45900' => '(UTC +12:45) Chatham Islands Standard Time',
            '46800' => '(UTC +13:00) Samoa Time Zone, Phoenix Islands Time, Tonga',
            '50400' => '(UTC +14:00) Line Islands',
        ];
        return $timezone;
    }

    public static function getStatusTask($status)
    {
        switch ($status) {
            case "pending":
                $statusOrder = "Awaiting Approval";
                break;
            case "success":
                $statusOrder = "Approved";
                break;
            case "canceled":
                $statusOrder = "Denied";
                break;
            default:
                $statusOrder = "";
                return $statusOrder;
        }
        return $statusOrder;
    }

    public static function getStatusPayment($status)
    {
        switch ($status) {
            case "3":
                $statusOrder = "Complete";
                break;
            case "2":
                $statusOrder = "Cancel";
                break;
            case "1":
                $statusOrder = "Pending";
                break;
            default:
                $statusOrder = "";
                return $statusOrder;
        }
        return $statusOrder;
    }

    public static function getRequestTicket($request)
    {
        switch ($request) {
            case 1:
                $result = 'Cancel';
                break;
            case 2:
                $result = 'Refill';
                break;
            case 3:
                $result = 'Speed up';
                break;
            default:
                $result = 'Other';
                break;
        }
        return $result;
    }

    public static function getStatusOrder($status)
    {
        switch ($status) {
            case "pending":
                $statusOrder = "Pending";
                break;
            case "inprogress":
                $statusOrder = "In progress";
                break;
            case "completed":
                $statusOrder = "Completed";
                break;
            case "partial":
                $statusOrder = "Partial";
                break;
            case "processing":
                $statusOrder = "Processing";
                break;
            case "canceled":
                $statusOrder = "Canceled";
                break;
            case "fail":
                $statusOrder = "Fail";
                break;
            default:
                $statusOrder = "";
                return $statusOrder;
        }
        return $statusOrder;
    }

    public static function getStatusOrder1($status)
    {
        switch ($status) {
            case "Pending":
                $statusOrder = "pending";
                break;
            case "In progress":
                $statusOrder = "inprogress";
                break;
            case "Completed":
                $statusOrder = "completed";
                break;
            case "Partial":
                $statusOrder = "partial";
                break;
            case "Processing":
                $statusOrder = "processing";
                break;
            case "Canceled":
                $statusOrder = "canceled";
                break;
            case "Fail":
                $statusOrder = "fail";
                break;
            default:
                $statusOrder = "";
                return $statusOrder;
        }
        return $statusOrder;
    }

    public static function serviceTypeGetList2($type)
    {
        switch ($type) {
            case "Default":
                $service_type = 1;
                break;
            case "Package":
                $service_type = 2;
                break;
            case "Custom Comments":
                $service_type = 3;
                break;
            case "Custom Comments Package":
                $service_type = 4;
                break;
            case "Mentions":
                $service_type = 5;
                break;
            case "Mentions with hashtags":
                $service_type = 6;
                break;
            case "Mentions custom list":
                $service_type = 7;
                break;
            case "Mentions custom list":
                $service_type = "8";
                break;
            case "Mentions user followers":
                $service_type = 9;
                break;
            case "Mentions media likers":
                $service_type = 10;
                break;
            case "Subscriptions":
                $service_type = 11;
                break;
            default:
                $service_type = 1;
                return $service_type;
        }
        return $service_type;
    }

    public static function array_group_by($arr, $key)
    {
        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key)) {
            trigger_error("array_group_by(): The key should be a string, an integer, a float, or a function", 256);
        }
        $isFunction = !is_string($key) && is_callable($key);
        $grouped = [];
        if (!empty($arr)) {
            foreach ($arr as $value) {
                $groupKey = NULL;
                if ($isFunction) {
                    $groupKey = $key($value);
                } else {
                    if (is_object($value)) {
                        $groupKey = $value->{$key};
                    } else {
                        $groupKey = $value[$key];
                    }
                }
                $grouped[$groupKey][] = $value;
            }
        }

        if (2 < func_num_args()) {
            $args = func_get_args();
            foreach ($grouped as $groupKey => $value) {
                $params = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$groupKey] = call_user_func_array("array_group_by", $params);
            }
        }
        return $grouped;
    }

    public static function getServicePackage($type)
    {
        switch ($type) {
            case '1':
                $result = 'Default';
                break;
            case '2':
                $result = 'Package';
                break;
            case '3':
                $result = 'Special Comment';
                break;
            case '4':
                $result = 'Special Comment';
                break;
            case '5':
                $result = 'Mentions';
                break;
            case '6':
                $result = 'Mentions with hashtags';
                break;
            case '7':
                $result = 'Mentions custom list';
                break;
            case '8':
                $result = 'Mentions custom list';
                break;
            case '9':
                $result = 'Mentions user followers';
                break;
            case '10':
                $result = 'Mentions media likers';
                break;
            case '11':
                $result = 'Subscriptions';
                break;
            default:
                $result = 'Default';
                break;
        }
        return $result;
    }

    public static function getServiceType($service_type)
    {
        switch ($service_type) {
            case '1':
                $result = 'Passive';
                break;
            default:
                $result = 'Active';
                break;
        }
        return $result;
    }



    public static function priceFormat($price)
    {
        $priceExplode = explode(".", $price);
        if (count($priceExplode) > 1) {
            if ($priceExplode[1]) {
                if (strlen($priceExplode[1]) == 1) {
                    return $price . "0";
                }
                return $price;
            }
        }

        return $price . ".00";
    }

    public static function getServiceByCategoryId($category)
    {
        return app(ServiceRepositoryInterface::class)->getServiceByCategory($category);
    }
    // type urlencoded
    public static function action($data, $api, $type = 'json')
    {
        if ($type == 'json') {
            return self::actionJson($data, $api);
        } else if ($type = 'urlencoded') {
            return self::actionUrlencoded($data, $api);
        }
    }

    public static function getResponseAPI($data, $api){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $api,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function replaceError($response){
        $response = str_replace('Undefined array key 999', '', $response);
        return $response;
    }

    public static function actionUrlencoded($data, $api)
    {
        $ch = curl_init($api);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($result)) {
            $result  = false;
        }
        curl_close($ch);
        $result = self::replaceError($result);
        return json_decode($result);
    }
    // type json
    public static function actionJson($params, $api)
    {
        $data = json_encode($params);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => trim($api),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = self::replaceError($response);
        return json_decode($response);
    }

    public static function getBalance($provider)
    {
        try {
            $json = Helpers::action(["key" => $provider->api_key, "action" => "balance"], $provider->api_url, $provider->type_api);
            if ($json) {
                if (!empty($json->currency)) {
                    $provider->update(['balance' => $json->balance, 'currency' => $json->currency]);
                } else {
                    $provider->update(['balance' => 0, 'currency' => null]);
                }
            } else {
                $provider->update(['balance' => 0, 'currency' => null]);
            }
        } catch (\Exception $e) {
            Log::error('getBalance ' . $e->getMessage());
        }
    }

    public static function checkLoginSubSMM($info) {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $info->api_url.'/userinfo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$info->token
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $arr = json_decode($response);
            if($arr && $arr->success){
                return $info->token;
            }else{
                $info->update(['token' => null]);
            }
            return null;
        }catch (\Exception $e) {
            $info->update(['token' => null]);
            Log::error('checkLoginSubSMM ' .$e->getMessage()) ; 
            return null;  
        }
    }

    public static function buildSQL($q, $filters, $order_by, $order_value = 'asc')
    {
        $isOrder = 0;
        if ($filters) {
            foreach ($filters as $k => $val) {
                if ($k != 'updated_at') {
                    $q = $q->where('s.' . $k, '=', $val);
                }
            }
            if (isset($filters['updated_at'])) {
                $isOrder = 1;
                $q = $q->orderBy('s.updated_at', $filters['updated_at']);
            }
        }

        if (!$isOrder) {
            $q = $q->orderBy($order_by, $order_value);
        }
        return $q;
    }
    public static function get_option_minhnn($variable)
    {
        if (Cache::has('theme_option')) {
            $List = Cache::get('theme_option');
        } else {
            $List = Setting::orderBy('updated', 'desc')->first();
            Cache::forever('theme_option', $List);
        }
        if ($List) :
            $array_option_autos = unserialize($List['value_setting']);
            $str = "";
            if (!empty($array_option_autos)) :
                $count = count($array_option_autos);
                for ($i = 0; $i < $count; $i++) :
                    $label_text = ($array_option_autos[$i]['group_tdr']['tdr_name'] != '') ? $array_option_autos[$i]['group_tdr']['tdr_name'] : '';
                    $option_value = ($array_option_autos[$i]['group_tdr']['tdr_value'] != '') ? $array_option_autos[$i]['group_tdr']['tdr_value'] : '';
                    if ($label_text == $variable) :
                        $str = stripslashes(stripslashes(base64_decode($option_value)));
                    endif;
                endfor;
            endif;
            return $str;
        //echo $array_option_autos[$variable];
        endif;
    }
    public static function msg_move_page($msg, $url = "back", $isExit = 1)
    {
        if ($msg) {
            echo "<script language='javascript'>alert('" . $msg . "');</script>";
        }
        if ($url) {
            switch ($url) {
                case "home":
                    echo "<script>location.href='/'</script>";
                    break;
                case "back":
                    echo "<script language='javascript'>history.go(-1);</script>";
                    break;
                case "close":
                    echo "<script language='javascript'>self.close();</script>";
                    break;
                case "reload":
                    echo "<script language='javascript'>document.location.reload();</script>";
                    break;
                case "top_opener_reload":
                    echo "<script language='javascript'>top.opener.document.location.reload();</script>";
                    break;
                case "top_url":
                    echo "<Script language='javascript'>top.document.location.href = '" . $url . "'</script>";
                    break;
                case "parent_reload":
                    echo "<script language='javascript'>parent.document.location.reload();</Script>";
                    break;
                case "not":
                    echo "<script language='javascript'>alert('" . $msg . "');</script>";
                    break;
                default:
                    echo "<script language='javascript'>document.location.replace('" . $url . "');</script>";
                    break;
            }
        }
        if ($isExit) {
            exit();
        }
    }
}
