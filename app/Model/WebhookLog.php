<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    protected $table = 'webhook_logs';
    protected $fillable =[
        'json',
        'type',
        'header',
        'description',
        'amount'
    ];
}