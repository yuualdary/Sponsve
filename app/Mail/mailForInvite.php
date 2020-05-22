<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\company;
class mailForInvite extends Mailable
{
    use Queueable, SerializesModels;
    public $req;
    public $From;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($req,$From)
    {
        //
        $this->req=$req;
        $this->From=$From;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
 
      
            
            return $this->from('legionscriptsi@gmail.com')
                        ->view('Email')
                        ->with([
                            'Company_Name' =>  $this->req,
                            'Company_From'=>$this->From,
                        ]);
    }
        
    
}
