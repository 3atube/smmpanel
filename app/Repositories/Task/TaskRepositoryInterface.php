<?php
namespace App\Repositories\Task;

use App\Repositories\RepositoryInterface;

interface TaskRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getTasks($search, $search_type, $task_status);

    public function countTaskBeforeHour($orderId, $userId);

    public function countStatusPending();

    public function getStatusPending();

    public function firstTask($userId, $orderId, $type);

    public function updateCanceled($Ids);
}
