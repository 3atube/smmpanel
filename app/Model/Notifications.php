<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model{
	protected $table = 'notifications';

    protected $fillable = [
        'message',
        'link',
        'author',
        'type',
        'time',
        'status',
    ];
     public static function all($filters = [])
    {
        $q = DB::table('notifications as s')
            ->select('s.*');
        $q = myHelper::buildSQL($q, $filters, 's.updated_at', 'desc');

        return Datatables::queryBuilder($q)->make(true);

    }
    public static function get_status_pending($id){
         $q = DB::table('notifications as s')
         ->where('author',$id)
         ->where('status',config('mualike.status.pending'))
        ->select('s.*')
        ->orderBy('s.updated_at', 'desc')
        ->get();
        return $q;
    }
     public static function count_status_pending($id){
         $q = DB::table('notifications as s')
         ->where('author',$id)
         ->where('status',config('mualike.status.pending'))
        ->select('s.*')
        ->orderBy('s.updated_at', 'desc')
        ->count();
        return $q;
    }
   
    public static function getAll()
    {
        return DB::table('notifications as s')->select('s.*')->get();
    }

    public static function search($params = ''){
        return Datatables::queryBuilder(DB::table('notifications as s')
            ->select('s.*')
            ->where('s.message', 'like', '%' . $params . '%')
            ->orderBy('s.updated_at', 'desc')
        )->make(true);
    }

    public static function removeAll(){
        return DB::table('notifications')->truncate();
    }

    public static function batchRemove($params){
        return DB::table('notifications')
            ->whereIn('id', $params)
            ->delete();
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}