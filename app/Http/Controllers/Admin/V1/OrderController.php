<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use App\User;
use Auth, DB, File, Image, Redirect, Cache;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use WebService;
use Carbon\Carbon;
use Validator;
use App\Model\CashFlow;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Services\OrderService;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userRepository;
    protected $orderRepository;
    protected $orderService;
    protected $cashFlowRepository;
    protected $serviceRepository;
    public function __construct(
        OrderService $orderService, 
        ServiceRepositoryInterface $serviceRepository, 
        OrderRepositoryInterface $orderRepository, 
        UserRepositoryInterface $userRepository, 
        CashFlowRepositoryInterface $cashFlowRepository
    )
    {
        $this->orderService = $orderService;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->serviceRepository = $serviceRepository;
        $this->cashFlowRepository = $cashFlowRepository;
    }

    public function orderResend(Request $request, $id)
    {
        $this->orderService->resendOrder([$id]);
        return redirect()->back();
    }

    public function multiAction(Request $request)
    {
        $bulkStatus = $request->bulkStatus;
        $order = $request->order;
        if (count($order)) {
            $orders = [];
            foreach ($order as $key => $value) {
                $orders[] = $key;
            }
        }

        if ($bulkStatus == 'pending') {
            $this->orderRepository->updateStatus($orders, ['order_status' => 'pending']);
        } elseif ($bulkStatus == 'inprogress') {
            $this->orderRepository->updateStatus($orders, ['order_status' => 'inprogress']);
        } elseif ($bulkStatus == 'processing') {
            $this->orderRepository->updateStatus($orders, ['order_status' => 'processing']);
        } elseif ($bulkStatus == 'completed') {
            $this->orderRepository->updateStatus($orders, ['order_status' => 'completed', 'order_error' => '-']);
        } elseif ($bulkStatus == 'canceled') {
            $this->orderService->canceledOrder($orders);
        }elseif ($bulkStatus == 'resend') {
            $this->orderService->resendOrder($orders);
        }
        $this->orderRepository->updateManual($orders);
        return redirect()->back();
    }

    public function orderErrors($id)
    {
        $info = $this->orderRepository->find($id);
        $viewRender = view('admin-view.orders.order-errors', compact('info'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Order Errors: ' . $info->id,
        ]);
    }

    public function orderDetailsApi($id){
        $info = $this->orderRepository->find($id);
        $order_id = $info->api_orderid;
        $response = null;
        if($order_id > 0) {
            $service = $this->serviceRepository->find($info->service_id);
            if ($service) {
                if($service->provider){
                    $paramsInsert = [
                        'key' => $service->provider->api_key,
                        'action' => 'status',
                        'order' => $order_id,
                    ];
                    $api_url = $service->provider->api_url;
                    $history = $info->history_api_provider;
                    if($history != null && count($history) > 0 && $info->is_active_provider == 0){
                        $providerNew = (object) @$history;
                        $api_url = $providerNew->api_url;
                        $paramsInsert = [
                            'key' => $providerNew->api_key,
                            'action' => 'status',
                            'order' => $order_id,
                        ];
                    }
                    $response = Helpers::getResponseAPI($paramsInsert, $api_url);
                }
            }
        }
        $viewRender = view('admin-view.orders.details', compact('info', 'response'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Order: ' . $info->id,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function orders(Request $request)
    {
        $service_id = $request->service_id ? $request->service_id : null;
        $mode = $request->mode ? $request->mode : null;
        $search_type = $request->search_type ? $request->search_type : null;
        $search = $request->search ? $request->search : null;
        $items = $this->orderRepository->listOrderFilter($service_id, $mode, $search, $search_type );
        $string = 'all';
        return view('admin-view.orders.list', compact('items', 'string'));
    }

    public function noBalance(Request $request)
    {
        $service_id = $request->service_id ? $request->service_id : null;
        $mode = $request->mode ? $request->mode : null;
        $items = $this->orderRepository->listOrderFilterNoBalance($service_id, $mode);
        return view('admin-view.orders.no-balance', compact('items'));
    }


    public function ordersStatus($string, Request $request)
    {
        $service_id = $request->service_id ? $request->service_id : null;
        $mode = $request->mode ? $request->mode : null;
        $search_type = $request->search_type ? $request->search_type : null;
        $search = $request->search ? $request->search : null;
        $items = $this->orderRepository->listOrderFilterByStatus($string, $service_id, $mode, $search, $search_type);
        return view('admin-view.orders.list-filter', compact('items', 'string'));
    }

    public function counter(Request $request)
    {
        $items = $this->serviceRepository->getService();
        $count = $this->orderRepository->getCountOrder();
        return view('admin-view.orders.counter', compact('items', 'count'));
    }

    public function orderUrl($id, $type)
    {
        switch ($type) {
            case 'remains':
                $title = 'Set partial';
                break;

            default:
                $title = 'Edit';
                break;
        }
        $info = $this->orderRepository->find($id);
        $viewRender = view('admin-view.orders.order-update', compact('info', 'type', 'title'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => $title,
        ]);
    }

    public function update($id, Request $request)
    {
        $info = $this->orderRepository->find($id);
        $fields = $request->all();
        $fields['admin_manual'] = 1;
        $info->update($fields);
        return redirect()->back();
    }

    public function updatePartial($id, Request $request)
    {
        $remains = $request->order_remains;
        $info = $this->orderRepository->find($id);
        if ($info) {
            if (empty($remains) || !is_numeric($remains)) {
                return response()->json([
                    'm' => (object) ['error' => 'Undelivered amount cannot be empty'],
                    's' => 'error',
                    'r' => null,
                    't' => "error",
                    'time' => 1
                ]);
            } else if ($info->order_quantity < $remains) {
                return response()->json([
                    'm' => (object) ['error' => 'Outgoing quantity cannot exceed the order quantity.'],
                    's' => 'error',
                    'r' => null,
                    't' => "error",
                    'time' => 1
                ]);
            }
            $service = $this->serviceRepository->firstServiceUserPrice($info->user_id, $info->service_id);
            $orderCharge = $info->order_charge;
            $price  = $orderCharge / $info->order_quantity;

            if ($service) {
                $clientprice = $service->clientprice ? $service->clientprice : $service->price;
                $price = $clientprice/1000;
                $orderCharge = $price*$info->order_quantity;
            }

            $return = $price * $remains;

            $user = $info->user;
            $balance = $user->balance + $return;
            $spent = $user->spent - $return;
            $charge = $orderCharge - $return;
            $info->update([
                'order_remains' => $remains,
                'order_status' => 'partial',
                'order_charge' => $charge,
                'order_where' => 'site',
                'partial' => 1,
                'sync_api' => 0
            ]);
            $user->update(['balance' => $balance, 'spent' => $spent]);
            $type = 'Partial';
            $cash = '+' . ($orderCharge - $charge);
            $total_cash = $user->balance + ($orderCharge - $charge);

            $paramsCash = [
                'user_id' => $user->id,
                'order_id' => $info->id,
                'cash' => $cash,
                'total_cash' => $total_cash,
                'type' => $type
            ];
            $this->cashFlowRepository->create($paramsCash);
            Log::notice('updatePartial ' . json_encode($paramsCash));

            return response()->json([
                'r' => route('admin.orders'),
                'm' => 'Update thành công',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
        }
        return response()->json([
            'm' => (object) ['error' => 'order not found.'],
            's' => 'error',
            'r' => null,
            't' => "error",
            'time' => 1
        ]);
    }

    public function orderCancel($id)
    {
        $orders = [$id];
        $this->orderService->canceledOrder($orders);
        $info = $this->orderRepository->find($id);
        $info->update(['admin_manual' => 1]);
        return redirect()->back();
    }

    public function orderInprogress($id)
    {
        $info = $this->orderRepository->find($id);
        $info->update(['order_status' => 'inprogress', 'sync_api' => 0, 'admin_manual' => 1]);
        return redirect()->back();
    }

    public function orderPendding($id)
    {
        $info = $this->orderRepository->find($id);
        $info->update(['order_status' => 'pending', 'admin_manual' => 1]);
        return redirect()->back();
    }

    public function orderComplete($id)
    {
        $info = $this->orderRepository->find($id);
        $info->update(['order_status' => 'completed', 'order_error' => '-', 'sync_api' => 0, 'admin_manual' => 1]);
        return redirect()->back();
    }
}
