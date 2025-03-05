<?php
namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getOrder();

    public function findOrder($sid);

    public function getOrderById($user_id, $id);

    public function getOrderPending();

    public function getOrderPendingSchedule();

    public function getOrderManualHandle();

    public function updateManual($orders);

    public function getProcessingOrder();
    
    public function getOrderPendingHandleLoop();

    public function getOrderMoreQuantityHandle();

    public function countOrderMoreQuantity($sid);

    public function getOrderPendingHandle();
    
    public function searchOrder($status='', $order_id='', $link= '', $service_id ='', $user_id, $start, $length);

    public function findOrderByUser($orderId, $userId);
    
    public function getOrderPagi();

    public function getCountOrder();
    
    public function listOrderFilterByStatus($status, $service_id, $mode, $search = '', $searchType = '');
    
    public function listOrderFilter($service_id, $mode, $search = '', $searchType = '');

    public function countOrderRefill();

    public function countOrderUser($userId);

    public function listOrderFilterNoBalance($service_id, $mode);

    public function countStatus($status);

    public function updateStatus($Ids, $params);

    public function countOrderNoBalance();
}
