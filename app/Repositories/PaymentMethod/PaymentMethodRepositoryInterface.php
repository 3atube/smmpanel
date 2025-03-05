<?php
namespace App\Repositories\PaymentMethod;

use App\Repositories\RepositoryInterface;

interface PaymentMethodRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getPaymentMethod();

    public function findMethodGet($id);

    public function getMethodStatus();
}
