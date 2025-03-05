<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File,DB,Log;
use App\Model\Order;
use App\Model\MessageTelegram;
use App\Model\Transaction;
use App\Model\Download;
use App\Model\Theme;
use App\Model\EmailJob;
use App\Libraries\Helpers,WebService;
use App\Mail\QueueEmail;
use App\User;
use Mail;


class QueueEmailCronTab extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'systems:queue-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $items = EmailJob::where('status',0)->get();
        if(!empty($items)){
            foreach ($items as $key => $item) {
                $content = $item->content;
                $arr_theme = explode('_', $content);
                $arrSend = [];
                $arrTile = [];
                foreach ($arr_theme as $item_theme) {
                    $info_theme = Theme::find($item_theme);
                    $arrInfoSend = [];
                    $arrInfoSend['title'] = $info_theme->title;
                    $arrInfoSend['slug'] = route('singleDetails.item',array($info_theme->slug));
                    $arrInfoSend['image'] = asset('images/product/'.$info_theme->thubnail);
                    $arrInfoSend['price'] = number_format($info_theme->price_origin);
                    $arrSend['list'][] = $arrInfoSend;
                    $arrTile[] = $info_theme->title;
                }
                $title_email = implode(',', $arrTile);
                $arrSend['title_email'] = $title_email;
                $mailable = new QueueEmail($arrSend);
                $user = User::find($item->user_id);
                $email = $user->email;
                $result =  Mail::to($email)->send($mailable);
                $item->update(['status'=>1]);
            }
        }
        echo "done";
    }
}
