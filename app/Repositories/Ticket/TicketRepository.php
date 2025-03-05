<?php
namespace App\Repositories\Ticket;
use DB;
use App\Repositories\BaseRepository;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Model\Ticket::class;
    }

    public function getTicket($status, $search, $search_type= '')
    {
        return $this->model->select('*')->orderBy('updated_at', 'desc')
        ->when(!empty($status), function($query) use ($status){
            return $query->where('status', $status);
        })->when(!empty($search) && $search=='unread', function($query) use ($search){
            return $query->where('client_new', 2);
        })->when(!empty($search) && $search_type=='client', function ($q) use ($search) {
            return $q->whereHas('user', function($q) use ($search){
              $q->where('name', $search);
          });
      })->when(!empty($search) && $search_type=='subject', function ($q) use ($search) {
                $q->where('subject', $search);

        })->paginate(20);
    }

    public function getTicketOrder($orderId)
    {
        return $this->model->select('*')->where('order_id', $orderId)->first();
    }

    public function getTicketUsers($userId)
    {
        return $this->model->select('*')->where('user_id', $userId)->orderBy('id', 'desc')->paginate(20);
    }

    public function getMessageById($id)
    {
        return $this->model->select('*')->join('ticket_reply','ticket_reply.ticket_id','=','tickets.id')->where('tickets.id', $id)->orderBy('ticket_reply.id', 'desc')->get();
    }

    public function getUnreadCount()
    {
        return $this->model->select('id')->where('client_new', 2)->count();
    }

    public function maxTicket($userId)
    {
        return $this->model->select('id')->where(DB::raw('date(created_at)'),'=',date('Y-m-d'))->where('user_id', $userId)->count();
    }

    public function countTicketUser($userId)
    {
        return $this->model->select('id')->where('support_new', 2)->where('user_id', $userId)->count();
    }

}
