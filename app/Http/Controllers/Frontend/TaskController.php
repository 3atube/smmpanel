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
use App\Repositories\Task\TaskRepositoryInterface;

use App\Http\Resources\ServiceResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use Goutte\Client;
use App\Services\OrderService;
use Illuminate\Support\Str;


class TaskController extends Controller
{
    protected $serviceRepository;
    protected $orderRepository;
    protected $cashFlowRepository;
    protected $orderService;
    protected $taskRepository;
    public function __construct(TaskRepositoryInterface $taskRepository, OrderService $orderService, ServiceRepositoryInterface $serviceRepository, OrderRepositoryInterface $orderRepository, CashFlowRepositoryInterface $cashFlowRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->orderService = $orderService;
        $this->serviceRepository = $serviceRepository;
        $this->orderRepository = $orderRepository;
        $this->cashFlowRepository = $cashFlowRepository;
    }

    public function newTask($order_id, $type = 'refill') {
        $order = $this->orderRepository->find($order_id);
        if ($order) {
            $user_id = Auth::user()->id;
            $params = [
                'user_id' => $user_id,
                'order_id' => $order_id,
                'service_id' => $order->service_id,
                'task_status' => 'pending',
                'task_date' => date('Y-m-d H:i:s'),
                'task_type' => 2,
                'type' => $type,
            ];
            $task = $this->taskRepository->create($params);
            if($task->type == 'partial'){
                app('App\Http\Controllers\Admin\V1\TaskController')->funcPartial($task);
            }else if($task->type == 'refill'){
                app('App\Http\Controllers\Admin\V1\TaskController')->funcRefill($task);
            }
        }
    }

    public function addTask(Request $request)
    {
        $validation_rules = array(
            'order_id' => 'required|max:255',
        );
        $messages = array(
            'order_id.required' => 'order_id cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
                's' => 'error',
                'r' => null,
                't' => "error",
                'error' => 1
            ]);
        }
        $order_id = $request->order_id;
        $type = $request->type;

        $order = $this->orderRepository->find($order_id);
        if ($order) {
            $user_id = Auth::user()->id;
            $params = [
                'user_id' => $user_id,
                'order_id' => $order_id,
                'service_id' => $order->service_id,
                'task_status' => 'pending',
                'task_date' => date('Y-m-d H:i:s'),
                'task_type' => 2,
                'type' => $type,
            ];
            $first = $this->taskRepository->firstTask($user_id, $order_id, $type);
            if (!$first) {
                $this->taskRepository->create($params);
                if($type=='refill'){
                    $order->update(['refill' => 1]);
                }else{
                    $order->update(['partialed' => 1]);
                }
            }
            return response()->json([
                'message' => 'Your order is being reviewed',
                's' => 'error',
                'r' => null,
                't' => "error",
                'success' => 1
            ]);
        }
    }
}
