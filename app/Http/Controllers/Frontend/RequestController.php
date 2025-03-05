<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
use DB;
use Input;
use Illuminate\Support\Facades\Hash;
use Validator;
use Mail;
use Session;
use App\Model\Service;
use Cart;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use Goutte\Client;
use App\Services\OrderService;
use Illuminate\Support\Str;


class RequestController extends Controller
{
    protected $serviceRepository;
    protected $orderRepository;
    protected $cashFlowRepository;
    protected $orderService;

    public function __construct(OrderService $orderService, ServiceRepositoryInterface $serviceRepository, OrderRepositoryInterface $orderRepository, CashFlowRepositoryInterface $cashFlowRepository)
    {
        $this->orderService = $orderService;
        $this->serviceRepository = $serviceRepository;
        $this->orderRepository = $orderRepository;
        $this->cashFlowRepository = $cashFlowRepository;
    }

    public function request(Request $request)
    {
        $action = $request->action;
        if ($action == 'SERVICE-listUserService') {
            return $this->listUserService();
        } else if ($action == 'ORDER-newOrder') {
            return $this->newOrder($request->data);
        } else if ($action == 'ORDER-listOrder') {
            $columns = $request->columns;
            $order_id = !empty($columns[0]['search']['value']) ? $columns[0]['search']['value'] : "";
            $link = !empty($columns[3]['search']['value']) ? $columns[3]['search']['value'] : "";
            $service_id = !empty($columns[9]['search']['value']) ? $columns[9]['search']['value'] : "";
            $status = !empty($columns[8]['search']['value']) ? $columns[8]['search']['value'] : "";
            $request->recordsFiltered = \App\Libraries\Helpers::countOrderUser($status, $order_id, $link, $service_id, Auth::user()->id);
            return $this->listOrder($request->all());
        } else if ($action == 'ACCOUNT-changeApiKey') {
            return $this->changeApiKey();
        } else if ($action == 'ACCOUNT-changePassword') {
            return $this->changePassword($request->all());
        } else if ($action == 'changePaymentMethod') {
            return app('App\Http\Controllers\Admin\Frontend\PaymentMethodController')->change($request->all());
        } elseif( $action =='TICKET-add'){
            return app('App\Http\Controllers\Frontend\TicketController')->addTicket($request->all());
        } elseif ($action == 'ORDER-more-quantity'){
            return app('App\Http\Controllers\Frontend\OrderController')->orderMoreQuantity($request->all());
        }
    }

    public function changePassword($data)
    {
        $data = (object) $data;
        $oldp = $data->data['oldp'];
        $newp = $data->data['newp'];
        $cnewp = $data->data['cnewp'];
        if (empty($oldp) || empty($newp) || empty($cnewp)) {
            return response()->json([
                'error' => 'All fields can not emty',
            ]);
        }
        if ($newp != $cnewp) {
            return response()->json([
                'error' => "Mật khẩu xác nhận không trùng khớp",
            ]);
        }
        $user = Auth::user();
        $current_pass = $user->password;
        if (Hash::check($oldp, $user->password)) {
            if ($newp == $cnewp) {
                $data = array(
                    'password' => bcrypt($newp)
                );
                $user->update($data);
            } else {
                return response()->json([
                    'error' => 'Mật khẩu xác nhận không trùng khớp',
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Mật khẩu hiện tại không chính xác',
            ]);
        }
    }

    public function changeApiKey()
    {
        try {
            $user = Auth::user();
            $random = Str::random(40);
            $user->update(['key_api' => $random]);
            return response()->json([
                'success' => $random,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'This key not found',
            ]);
        }
    }

    public function listUserService()
    {
        return ServiceResource::collection($this->serviceRepository->getServiceUser(Auth::user()->id));
    } 

    public function getFunds()
    {
        $user = Auth::user();
        return $user->cash;
    }

    public function listOrder($data)
    {
        $data = (object) $data;
        $columns = $data->columns;
        $order_id = !empty($columns[0]['search']['value']) ? $columns[0]['search']['value'] : "";
        $link = !empty($columns[3]['search']['value']) ? $columns[3]['search']['value'] : "";
        $service_id = !empty($columns[9]['search']['value']) ? $columns[9]['search']['value'] : "";
        $status = !empty($columns[8]['search']['value']) ? $columns[8]['search']['value'] : "";
        $start = $data->start;
        $length = $data->length;
        $userId = Auth::user()->id;
        return new OrderCollection($this->orderRepository->searchOrder($status, $order_id, $link, $service_id, $userId, $start, $length));
    }
    
    public function newOrder($data)
    {
        $data = (object) $data;
        $user = Auth::user();
        $sid = $data->sid;
        $link = $data->link;
        $comments = $data->comments;
        $list = $data->list;
        $suggest = $data->suggest;
        $search = $data->search;
        $schedule  = $data->schedule ? $data->schedule : 0;
        $scheduleTime  = $data->schedule_time;
        $loop  = $data->loop ? (int)  $data->loop : 0;
        $quantity = (int) $data->quantity;
        return $this->orderService->newOrderService($sid, $link, $quantity, $comments, $list, $suggest, $search, $user->id, 'site', $user->balance, $scheduleTime, $schedule, $loop);
    }
}
