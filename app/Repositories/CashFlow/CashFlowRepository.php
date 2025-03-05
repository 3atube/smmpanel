<?php
namespace App\Repositories\CashFlow;

use App\Repositories\BaseRepository;

class CashFlowRepository extends BaseRepository implements CashFlowRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\CashFlow::class;
    }

    public function getCashFlow($user_id)
    {
        return $this->model->select('*')->where('user_id', $user_id)->orderBy('id','desc')->paginate(200);
    }

    public function getCashFlowInfo($user_id, $order_id)
    {
        return $this->model->select('*')->where('user_id', $user_id)->where('order_id', $order_id)->orderBy('id','desc')->get();
    }

    public function getCashFlowInfoFirst($user_id, $order_id)
    {
        return $this->model->select('*')->where('user_id', $user_id)->where('order_id', $order_id)->orderBy('id','desc')->first();
    }

    public function firstCashFlow($userId, $orderId, $type)
    {
        return $this->model->select('*')->where('user_id', $userId)->where('order_id', $orderId)->where('type', $type)->first();
    }
}