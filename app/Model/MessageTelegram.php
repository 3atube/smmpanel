<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MessageTelegram extends Model
{
    protected $table = 'message_telegrams';

    protected $fillable = [
        'brand_id',
        'channel',
        'message',
        'type',
        'status',
    ];
     public static function getAll()
    {
        return DB::table('message_telegrams as s')->select('s.*')->get();
    }
    public static function get_limit($limit)
    {
        return DB::table('message_telegrams as s')->select('s.*')->limit($limit)->get();
    }
    public static function get_where($where)
    {
        return DB::table('message_telegrams as s')->select('s.*')->where('id',$where)->get();
    }
}
