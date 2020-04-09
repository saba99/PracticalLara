<?php  

namespace App\Services\Auth;

use Illuminate\Http\Request;

use App\User;
use App\LoginToken;
use Illuminate\Support\Facades\Auth;

class MagicAuthentication{
  

const INVALID_TOKEN='token.invalid';

const AUTHENTICATED='authenticated';


protected $request;

public function __construct(Request $request)
{
    $this->request=$request;
}
public function requestLink(){

$user=$this->getUser();
//generate link 

$token=$user->createToken()->send([

    'remember'=>$this->request->has('remember'),
    'email'=>$user->email
]);
//send link 

//dd($token);



}

public function getUser(){

    return User::where('email',$this->request->email)->firstOrFail();
}

    public function authenticate(LoginToken $token)
    {
         $token->delete();
        //validate token 

        if ($token->isExpired()) {

         return self::INVALID_TOKEN;

        }

        Auth::login($token->user,$this->request->query('remember'));
        //login 

         return self::AUTHENTICATED;
        //return response 
    }
}
