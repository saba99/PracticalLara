<?php  

namespace  App\Services\Auth;

use App\TwoFactor;
use App\User;
use Illuminate\Http\Request;

class TwoFactorAuthentication{


    protected $request;

    const CODE_SENT='code.sent';


    public function __construct(Request $request)
    {
          $this->request=$request;
    }  

    public function requestCode(User $user){

        //generate Code 
     
       $code=TwoFactor::generateCodeForm($user);
        //send code 
         $code->send();
        //dd($code);

        return static::CODE_SENT;
        
    }
}