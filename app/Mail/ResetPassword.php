<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $user;
     private $token;

    public function __construct(User $user,String $token)
    {
       $this->user=$user;

       $this->token=$token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset-password')->with(['link'=>$this->generateLink()]);
    } 

    protected function generateLink(){


     return route('auth.password.reset.form',['token'=>$this->token,'email'=>$this->user->email]);

    }

    public function reset(Request $request){
     
        dd($request->all());

    }
}
