<?php  

namespace App\Services\Notification\Providers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\User;

use App\Services\Notification\Providers\Contracts\Provider;

class EmailProvider implements Provider{
   
   

    private $user;

    private $mailable;

    public function __construct(User $user, Mailable $mailable  )
    {
        $this->user=$user;

        $this->mailable=$mailable;
    }

    /*public function send(User $user, Mailable $mailable)
    {

        return  Mail::to($user)->send($mailable);
    }*/
    public function send()
    {

        return  Mail::to($this->user)->send($this->mailable);
    }

}