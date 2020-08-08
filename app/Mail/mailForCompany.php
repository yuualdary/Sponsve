<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailForCompany extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   
    public $To;
    public $User;
  
   public function __construct($To, $User)
   {
       //

       $this->To=$To;
       $this->User=$User;
    
   }

   /**
    * Build the message.
    *
    * @return $this
    */
   public function build()
   {
       return $this->from('legionscriptsi@gmail.com')
                    ->view('EmailForCompany')
                    ->with([
                        'Company_Name' =>  $this->To,
                        'name'=>$this->User,
                        
                     
       ]);
   }
}
