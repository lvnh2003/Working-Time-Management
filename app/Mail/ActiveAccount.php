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
    public $link;
    public function __construct($link)
    {
        $this->link = $link;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.login.sendMail')
            ->from('lanhnn.21it@vku.udn.vn', 'nguyenngoclanh');
    }
}
