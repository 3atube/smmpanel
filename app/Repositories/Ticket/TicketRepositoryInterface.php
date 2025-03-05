<?php
namespace App\Repositories\Ticket;

use App\Repositories\RepositoryInterface;

interface TicketRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getTicket($status, $search);

    public function getTicketUsers($userId);

    public function getMessageById($id);

    public function getUnreadCount();

    public function maxTicket($userId);

    public function getTicketOrder($orderId);
}
