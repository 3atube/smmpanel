<?php
namespace App\Repositories\TicketReply;

use App\Repositories\RepositoryInterface;

interface TicketReplyRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getTicketReply();
}
