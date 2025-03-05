<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
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
use Response;
use App\Model\Provider;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\TicketReply\TicketReplyRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;


class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $ticketRepository;
    protected $orderRepository;
    protected $userRepository;
    protected $taskRepository;
    protected $ticketReplyRepository;
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TaskRepositoryInterface $taskRepository, 
        TicketRepositoryInterface $ticketRepository, 
        UserRepositoryInterface $userRepository, 
        TicketReplyRepositoryInterface $ticketReplyRepository
    )
    {
        $this->ticketRepository = $ticketRepository;
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
        $this->orderRepository = $orderRepository;

        $this->ticketReplyRepository = $ticketReplyRepository;
    }

    public function multiAction(Request $request){
        $bulkStatus = $request->bulkStatus;
        $task = $request->task;
        if (count($task)) {
            $tasks = [];
            foreach ($task as $key => $value) {
                $tasks[] = $key;
                if($bulkStatus == 'refill') {
                    $this->refill($key);
                }
            }
        }
        if($bulkStatus=='reject'){
            $this->taskRepository->updateCanceled($tasks);
        }
        return redirect()->route('admin.tasks');

    }

    public function list(Request $request)
    {
        $items = $this->taskRepository->getTasks($request->search, $request->search_type, $request->task_status);
        return view('admin-view.tasks.list', compact('items'));
    }

    public function taskNo($id)
    {
        $info = $this->taskRepository->find($id);
        $info->update(['task_status' => 'canceled']);
        return redirect()->route('admin.tasks');
    }

    public function refill($id)
    {
        $info = $this->taskRepository->find($id);
        $error = $this->funcRefill($info);
        if($error){
            return redirect()->route('admin.tasks')->with('refill', $error);
        }else{
            return redirect()->back();
        }
    }

    public function funcRefill($info){
        $error = "";
        $order = $info->order;
        if($order->order_status != 'completed') {
            $error = 'funcRefill $order->order_status != completed '.$info->id;
            Log::info($error);
            return $error;
        }
        $service = $order->service;
        if(empty($service)){
             $error = "funcRefill Không tồn tại service ".$order->service_id;
            Log::info($error);
            return $error;
        }
        $providerInfo = $service->provider;
        if ($providerInfo) {
            $details = Helpers::action(["key" => $providerInfo->api_key, "action" => "refill", "order" => $info->id], $providerInfo->api_url, $providerInfo->type_api);
            if($details){
                $info->update(['details' => json_encode($details) , 'task_status' => 'canceled']);
                Log::info('partialOrder: update partial '.json_encode($info));
            }
        }
        return null;
    }

    public function funcPartial($info){
        $error = "";
        $order = $info->order;
        if($order->order_status == 'completed') {
            $error = 'funcPartial $order->order_status == completed '.$info->id;
            Log::info($error);
            return $error;
        }
        $service = $order->service;
        if(empty($service)){
             $error = "funcPartial Không tồn tại service ".$order->service_id;
            Log::info($error);
            return $error;
        }
        $providerInfo = $service->provider;
        if ($providerInfo) {
            $details = Helpers::action(["key" => $providerInfo->api_key, "action" => "cancel", "order" => $info->id], $providerInfo->api_url, $providerInfo->type_api);
            if($details){
                $info->update(['details' => json_encode($details), 'task_status' => 'canceled']);
                Log::info('partialOrder: update partial '.json_encode($info));
            }
        }
        return null;
    }

    public function success($id)
    {
        try {
            $info = $this->taskRepository->find($id);
            $orderId = $info->order_id;
            $order = $this->orderRepository->find($orderId);
            $service = $order->service;
            $providerInfo = $service->provider;
            if ($service->provider) {
                $send_refill = Helpers::action(["key" => $providerInfo->api_key, "action" => "refill", "order" => $order->api_orderid], $providerInfo->api_url, $providerInfo->type_api);
                if (@$send_refill->refill) {
                    $info->update(['task_status' => 'success', 'refill_orderid' => $send_refill->refill]);
                    return redirect()->route('admin.tasks');
                } else {
                    $send_refill = json_encode($send_refill, true);
                    return redirect()->route('admin.tasks')->with('refill', "Your refill request could not be sent. <code>" . $send_refill . "</code>");
                }
            } else {
                return redirect()->route('admin.tasks')->with('refill', "Your refill request could not be sent. <code>null</code>");
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.tasks')->with('refill', "Your refill request could not be sent. <code>" . $e->getMessage() . "</code>");
        }
    }

    public function canceled($id)
    {
        $info = $this->taskRepository->find($id);
    }
}
