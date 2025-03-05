<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Route;
use Illuminate\Http\Request;
use Log;
use DB;
use Input;
use Hash;
use Validator;
use Mail;
use Session;
use App\Model\Service;
use Cart;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\TicketReply\TicketReplyRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\ServiceReview\ServiceReviewRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;

use App\Model\Setting;


class OrderController extends Controller
{
  protected $paymentMethodRepository;
  protected $ticketRepository;
  protected $userRepository;
  protected $ticketReplyRepository;
  protected $categoryRepository;
  protected $serviceRepository;

  protected $serviceReviewRepository;
  protected $orderRepository;
  public function __construct(
    OrderRepositoryInterface $orderRepository,
    ServiceRepositoryInterface $serviceRepository,
    ServiceReviewRepositoryInterface $serviceReviewRepository,
    PaymentMethodRepositoryInterface $paymentMethodRepository,
    TicketRepositoryInterface $ticketRepository,
    UserRepositoryInterface $userRepository,
    TicketReplyRepositoryInterface $ticketReplyRepository,
    CategoryRepositoryInterface $categoryRepository

  ) {
    $this->orderRepository = $orderRepository;
    $this->categoryRepository = $categoryRepository;
    $this->serviceRepository = $serviceRepository;
    $this->serviceReviewRepository = $serviceReviewRepository;
    $this->paymentMethodRepository = $paymentMethodRepository;
    $this->ticketRepository = $ticketRepository;
    $this->userRepository = $userRepository;
    $this->ticketReplyRepository = $ticketReplyRepository;
  }
  public function orderMoreQuantity($request)
  {
    $data = (object) $request;
    $quantity = $data->data['quantity'];
    $orderId = $data->data['order_id'];
    if (!is_numeric($quantity)) {
      return response()->json([
        'error' => 'Quantity integer',
      ]);
    }
    if (empty($quantity)) {
      return response()->json([
        'error' => 'All fields can not emty',
      ]);
    }
    $user = Auth::user();
    try {
      $order = $this->orderRepository->findOrder($orderId);
      if (!$order) {
        return response()->json([
          'error' => 'Not order'
        ]);
      }
      $service = $this->serviceRepository->firstServiceUserPrice($user->id, $order->service->id);
      $max = $service->service_max;
      $min = $service->service_min;
      $rate = !empty($service->clientprice) ? $service->clientprice : $service->service_price;

      $money = (int) ($quantity * $rate) / 1000;
      if ($money > $user->balance) {
        return response()->json([
          'error' => 'Not enough funds',
        ]);
      }

      if ($quantity < $min) {
        return response()->json([
          'error' => 'You did not meet the minimum number. ' . $min,
        ]);
      }

      if ($quantity < $service->service_min || $quantity > $service->service_max) {
        return response()->json([
          'error' => 'Min/Max order is: ' . $min . '/' . $max . '',
        ]);
      }
      if (!$order->order_more_quantity) {
        $order->update(['order_more_quantity' => $quantity]);
        return response()->json([
          "success" => "Add successfully",
          "language" => "Add successfully"
        ]);
      }
      return response()->json([
        "error" => "More Quantity already exists",
        "language" => "More Quantity already exists"
      ]);
    } catch (\Exception $e) {
      Log::error('orderMoreQuantity' . $e->getMessage());
      return response()->json([
        "error" => "Add error",
        "language" => "Add error"
      ]);
    }
  }
}
