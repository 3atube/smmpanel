<?php
namespace App\Repositories\CashFlow;

use App\Repositories\RepositoryInterface;

interface CashFlowRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getCashFlow($user_id);

    public function getCashFlowInfo($user_id, $order_id);

    public function getCashFlowInfoFirst($user_id, $order_id);

    public function firstCashFlow($userId, $orderId, $type);
}