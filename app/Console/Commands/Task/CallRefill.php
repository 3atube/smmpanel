<?php

namespace App\Console\Commands\Task;

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
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Jobs\UpdateOrderApi;
use App\Services\UpdateOrderService;
use App\Services\OrderService;
use Carbon\Carbon;

class CallRefill extends Command
{
  protected $orderService;
  protected $orderRepository;
  protected $taskRepository;
  protected $userRepository;
  protected $serviceRepository;
  protected $updateOrderService;

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'systems:call-refill';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'call refill';

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
    TaskRepositoryInterface $taskRepository,
    UserRepositoryInterface $userRepository
  ) {
    $this->orderService = $orderService;
    $this->updateOrderService = $updateOrderService;
    $this->orderRepository = $orderRepository;
    $this->taskRepository = $taskRepository;
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
    $items = $this->taskRepository->getStatusPending();
    foreach($items as $item){
      echo app('App\Http\Controllers\Admin\V1\TaskController')->funcRefill($item);
    }
  }
}
