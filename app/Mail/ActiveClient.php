<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ActiveClient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $link;
    public function __construct($link)
    {
        $this->link= $link;
    }
    public function build(){
        return $this->view('user.login.sendMail')
        ->from('lanhnn.21it@vku.udn.vn', 'nguyenngoclanh');
    }

    
}
