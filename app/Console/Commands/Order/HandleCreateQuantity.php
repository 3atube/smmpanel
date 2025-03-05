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

class HandleCreateQuantity extends Command
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
  protected $signature = 'systems:handle-create-order-quantity';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Handle Create Order Quantity';

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

    $items = $this->orderRepository->getOrderMoreQuantityHandle();
    foreach ($items as $order) {
      echo $this->orderRepository->countOrderMoreQuantity($order->id);
      if($this->orderRepository->countOrderMoreQuantity($order->id) === 0){
        $orderNew = $this->insertOrderQuantity($order);
        if($orderNew){
          Log::info('HandleCreateQuantity: '. json_encode($orderNew));
           $count ++;
        }
      }
    }
    echo "Da insert " . $count . " order";
  }

  public function insertOrderQuantity($order) {
    try{
      $api_detail = $order->api_detail;
      $quantity = $order->order_more_quantity;
      $api = (json_decode($api_detail));
      $api->quantity = $quantity;
      $api_detail = json_encode($api);
      $user = $order->user;
      $service = $this->serviceRepository->firstServiceUserPrice($user->id, $order->service_id);
      if(!$service){
        return null;
      }
      $max = $service->service_max;
      $min = $service->service_min;
      if ($quantity < $min) {
        return null;
      }
      $rate = !empty($service->clientprice) ? $service->clientprice : $service->service_price;
      $money = (int) ($quantity * $rate) / 1000;
      if ($money > $user->balance) {
        return null;
      }
      $paramsService = [
        'api_detail' => $api_detail,
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
        'order_charge' => $money,
        'order_charge_before' => $money,
        'order_more_id' => $order->id,
        'order_profit' => $quantity,
        'order_quantity' => $quantity,
        'order_remains' => 0,
        'order_status' => 'pending',
        'order_where' => $order->order_where,
        'schedule_time' => $order->schedule_time,
        'schedule' => $order->schedule,
        'loop' => 0,
        'id_order_loop' => 0,
        'loop_remaining' => 0,
        'currentmillis' => null
      ];
      return $this->orderRepository->create($paramsService);
    }catch (\Exception $e) {
      Log::error('insertOrderQuantity: ' . $e->getMessage());
      return null;
    }
  }
}
