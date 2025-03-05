<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = [
        'language_key', 'language_value'
    ];
}