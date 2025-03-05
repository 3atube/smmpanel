<?php
namespace App\Repositories\Notification;

use App\Repositories\RepositoryInterface;

interface NotificationRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getNotification();

    public function listAll();
}
