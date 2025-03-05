<?php

namespace App\Console\Commands\Order;

use Illuminate\Console\Command;
use File, DB, Log;
use App\Model\Order;
use App\Model\Service;
use App\Model\Transaction;
use App\Model\Download;
use App\Model\Theme;
use App\Model\EmailJob;
use App\Libraries\Helpers, WebService;
use App\Mail\QueueEmail;
use App\User;
use Mail;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Jobs\UpdateOrderApi;
use App\Services\UpdateOrderService;
use App\Services\OrderService;
use Carbon\Carbon;

class HandleCreateLoop extends Command
{
  protected $orderService;
  protected $orderRepository;
  protected $cashFlowRepository;
  protected $userRepository;
  protected $serviceRepository;
  protected $updateOrderService;

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'systems:handle-create-order-loop';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Handle Create Order Loop';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct(
    OrderService $orderService,
    UpdateOrderService $updateOrderService,
    ServiceRepositoryInterface $serviceRepository,
    OrderRepositoryInterface $orderRepository,
    CashFlowRepositoryInterface $cashFlowRepository,
    UserRepositoryInterface $userRepository
  ) {
    $this->orderService = $orderService;
    $this->updateOrderService = $updateOrderService;
    $this->orderRepository = $orderRepository;
    $this->cashFlowRepository = $cashFlowRepository;
    $this->userRepository = $userRepository;
    $this->serviceRepository = $serviceRepository;
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $count = 0;

    $items = $this->orderRepository->getOrderPendingHandleLoop();
    foreach ($items as $order) {
      // check order_loop = 0
      // if order
      if(count($order->order_loop) < $order->loop){
        // count($order->order_loop) = 0
        $insert = false;
        if(count($order->order_loop) == 0){
          $insert = true;
        } else {
          $check = [];
          // th order_status loop == completed
          foreach($order->order_loop as $loop) {
            if($loop->order_status == 'completed') {
              $check[] = 'check';
            }
          }
          // dk all status  = completed and total order loop < loop
          $insert = (count($check) == count($order->order_loop)) && ($order->loop > count($order->order_loop)) ? true : false;
        }
        if($insert) {
          $count ++;
          $orderLoop = $this->insertOrderLoop($order);
          Log::info('orderLoop: '.json_encode($orderLoop));
          //
          Log::info('insert order: '.$order->id.', order_loop: ' .$orderLoop->id);
          $order->order_loop()->attach([$orderLoop->id]);
        }
      }
    }
    echo "Da insert " . $count . " order";
  }

  public function insertOrderLoop($order) {
    $paramsService = [
      'api_detail' => $order->api_detail,
      'user_id' => $order->user_id,
      'api_serviceid' => $order->api_serviceid,
      'service_id' => $order->service_id,
      'api_orderid' => 0,
      'order_url' => $order->order_url,
      'order_detail' => "-",
      'order_error' => '-',
      'order_api' => $order->order_api,
      'order_start' => 0,
      'last_check' => date("Y.m.d H:i:s"),
      'order_create' => date("Y.m.d H:i:s"),
      'order_extras' => "",
      'create' => date("Y.m.d H:i:s"),
      'order_charge' => $order->order_charge,
      'order_charge_before' => $order->order_charge_before,
      'order_profit' => $order->order_profit,
      'order_quantity' => $order->order_quantity,
      'order_remains' => 0,
      'order_status' => 'pending',
      'order_where' => $order->order_where,
      'schedule_time' => $order->schedule_time,
      'schedule' => $order->schedule,
      'loop' => 0,
      'id_order_loop' => $order->id,
      'loop_remaining' => $order->loop - count($order->order_loop) - 1,
      'currentmillis' => null
    ];
    return $this->orderRepository->create($paramsService);
  }
}
