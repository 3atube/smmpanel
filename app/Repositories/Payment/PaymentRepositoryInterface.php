<?php
namespace App\Repositories\Payment;

use App\Repositories\RepositoryInterface;

interface PaymentRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getPaymentPagi($type='');

    public function historyPayment($userId, $from, $to);

    public function getPaymentByCategory($category);

    public function getLastLine($category);

    public function findTranId($tranId);
    
    public function updateLinePayment($category, $line);

    public function getPaymentUserPrice($user_id);

    public function removeByCategory($category);
}
