<?php
namespace App\Repositories\Notification;

use App\Repositories\BaseRepository;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Notification::class;
    }

    public function getNotification()
    {
        return $this->model->select('*')->orderBy('id','desc')->paginate(20);
    }

    public function listAll()
    {
        return $this->model->select('*')->where('status', 'active')->orderBy('id','desc')->get();
    }
    
}
