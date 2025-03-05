<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = [
        'user_id',
        'subject',
        'time', 
        'lastupdate_time', 
        'client_new', 
        'status', 
        'support_new', 
        'canmessage', 
        'updated_at',
        'order_id',
        'request'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
}