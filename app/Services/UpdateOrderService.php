<?php

namespace App\Services;

use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

use App\Libraries\Helpers;
use Log;

class UpdateOrderService
{
    protected $serviceRepository;
    protected $orderRepository;
    protected $cashFlowRepository;
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, ServiceRepositoryInterface $serviceRepository, OrderRepositoryInterface $orderRepository, CashFlowRepositoryInterface $cashFlowRepository)
    {
        $this->userRepository = $userRepository;
        $this->serviceRepository = $serviceRepository;
        $this->orderRepository = $orderRepository;
        $this->cashFlowRepository = $cashFlowRepository;
    }

    public function updateOrderProvider($item)
    {
        try {
            $id = $item->id;
            $info = $this->orderRepository->find($id);
            $order_id = $item->api_orderid;
            
            if ($order_id > 0) {
                $service = $this->serviceRepository->find($info->service_id);
                if ($service) {
                    if($service->provider){
                        // check api history provider
                        $paramsInsert = [
                            'key' => $service->provider->api_key,
                            'action' => 'status',
                            'order' => $order_id,
                        ];
                        $api_url = $service->provider->api_url;
                        $type_api = $service->provider->type_api;
                        $history = $info->history_api_provider;
                        if($history != null && count($history) > 0 && $info->is_active_provider == 0){
                            $providerNew = (object) @$history;
                            $api_url = $providerNew->api_url;
                            $type_api = $providerNew->type_api;
                            $paramsInsert = [
                                'key' => $providerNew->api_key,
                                'action' => 'status',
                                'order' => $order_id,
                            ];
                        }
                        $json = Helpers::action($paramsInsert, $api_url, $type_api);
                        $info->update(['details' => json_encode($json, true)]);
                        if (!empty($json->status)) {
                            
                            $statusApi = $json->status;
                            $remains = !empty($json->remains) ? $json->remains : 0;
                            $start_count = !empty($json->start_count) ? $json->start_count : 0;
                            // 
                            $order_status = strtolower($statusApi);
                            if (strtolower($statusApi) == 'in progress') {
                                $order_status = 'inprogress';
                            }

                            if ($statusApi == 'Canceled') {

                                $paramsUpdate = [
                                    'admin_manual' => 0,
                                    'order_start' => $start_count,
                                    'order_remains' => $remains,
                                    'order_status' => $order_status,
                                    'order_charge' => 0
                                ];
                                $info->update($paramsUpdate);
                                // 
                                $charge = $info->order_charge_before;

                                $user_id = $info->user_id;
                                $type = 'Canceled';

                                $firstCashFlow = $this->cashFlowRepository->firstCashFlow($user_id, $info->id, $type);
                                if (!$firstCashFlow) {
                                    $cash = '+' . $charge;
                                    $user = $this->userRepository->find($user_id);
                                    $total_cash = $user->balance + $charge;
                                    $spent  = $user->spent - $charge;
                                    $user->update(['balance' => $total_cash, 'spent' => $spent]);
                                    $paramsCash = [
                                        'user_id' => $user_id,
                                        'order_id' => $info->id,
                                        'cash' => $cash,
                                        'total_cash' => $total_cash,
                                        'type' => $type
                                    ];
                                    $this->cashFlowRepository->create($paramsCash);
                                }

                                Log::notice('id:' . $info->id . ' update Canceled ' . json_encode($paramsUpdate));
                            } else if ($statusApi == 'Partial') {
                                $service = $this->serviceRepository->firstServiceUserPrice($info->user_id, $info->service_id);
                                $orderCharge = $info->order_charge_before;
                                $price  = $orderCharge / $info->order_quantity;
                                if ($service) {
                                    $clientprice = $service->clientprice ? $service->clientprice : $service->price;
                                    $price = $clientprice / 1000;
                                    $orderCharge = $price * $info->order_quantity;
                                }
                                $return = $price * $remains;
                                $charge = $orderCharge - $return;
                                $paramsUpdate = [
                                    'order_start' => $start_count,
                                    'order_remains' => $remains,
                                    'order_status' => $order_status,
                                    'admin_manual' => 0,
                                    'order_charge' => $charge,
                                    'partial' => 1
                                ];
                                // 0.0228
                                $info->update($paramsUpdate);
                                $user_id = $info->user_id;
                                $type = 'Partial';
                                $firstCashFlow = $this->cashFlowRepository->firstCashFlow($user_id, $info->id, $type);
                                if (!$firstCashFlow) {
                                    $cash = '+' . ($return);
                                    $user = $this->userRepository->find($user_id);
                                    $total_cash = $user->balance + ($return);
                                    $spent  = $user->spent - $return;

                                    $user->update(['balance' => $total_cash, 'spent' => $spent]);
                                    $paramsCash = [
                                        'user_id' => $user_id,
                                        'order_id' => $info->id,
                                        'cash' => $cash,
                                        'total_cash' => $total_cash,
                                        'type' => $type
                                    ];
                                    $this->cashFlowRepository->create($paramsCash);
                                }

                                Log::notice('id:' . $info->id . ' update Partial ' . json_encode($paramsUpdate));
                            } else {
                                $paramsUpdate = [
                                    'order_start' => $start_count,
                                    'order_remains' => $remains,
                                    'order_status' => $order_status,
                                    'admin_manual' => 0,
                                ];
                                $info->update($paramsUpdate);
                                Log::notice('id:' . $info->id . ' update success ' . json_encode($paramsUpdate));
                            }
                        } else {
                            // error
                            Log::error('id:' . $info->id . ' error ' . json_encode($json));
                        }
                    }

                }
            }
        } catch (\Exception $e) {
            Log::error('id:' . $info->id . ' updateOrderProvider ' . $e->getMessage());
        }
    }
}
