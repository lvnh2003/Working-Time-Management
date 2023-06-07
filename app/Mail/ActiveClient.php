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
    public $link,$user,$password;
    public function __construct($link,$user,$password)
    {
        $this->link= $link;
        $this->user= $user;
        $this->password= $password;
    }
    public function build(){
        return $this->view('user.login.mailClient')->subject('タレントマネジメントシステム登録完了のお知らせ')
        ->from('lanhnn.21it@vku.udn.vn', '人的資源管理');
    }

    
}
