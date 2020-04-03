<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailForAcceptRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */

    public $To;
    public $From;
    public $StatusRequest;
    public $CanRequestAt;
    public function __construct($To,$From,$StatusRequest,$CanRequestAt)
    {
        //

        
        $this->To=$To;
        $this->From=$From;
        $this->StatusRequest=$StatusRequest; 
        $this->CanRequestAt=$CanRequestAt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('legionscriptsi@gmail.com')
                    ->view('EmailForAcceptReq')
                    ->with([
                        'Company_Name' =>  $this->To,
                        'Company_From'=>$this->From,
                        'Status'=>$this->StatusRequest,
                        'At'=>$this->CanRequestAt,
                    ]);   
     }
}
