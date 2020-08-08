<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailForPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $User;
    public $Code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->User = $User;
        $this->Code = $Code;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('legionscriptsi@gmail.com')
                      ->view('EmailForgetPassword')
                      ->with([
                          'User' =>  $this->User,
                          'Code'=>$this->Code,
        ]);
    }
}
