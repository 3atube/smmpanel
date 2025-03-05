<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'title', 'type', 'content', 'status'
    ];
}