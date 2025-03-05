<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'category_name', 'name_lang', 'category_line', 'category_type', 'status', 'category_secret', 'line', 'count_service'
    ];
}
