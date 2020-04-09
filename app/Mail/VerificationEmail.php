<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\User;
use Illuminate\Support\Facades\URL;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */ 

     private $user;

    public function __construct(User $user)
    {
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('=emails.verification-email')->with(['link'=>$this->generateUrl(),'name'=>$this->user->name]);
    } 

    protected function generateUrl(){

   return   URL::temporarySignedRoute('auth.email.verify',now()->addMinutes(120),['email'=>$this->user->email]);
    }
}
