<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueueEmail extends Mailable
{
    use Queueable, SerializesModels;
        protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $info = $this->email;
        $title_email = $info['title_email'];
    	$subject = 'Chúc mừng bạn đã mua thành công item '.$title_email;
    	return $this->from($address = 'chowordpress@gmail.com', $name = 'Chợ Wordpress')->view('email.partials.email-cart')->subject($subject)
->with('email', $this->email);
    }
}
