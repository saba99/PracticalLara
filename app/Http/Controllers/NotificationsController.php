<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Services\Notification\Constant\EmailTypes;
use App\Services\Notification\Notification;
use Illuminate\Http\Request;

use App\User;

class NotificationsController extends Controller
{
   public function email(){
     

    $users=User::all();

    $emailTypes=EmailTypes::toString();
    return view('notification.send-email',compact(['users','emailTypes']));


   } 

   public function sendEmail(Request $request){



      $request->validate([

        'user'=>'integer|exists:users,id',
        'email_type'=>'integer'
      ]);

    // dd($request->all());
try {

         $notification = resolve(Notification::class);



         $mailable = EmailTypes::ToMail($request->email_type);
         //dd($mailable);
         $notification->sendEmail(User::findOrFail($request->user), new $mailable);

         //SendEmail::dispatch(User::findOrFail($request->user), new $mailable);


         return redirect()->back()->with('success', __('notification.email_sent_successfully'));
} catch (\Throwable $th) {
  


   return redirect()->back()->with('failed', __('notification.email_has_problem'));
}

   }

   public function sms(){ 

      $users=User::all();

      return view('notification.send-sms',compact(['users']));
   } 

   public function sendSms(Request $request,Notification $notification){


   

    $request->validate([

     'users'=>'integer|exists:users,id',

     'text'=>'string|max:256'


    ]);
//dd($request->all());
try {
   $notification->sendSms(User::FindOrFail($request->user),$request->text);

//return redirect()->back()->with('success',__('notification.sms.sent_successfully'));

         return $this->RedirectBack('success', __('notification.sms.sent_successfully'));

} catch (\App\Services\Notification\Exception\UserDoesNotHavePhoneNumber $e) {


         //return redirect()->back()->with('failed',_('notification.user_does_not_have_phone_number'));

         return $this->RedirectBack('failed', __('notification.user_does_not_have_phone_number'));
}

catch(\Exception $e){

         //return redirect()->back()->with('failed', _('notification.sms_has_problem'));

         return $this->RedirectBack('failed', _('notification.sms_has_problem'));

}
   }

private function RedirectBack(String $type,String $text){

return redirect()->back()->with($type,$text);

}
}
