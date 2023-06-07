<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActiveAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $link,$user;
    public function __construct($link,$user)
    {
        $this->link = $link;
        $this->user = $user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.login.sendMail')->subject('タレントマネジメントシステム登録完了のお知らせ')
            ->from('lanhnn.21it@vku.udn.vn', '人的資源管理');
    }
}
