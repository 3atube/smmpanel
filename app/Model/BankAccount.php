<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use App\Libraries\Helpers;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';
    protected $fillable = [
        'bank_name',
        'bank_sube',
        'bank_hesap', 
        'bank_iban', 
        'bank_content',
        'line',
        'bank_alici', 
    ];
    
}