<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth, DB, File, Image, Redirect, Cache;
use App\Exports\CustomerExport, Log;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use WebService;
use Carbon\Carbon;
use App\Model\Order;
use App\Model\MessageTelegram;
use App\Model\Transaction;
use App\Model\Download;
use App\Model\Theme;
use App\Model\EmailJob;
use App\Libraries\Helpers;
use App\Mail\QueueEmail;
use App\User;
use Mail;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Services\OrderService;
use App\Repositories\Task\TaskRepositoryInterface;

use App\Http\Resources\ServiceResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\ServiceApiCollection;

class OrderController extends Controller
{
    protected $serviceRepository;
    protected $orderRepository;
    protected $cashFlowRepository;
    protected $orderService;
    protected $userRepository;
    protected $taskRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        OrderService $orderService,
        ServiceRepositoryInterface $serviceRepository,
        OrderRepositoryInterface $orderRepository,
        CashFlowRepositoryInterface $cashFlowRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->taskRepository = $taskRepository;
        $this->orderService = $orderService;
        $this->serviceRepository = $serviceRepository;
        $this->orderRepository = $orderRepository;
        $this->cashFlowRepository = $cashFlowRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function v2Order(Request $request)
    {
        try {
            $key = $request->key;
            if (empty($key)) {
                return response()->json([
                    'error' => 'This key not found',
                ]);
            }
            $user = $this->userRepository->findUserByKey($key);
            if (!$user) {
                return response()->json([
                    'error' => 'Invalid key',
                ]);
            }
            $action = $request->action;
            if (empty($action)) {
                return response()->json([
                    'error' => 'Incorrect request',
                ]);
            }

            $order = $request->order;
            $orders = $request->orders;
            if ($action == 'status') {
                if (!empty($order)) {
                    return $this->getOrderStatus($order, $user->id);
                } else if (!empty($orders)) {
                    return $this->getOrdersStatus($orders, $user->id);
                }
            }

            if ($action == 'add') {
                return $this->addOrderApi($request->all());
            }

            if ($action == 'services') {
                return $this->getServices();
            }

            if ($action == 'refill') {
                return $this->addNewTask($request->all(), $user);
            }

            if ($action == 'balance') {
                return $this->getBalance($user);
            }
        } catch (\Exception $e) {
            Log::error('v2Order: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request']);
        }
    }

    public function addNewTask($data, $user) {
        $order = $data['order'];
        if (empty($order)) {
            return response()->json([
                'error' => 'Incorrect request',
            ]);
        }
        $userId = $user->id;
        $orderInfo = $this->orderRepository->getOrderById($userId, $order);
        if (!$orderInfo) {
            return response()->json([
                'error' => 'Incorrect order ID',
            ]);
        }
        try {
            $total = $this->taskRepository->countTaskBeforeHour($order, $userId);
            if($total){
                return response()->json([
                    'error' => 'Order ID empty',
                ]);
            }
            $params = [
                'user_id' => $userId,
                'order_id' => $order,
                'service_id' => $orderInfo->service_id,
                'task_status' => 'pending',
                'task_date' => \Carbon\Carbon::now(),
                'task_type' => 2,
                'type' => 'refill',
            ];
            $task = $this->taskRepository->create($params);
            return response()->json([
                'refill' => $task->id
            ]);
        } catch (\Exception $e) {
            Log::error('addTask: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request']);
        }
    }

    public function getServices()
    {
        $services = new ServiceApiCollection($this->serviceRepository->getService());
        return $services->resolve();
    }

    public function getBalance($user)
    {
        try {
            if (!$user) {
                return response()->json(['error' => 'Incorrect request']);
            }
            $params = ['balance' => $user->balance ? $user->balance : 0, 'currency' => $user->currency ? $user->currency : 'USD'];
            return response()->json($params);
        } catch (\Exception $e) {
            Log::error('getBalance: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request']);
        }
    }

    public function addOrderApi($data)
    {
        try {
            $data = (object) $data;
            $key = $data->key;
            $user = $this->userRepository->findUserByKey($key);
            if ($user) {
                $sid = !empty($data->service) ? $data->service : null;
                $link = !empty($data->link) ? $data->link : null;
                $comments = !empty($data->comments) ? $data->comments : null;
                $list = !empty($data->list) ? $data->list : null;
                $suggest = !empty($data->suggest) ? $data->suggest : null;
                $search = !empty($data->search) ? $data->search : null;
                $quantity =  !empty($data->quantity) ? (int) $data->quantity : 0;
                $schedule  = !empty($data->schedule) ? (int)  @$data->schedule : 0;
                $scheduleTime  = !empty($data->schedule_time) ? $data->schedule_time : date('Y-m-d H:i:s');
                $loop  = !empty($data->loop) ? (int)  $data->loop : 0;
                return $this->orderService->newOrderService($sid, $link, $quantity, $comments, $list, $suggest, $search, $user->id, 'api', $user->balance, $scheduleTime, $schedule, $loop);
            } else {
                return response()->json(["error" => "Invalid key"]);
            }
        } catch (\Exception $e) {
            Log::error('addOrderApi: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request']);
        }
    }

    public function getOrderStatus($order, $user_id)
    {
        try {
            if (empty($order)) {
                return response()->json([
                    'error' => 'Incorrect request',
                ]);
            }

            $info = $this->orderRepository->getOrderById($user_id, $order);
            if (!$info) {
                return response()->json([
                    'error' => 'Incorrect order ID',
                ]);
            }
            return response()->json([
                'charge' => $info->order_charge,
                "start_count" => $info->order_start ? $info->order_start : 0,
                "status" => \App\Libraries\Helpers::getStatusOrder($info->order_status),
                "remains" => $info->order_remains,
                "note" => $info->order_extras
            ]);
        } catch (\Exception $e) {
            Log::error('getOrderStatus: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request']);
        }
    }

    public function getOrdersStatus($orders, $user_id)
    {
        try {
            if (empty($orders)) {
                return response()->json([
                    'error' => 'Incorrect request',
                ]);
            }
            $orders = explode(',', $orders);
            $results = [];
            foreach ($orders as $item) {
                $info = $this->orderRepository->getOrderById($user_id, $item);
                $result =  [
                    'error' => 'Incorrect order ID',
                ];
                if ($info) {
                    $result = [
                        'charge' => $info->order_charge,
                        "start_count" => $info->order_start ? $info->order_start : 0,
                        "status" => \App\Libraries\Helpers::getStatusOrder($info->order_status),
                        "remains" => $info->order_remains,
                        "note" => $info->order_extras
                    ];
                }
                $results[$item] = $result;
            }
            return response()->json($results);
        } catch (\Exception $e) {
            Log::error('getOrdersStatus: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request']);
        }
    }
}
