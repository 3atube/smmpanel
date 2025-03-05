<?php

namespace App\Services;

use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Model\Balance;
use App\Libraries\Helpers;
use App\Jobs\CreateOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderService
{
	protected $serviceRepository;
	protected $orderRepository;
	protected $cashFlowRepository;
	protected $userRepository;


	public function __construct(
		UserRepositoryInterface $userRepository,
		ServiceRepositoryInterface $serviceRepository, 
		OrderRepositoryInterface $orderRepository, 
		CashFlowRepositoryInterface $cashFlowRepository
	)
	{
		$this->userRepository = $userRepository;
		$this->serviceRepository = $serviceRepository;
		$this->orderRepository = $orderRepository;
		$this->cashFlowRepository = $cashFlowRepository;
	}

	public function resendOrder($orders)
	{
		if ($orders) {
			foreach ($orders as $value) {
				try {
					$order = $this->orderRepository->find($value);
					$service = $order->service;
					if (!empty($order->api_detail)) {
						if (!empty($service->provider)) {
							$paramsInsert = (array) json_decode($order->api_detail);
							$paramsInsert['link'] = $order->order_url;
							$paramsInsert['key'] = $service->provider->api_key;
							$paramsInsert['quantity'] = $order->order_quantity;
							$paramsInsert['service'] = $order->service->api_service;
							if (!empty($paramsInsert['key'])) {
								$orderResult = Helpers::action($paramsInsert, $service->provider->api_url, $service->provider->type_api);
								if (!empty($orderResult->error)) {
									$order->update([
										'no_balance_api' => 1,
										'order_detail' => '-',
										'order_error' => json_encode($orderResult),
										'order_status' => 'processing'
									]);
								} elseif (!empty($orderResult->order)) {
									$order->update([
										'api_orderid' => $orderResult->order,
										'order_detail' => json_encode($orderResult),
										'order_status' => 'pending'
									]);
								}
								Log::notice('admin resendOrder:' . $value);
							}
						}
					}
				} catch (\Exception $e) {
					Log::error('resendOrder: ' . $e->getMessage());
					echo 'resendOrder: ' . $e->getMessage();
				}
			}
		}
	}
	public function canceledOrder($orders)
	{
		if ($orders) {
			foreach ($orders as $value) {
				try {
					$order = $this->orderRepository->find($value);
					if ($order->user) {
						$balance = $order->user->balance + $order->order_charge;
						$spent  = $order->user->spent - $order->order_charge;
						$params = [
							'order_remains' => $order->order_quantity,
							"order_error" => "-",
							'order_charge' => 0,
							'order_quantity' => 0,
							'api_charge' => 0,
							'order_profit' => 0,
							'order_status' => 'canceled',
							'admin_manual' => 1,
							'order_charge' => 0
						];
						$user = $order->user;
						$order->update($params);
						// tra ve order id
						$money = $order->order_charge_before;
						$total_cash =  $user->balance + $money > 0 ? $user->balance + $money : 0;
						$type = 'Canceled';

						$firstCashFlow = $this->cashFlowRepository->firstCashFlow($user->id, $order->id, $type);
						if (!$firstCashFlow) {
							$paramsCash = [
								'user_id' => $user->id,
								'order_id' => $order->id,
								'type' => $type,
								'cash' => '+' . $money,
								'total_cash' => $balance,
							];
							// insert vao cash_flows
							$this->cashFlowRepository->create($paramsCash);
							// tru tien user
							$user->update(['balance' => $balance, 'spent' => $spent]);
							Log::notice('order admin id ' . $value . ' canceledOrder ');
						}
					} else {
						Log::notice('order admin id ' . $value . ' canceledOrder not user');
					}
				} catch (\Exception $e) {
					Log::error('order id ' . $value . ' canceledOrder ' . $e->getMessage());
				}
			}
		}
	}

	public function newOrderService($sid, $link, $quantity, $comments, $list, $suggest, $search, $userId, $type = 'site', $balance, $scheduleTime, $schedule, $loop)
	{

		if (empty($link) && empty($quantity)) {
			return response()->json([
				'error' => 'All fields can not emty',
			]);
		}
		$service = $this->serviceRepository->firstServiceUserPrice($userId, $sid);
		if (!$service) {
			return response()->json([
				'error' => 'This service is inactive',
			]);
		}
		$max = $service->service_max;
		$min = $service->service_min;
		$rate = !empty($service->clientprice) ? $service->clientprice : $service->service_price;

		$money = (int) ($quantity * $rate) / 1000;
		if ($money > $balance) {
			return response()->json([
				'error' => 'Not enough funds',
			]);
		}

		if ($quantity < $min) {
			return response()->json([
				'error' => 'You did not meet the minimum number.',
			]);
		}

		if ($quantity < $service->service_min || $quantity > $service->service_max) {
			return response()->json([
				'error' => 'Min/Max order is: ' . $min . '/' . $max . '',
			]);
		}
		// insert api 1dg
		$typeService = \App\Libraries\Helpers::getServicePackage($service->service_package);
		if (!empty($link) && !empty($quantity)) {
			$paramsService = [
				'api_detail' => null,
				'history_api_provider' => null,
				'user_id' => $userId,
				'api_serviceid' => $service->api_service,
				'service_id' => $service->id,
				'api_orderid' => 0,
				'order_url' => $link,
				'order_detail' => '-',
				'order_error' => '-',
				'order_api' => 0,
				'order_start' => 0,
				'last_check' => date("Y.m.d H:i:s"),
				'order_create' => @$schedule ? $scheduleTime : date("Y.m.d H:i:s"),
				'order_extras' => "",
				'create' => date("Y.m.d H:i:s"),
				'order_charge' => $money,
				'order_charge_before' => $money,
				'order_profit' => $quantity,
				'order_quantity' => $quantity,
				'order_remains' => 0,
				'order_status' => 'pending',
				'order_where' => $type,
				'schedule_time' => @$schedule ? $scheduleTime : date("Y.m.d H:i:s"),
				'schedule' => @$schedule,
				'loop' => $loop,
				'currentmillis' => null
			];
			if (!empty($service->provider)) {
				if ($typeService == 'Default') {
					$paramsInsert = [
						'key' => $service->provider->api_key,
						'action' => 'add',
						'service' => $service->api_service,
						'link' => $link,
						'quantity' => $quantity,
					];
				} else if ($typeService == 'Custom Comments') {
					$paramsInsert = [
						'key' => $service->provider->api_key,
						'action' => 'add',
						'service' => $service->api_service,
						'link' => $link,
						'quantity' => $quantity,
						'comments' => $comments
					];
				} else if ($typeService == 'Special') {
					$paramsInsert = [
						'key' => $service->provider->api_key,
						'action' => 'add',
						'service' => $service->api_service,
						'link' => $link,
						'quantity' => $quantity,
						'list' => $list
					];
				} else if ($typeService == 'Special 1') {
					$paramsInsert = [
						'key' => $service->provider->api_key,
						'action' => 'add',
						'service' => $service->api_service,
						'link' => $link,
						'quantity' => $quantity,
						'suggest' => $suggest,
						'search' => $search
					];
				}
				$apiDetail = json_encode($paramsInsert);
				$historyApiProvider = [
						'api_url' => $service->provider->api_url,
						'api_key' => $service->provider->api_key,
						'type_api' => $service->provider->type_api,
				];
				$paramsService = [
					'api_detail' => $apiDetail,
					'history_api_provider' => $historyApiProvider,
					'user_id' => $userId,
					'api_serviceid' => $service->api_service,
					'service_id' => $service->id,
					'api_orderid' => 0,
					'order_url' => $link,
					'order_detail' => "-",
					'order_error' => '-',
					'order_api' => $service->provider->id,
					'order_start' => 0,
					'last_check' => date("Y.m.d H:i:s"),
					'order_create' => @$schedule ? @$scheduleTime : date("Y.m.d H:i:s"),
					'order_extras' => "",
					'create' => date("Y.m.d H:i:s"),
					'order_charge' => $money,
					'order_charge_before' => $money,
					'order_profit' => $quantity,
					'order_quantity' => $quantity,
					'order_remains' => 0,
					'order_status' => 'pending',
					'order_where' => $type,
					'schedule_time' => @$schedule ? @$scheduleTime : date("Y.m.d H:i:s"),
					'schedule' => @$schedule,
					'loop' => $loop,
					'currentmillis' => null
				];
			}
			try {

				// insert  vao bang orders
				$order = $this->orderRepository->create($paramsService);
				Log::notice('user id:' . $userId . ' order create ' . @$order->id . ' - ' . json_encode($paramsService));
				if ($order) {
					// tra ve json
					$results = [
						'order' => $order->id
					];

					if ($type == 'site') {
						$results['success'] = 'Order Successfully. OrderID: ' . $order->id . '. Charge: $' . $money;
					}
					if($service->mode == 2 && $schedule == 0 && $loop == 0){
						DB::beginTransaction();
						try {
							$this->handleCreateOrder($order);
							DB::commit();
						} catch (\Exception $e) {
							DB::rollback();
							Log::info('Error handleCreateOrder: ' . $e->getMessage());
						}
					}
					if($service->mode == 1){
						DB::beginTransaction();
						try {
							$this->handleCreateOrderManual($order);
							DB::commit();
						} catch (\Exception $e) {
							DB::rollback();
							Log::info('Error handleCreateOrderManual: ' . $e->getMessage());
						}
					}
					return response()->json($results);
				} else {
					return response()->json([
						'error' => "Not insert order",
					]);
				}
			} catch (\Exception $e) {
				Log::error('user id:' . $userId . ' newOrderService ' . $e->getMessage());
				return response()->json([
					'error' => "Create order erro",
				]);
			}
		}
	}

	public function handleCreateOrder($order)
	{
		try {
			$service = $order->service;
			$insert = false;
			$userId = $order->user_id;
			$money = $order->order_charge_before;
			$infoUser = $this->userRepository->find($userId);
			if (!empty($order->api_detail)) {
				if (!empty($service->provider)) {
					$paramsInsert = (array) json_decode($order->api_detail);
					$paramsInsert['link'] = $order->order_url;
					$paramsInsert['key'] = $service->provider->api_key;
					$paramsInsert['quantity'] = $order->order_quantity;
					$paramsInsert['service'] = $order->service->api_service;
					if (!empty($paramsInsert['key'])) {
						$orderResult = Helpers::action($paramsInsert, $service->provider->api_url, $service->provider->type_api);
						Log::info('orderResult: ' . json_encode($orderResult));
						if (!empty($orderResult->order)) {
							if (($infoUser->balance - $money) >= 0) {
								$apiDetail = json_encode($paramsInsert);
								$order->update([
									'api_detail' => $apiDetail,
									'api_orderid' => $orderResult->order,
									'order_detail' => json_encode($orderResult),
									'order_status' => 'pending',
									'status_handle' => 'finish',
								]);
								$insert = true;
							} else {
								$insert = false;
								$order->update([
									'no_balance_api' => 1,
									'order_detail' => '-',
									'order_error' => "Not enough funds",
									'order_status' => 'canceled',
									'order_charge' => 0,
									'status_handle' => 'finish',
								]);
							}
						} else {
							$order->update([
								'no_balance_api' => 1,
								'order_detail' => '-',
								'order_error' => json_encode($orderResult),
								'order_status' => 'processing',
								'status_handle' => 'finish',
							]);
							$insert = true;
						}
					}
				} else {
					$insert = false;
					Log::info(' not $service->provider '.json_encode($order));
				}
			} else {
				if (($infoUser->balance - $money) >= 0) {
					$insert = true;
					$order->update([
						'no_balance_api' => 0,
						'order_detail' => '-',
						'order_error' => '-',
						'order_status' => 'pending',
						'status_handle' => 'finish',
					]);
				} else {
					$insert = false;
					$order->update([
						'no_balance_api' => 1,
						'order_detail' => '-',
						'order_error' => "Not enough funds",
						'order_status' => 'canceled',
						'order_charge' => 0,
						'status_handle' => 'finish',
					]);
				}
			}
		} catch (\Exception $ex) {
			$insert = false;
			Log::error('handleCreateOrder' . $ex->getMessage());
			Log::error(json_encode($order));
		}

		if ($insert) {
			$infoUser = $this->userRepository->find($userId);

			$paramsCash = [
				'user_id' => $userId,
				'order_id' => $order->id,
				'type' => 'Add order',
				'cash' => '-' . $money,
				'total_cash' => $infoUser->balance - $money,
				'currentmillis' => (microtime(true) * 1000)
			];
			// insert vao cash_flows
			$this->cashFlowRepository->create($paramsCash);
			// tru tien user
			$paramsUser = ['balance' => $infoUser->balance - $money, 'spent' => $infoUser->spent + $money];
			$infoUser->update($paramsUser);
			Log::notice('user id:' . $userId . ' order handle ' . @$order->id . ' - ' . json_encode($paramsUser));
		}
	}

	public function handleCreateOrderManual($order)
	{
		$insert = false;
		$userId = $order->user_id;
		$money = $order->order_charge_before;
		$infoUser = $this->userRepository->find($userId);
		if (($infoUser->balance - $money) >= 0) {
			$order->update([
				'no_balance_api' => 0,
				'order_detail' => '-',
				'order_error' => '-',
				'order_status' => 'pending',
				'status_handle' => 'finish',
			]);
			$insert = true;
		} else {
			$insert = false;
			$order->update([
				'no_balance_api' => 1,
				'order_detail' => '-',
				'order_error' => "Not enough funds",
				'order_status' => 'canceled',
				'order_charge' => 0,
				'status_handle' => 'finish',
			]);
		}
		if ($insert) {
			$infoUser = $this->userRepository->find($userId);
			$paramsCash = [
				'user_id' => $userId,
				'order_id' => $order->id,
				'type' => 'Add order',
				'cash' => '-' . $money,
				'total_cash' => $infoUser->balance - $money,
				'currentmillis' => (microtime(true) * 1000)
			];
			// insert vao cash_flows
			$this->cashFlowRepository->create($paramsCash);
			// tru tien user
			$paramsUser = ['balance' => $infoUser->balance - $money, 'spent' => $infoUser->spent + $money];
			$infoUser->update($paramsUser);
			Log::notice('user id:' . $userId . ' order handle ' . @$order->id . ' - ' . json_encode($paramsUser));
		}
	}
}
