<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TopicCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $name;

     private $first_name;

     private $last_name;

    public function __construct()
    {
        $this->name='saba';

        $this->first_name='saba';

        $this->last_name='hesaraki';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.topic-created')->with(['full_name'=>$this->first_name.' '.$this->last_name]);
    }
}
