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
use App\Services\OrderService;

class ProcessingToCancelOrder extends Command
{
    protected $orderRepository;
    protected $cashFlowRepository;
    protected $userRepository;
    protected $serviceRepository;
    protected $orderService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'systems:processing-to-cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
      OrderService $orderService,
        ServiceRepositoryInterface $serviceRepository,
        OrderRepositoryInterface $orderRepository,
        CashFlowRepositoryInterface $cashFlowRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->orderService = $orderService;
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
      $orders = $this->orderRepository->getProcessingOrder();
      if(count($orders) > 0){
        Log::notice('call systems:processing-to-cancel');
        echo 'call systems:processing-to-cancel';
        $this->orderService->canceledOrder($orders);
      }
    }
}
