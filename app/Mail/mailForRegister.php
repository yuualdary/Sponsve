<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailForRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   
    public $To;
  
   public function __construct($To)
   {
       //

       $this->To=$To;
        
    
   }

   /**
    * Build the message.
    *
    * @return $this
    */
   public function build()
   {
       return $this->from('legionscriptsi@gmail.com')
                    ->view('EmailForRegister')
                    ->with([
                        'Company_Name' =>  $this->To,
                     
       ]);
   }
}
