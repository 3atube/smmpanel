<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mail2FaAdmin extends Mailable
{
  use Queueable, SerializesModels;
  protected $email;
  protected $code;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($email, $code)
  {
    $this->email = $email;
    $this->code = $code;

    //
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $subject = 'Admin two-factor authentication code';
    return $this->view('email.partials.email-2fa')->subject($subject)
      ->with('email', $this->email)->with('code', $this->code);
  }
}
