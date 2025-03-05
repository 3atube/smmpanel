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

class HandleCreateOrder extends Command
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
    protected $signature = 'systems:handle-create-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle Create Order';

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

        $items = $this->orderRepository->getOrderPendingHandle();
            foreach ($items as $order) {
                $handle = $this->orderService->handleCreateOrder($order);
                if($handle){
                    $count++;
                }
        }
        $items = $this->orderRepository->getOrderPendingSchedule();
        foreach ($items as $order) {
            // check time
            if(Carbon::parse($order->schedule_time) <= Carbon::now()){
                $handle = $this->orderService->handleCreateOrder($order);
                if($handle){
                    $count++;
                }
            }
        }
        echo "Da update " . $count . " order";
    }
}
