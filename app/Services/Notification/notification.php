<?php  

namespace App\Services\Notification;

use App\Services\Notification\Providers\EmailProvider;
use App\Services\Notification\Providers\SmsProvider;
use App\User;
use GuzzleHttp\Client;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Services\Notification\Providers\Contracts\Provider;


/**
 *  @method sendSms(User $user,String $text)
 *  @method  sendEmAIL(User $user,Mailable $mailable) 



*/


class Notification{


 /*public function sendEmail(User $user,Mailable $mailable){



    $emailProvider=new EmailProvider();

    return $emailProvider->send($user,$mailable);


 }
    public function sendSms(User $user, String  $text)
    {



        $smsProvider = new SmsProvider();

        return $smsProvider->send($user, $text);
    }*/
 
   public function __call($method, $arguments)
   {
        //dd($method); 

        $providerPath=__NAMESPACE__.'\Providers\\'. substr($method,4).'Provider';

        if(!class_exists($providerPath)){


            throw new \Exception("Class does not exists");
        }

        $providerInstance=new $providerPath(...$arguments);

        //dd(...$arguments);

        if(!\is_subclass_of($providerInstance,Provider::class)){

            throw new  \Exception('class must implement Provider',1);
        }

       return  $providerInstance->send();

        //dd($providerPath);
   }
 

}