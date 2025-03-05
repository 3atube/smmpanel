<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class TicketReply extends Model
{
    protected $table = 'ticket_reply';
    protected $fillable = [
        'ticket_id',
        'user_id',
        'time', 
        'image',
        'support_team', 
        'support', 
        'message', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function ticket()
    {
        return $this->belongsTo('App\Model\Ticket', 'ticket_id');
    }
}