<?php
namespace App\Repositories\TicketReply;

use App\Repositories\BaseRepository;

class TicketReplyRepository extends BaseRepository implements TicketReplyRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\TicketReply::class;
    }

    public function getTicketReply()
    {
        return $this->model->select('*')->orderBy('id','desc')->get();
    }
}
