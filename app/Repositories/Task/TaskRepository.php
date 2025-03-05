<?php

namespace App\Repositories\Task;

use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Task::class;
    }

    public function getTasks($search, $search_type, $task_status)
    {
        return $this->model->select('*')->orderBy('id', 'desc')
            ->when(!empty($search) && !empty($search_type)  && $search_type == 'order_id', function ($query) use ($search) {
                return $query->where('order_id', $search);
            })
            ->when(!empty($task_status), function ($query) use ($task_status) {
                return $query->where('task_status', $task_status);
            })->paginate(20);
    }

    public function countTaskBeforeHour($orderId, $userId){
        return $this->model->select('id')->where('order_id', $orderId)->where('user_id', $userId)->where('created_at', '>', 
            \Carbon\Carbon::now()->subHours(config('app.time_refill'))->toDateTimeString()
        )->count();
    }

    public function countStatusPending()
    {
        return $this->model->select('id')->where('task_status', 'pending')->orderBy('id', 'desc')->count();
    }

    public function getStatusPending()
    {
        return $this->model->select('*')->where('task_status', 'pending')->orderBy('id', 'asc')->get();
    }

    public function firstTask($userId, $orderId, $type)
    {
        return $this->model->select('*')->where('user_id', $userId)->where('order_id', $orderId)->where('type', $type)->first();
    }

    public function updateCanceled($Ids){
        return $this->model->select('*')->whereIn('id', $Ids)->update(['task_status' => 'canceled']);
    }
}
