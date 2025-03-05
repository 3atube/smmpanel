<?php
namespace App\Repositories\UserPrice;

use App\Repositories\RepositoryInterface;

interface UserPriceRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getUserPrice();

    public function findUserPriceByKey($key);

    public function deletePrice($service_id, $user_id);

    public function findPrice($service_id, $user_id);

    public function countPrice($user_id);

    public function deleteService($service_id);
}