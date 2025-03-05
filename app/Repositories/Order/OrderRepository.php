<?php

namespace App\Repositories\Order;

use App\Repositories\BaseRepository;
use App\Libraries\Helpers;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Order::class;
    }

    public function getOrder()
    {
        return $this->model->select('*')->orderBy('id', 'desc')->get();
    }

    public function findOrder($sid)
    {
        return $this->model->select('*')->where('id', $sid)->first();
    }

    public function updateManual($orders)
    {
        return $this->model->select('*')->whereIn('id', $orders)->update(['admin_manual' => 1]);
    }

    public function getProcessingOrder()
    {
        $now = \Carbon\Carbon::now();
        $sixHoursAgo = $now->subHours(6);
        return $this->model->select('*')->where('order_status', 'processing')->where('created_at', '<', $sixHoursAgo)->pluck('id')->toArray();
    }

    public function getOrderById($user_id, $id)
    {
        return $this->model->select('*')->where('user_id', $user_id)->where('id', $id)->first();
    }

    public function getOrderManualHandle()
    {
        return $this->model->select('*')->whereHas('service', function($query){
            $query->where('mode', '1');
        })->where('status_handle', 'pending')->where('api_orderid', 0)->where('schedule', 0)->where('order_status', 'pending')->orderBy('id', 'asc')->limit(10000)->get();
    }

    public function getOrderPendingHandle()
    {
        return $this->model->select('*')->whereHas('service', function($query){
            $query->where('mode', '2');
        })->where('status_handle', 'pending')->where('api_orderid', 0)->where('schedule', 0)->where('order_status', 'pending')->orderBy('id', 'asc')->limit(10000)->get();
    }

    public function getOrderPendingHandleLoop() {
        return $this->model->select('*')->whereHas('service', function($query){
            $query->where('mode', '2');
        })->where('order_status', 'completed')->where('loop', '>', 0)->orderBy('id', 'desc')->get();
    }

    public function getOrderMoreQuantityHandle() {
        return $this->model->select('*')->where('order_status', 'completed')->where('order_more_quantity', '>', 0)->orderBy('id', 'desc')->get();
    }

    public function countOrderMoreQuantity($sid) {
        return $this->model->select('*')->where('order_more_id', $sid)->count();
    }

    public function findOrderByUser($orderId, $userId)
    {
        return $this->model->select('*')->where('id', $orderId)->where('user_id', $userId)->first();
    }

    public function getOrderPendingSchedule()
    {
        return $this->model->select('*')->whereHas('service', function($query){
            $query->where('mode', '2');
        })->where('status_handle', 'pending')
        ->where('api_orderid', 0)->where('order_status', 'pending')->where('schedule', 1)->orderBy('schedule_time', 'asc')->get();
    }

    public function getOrderPending()
    {
        return $this->model = $this->model->select('*')
            ->whereIn('order_status', ['fail', 'pending', 'inprogress', 'partial', 'processing', 'refill'])
            ->whereHas('service', function($query){
                $query->where('mode', '2');
            })
            ->where('partial', 0)
            ->where('sync_api', 1)
            ->where('api_orderid', '<>', 0)
            ->orderBy('schedule_time', 'asc')->get();
    }

    public function searchOrder($status = '', $order_id = '', $link = '', $service_id = '', $user_id, $start, $length)
    {
        $status = Helpers::getStatusOrder1($status);
        return $this->model->select('*')->where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->when(!empty($status), function ($q) use ($status) {
                return $q->where('order_status', $status);
            })
            ->when(!empty($order_id), function ($q) use ($order_id) {
                return $q->where('id', $order_id);
            })
            ->when(!empty($link), function ($q) use ($link) {
                return $q->where('order_url', $link);
            })
            ->when(!empty($service_id), function ($q) use ($service_id) {
                return $q->where('service_id', $service_id);
            })
            ->offset($start)->take($length)->get();
    }

    public function countOrderUser($userId)
    {
        return $this->model->select('id')->where('user_id', $userId)->count();
    }

    public function getOrderPagi()
    {
        return $this->model->select('*')->orderBy('id', 'desc')->paginate(20);
    }

    public function listOrderFilter($service_id, $mode, $search = '', $searchType = '')
    {
        return $this->model->select('*')
            ->when(!empty($service_id), function ($q) use ($service_id) {
                return $q->where('service_id', $service_id);
            })
            ->when(!empty($mode) && $mode == 'manuel', function ($q) {
                return $q->where('api_serviceid',  0);
            })
            ->when(!empty($mode) && $mode != 'manuel', function ($q) {
                return $q->where('api_serviceid', '<>', 0);
            })
            ->when(!empty($search) && $searchType == 'order_url', function ($q) use ($search) {
                return $q->where('order_url', 'like', '%'.$search.'%');
            })
            ->when(!empty($search) && $searchType == 'details', function ($q) use ($search) {
                return $q->where('details', 'like', '%'.$search.'%');
            })
            ->when(!empty($search) && $searchType == 'order_id', function ($q) use ($search) {
                $searchs = explode(',',$search);
                return $q->whereIn('id', $searchs);
            })
            ->when(!empty($search) && $searchType == 'username', function ($q) use ($search) {
                return $q->whereHas('user', function($q) use ($search){
                    $q->where('name', $search);
                });
            })->orderBy('id', 'desc')->paginate(50);
    }

    public function countOrderRefill()
    {
        return $this->model->where('order_status', 'refill')->count();
    }

    public function listOrderFilterNoBalance($service_id, $mode)
    {
        return $this->model->select('*')->where('no_balance_api', '1')->when(!empty($service_id), function ($q) use ($service_id) {
            return $q->where('service_id', $service_id);
        })
            ->when(!empty($mode) && $mode == 'manuel', function ($q) {
                return $q->where('api_serviceid',  0);
            })
            ->when(!empty($mode) && $mode != 'manuel', function ($q) {
                return $q->where('api_serviceid', '<>', 0);
            })->orderBy('id', 'desc')->paginate(20);
    }

    public function listOrderFilterByStatus($status, $service_id, $mode, $search = '', $searchType = '')
    {
        return $this->model->select('*')
            ->when(!empty($service_id), function ($q) use ($service_id) {
                return $q->where('service_id', $service_id);
            })
            ->when(!empty($mode) && $mode == 'manuel', function ($q) {
                return $q->where('api_serviceid',  0);
            })
            ->when(!empty($mode) && $mode != 'manuel', function ($q) {
                return $q->where('api_serviceid', '<>', 0);
            })
            ->when($status == 'fail', function ($q) {
                return $q->where(function ($query) {
                    $query->where('order_status', 'processing')->where('no_balance_api', 1);
                })->orWhere('order_status', 'fail');
            })->when($status != 'fail', function ($q) use ($status) {
                return $q->where('order_status', $status);
            })
            ->when(!empty($search) && $searchType == 'order_url', function ($q) use ($search) {
                return $q->where('order_url', 'like', '%'.$search.'%');
            })
            ->when(!empty($search) && $searchType == 'order_id', function ($q) use ($search) {
                $searchs = explode(',',$search);
                return $q->whereIn('id', $searchs);
            })
            ->when(!empty($search) && $searchType == 'username', function ($q) use ($search) {
                return $q->whereHas('user', function($q) use ($search){
                    $q->where('name', $search);
                });
            })->orderBy('id', 'desc')->paginate(50);
    }

    public function getCountOrder()
    {
        return $this->model->select('id')->count();
    }

    public function countStatus($status)
    {
        return $this->model->select('id')
            ->when($status == 'fail', function ($q) {
                return $q->where(function ($query) {
                    $query->where('order_status', 'processing')->where('no_balance_api', 1);
                })->orWhere('order_status', 'fail');
            })->when($status != 'fail', function ($q) use ($status) {
                return $q->where('order_status', $status);
            })->count();
    }

    public function getCountOrderUser($status = '', $order_id = '', $link = '', $service_id = '',$user_id)
    {
        $status = Helpers::getStatusOrder1($status);

        return $this->model->select('id')->where('user_id', $user_id)
        ->when(!empty($status), function ($q) use ($status) {
            return $q->where('order_status', $status);
        })
        ->when(!empty($order_id), function ($q) use ($order_id) {
            return $q->where('id', $order_id);
        })
        ->when(!empty($link), function ($q) use ($link) {
            return $q->where('order_url', $link);
        })
        ->when(!empty($service_id), function ($q) use ($service_id) {
            return $q->where('service_id', $service_id);
        })
        ->count();
    }

    public function countOrderNoBalance()
    {
        return $this->model->select('id')->where('no_balance_api', 1)->count();
    }

    public function updateStatus($Ids, $params)
    {
        return $this->model->select('id')->whereIn('id', $Ids)->update($params);
    }
}
