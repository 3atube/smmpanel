<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'panel_name',
        'site_maintenance',
        'custom_banner',
        'custom_buy',
        'color',
        'layout',
        'channel_post',
        'token_telegram'
    ];
}
