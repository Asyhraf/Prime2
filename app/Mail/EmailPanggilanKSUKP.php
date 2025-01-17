<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPanggilanKSUKP extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('email.panggilan')
                    ->with('data', $this->data)
                    ->subject($this->data['subject'])
                    ->html($this->data['message']); // Use the message from the form
    }
}
