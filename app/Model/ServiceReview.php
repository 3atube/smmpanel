<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class ServiceReview extends Model
{
    protected $table = 'service_reviews';
    protected $fillable = [
        'user_id',
        'user_rating',
        'service_id',
        'user_review'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
