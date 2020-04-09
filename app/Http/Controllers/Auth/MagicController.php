<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\LoginToken;
use App\Services\Auth\MagicAuthentication;

//use App\Services\Auth\Traits\MagicAuthentication ;



use Illuminate\Http\Request;

class MagicController extends Controller
{  
    protected $auth;


public function __construct(MagicAuthentication $auth)
{  

    $this->middleware('guest');
    $this->auth = $auth;
} 



    public function showMagicForm(){

        return view('auth.magic-login');
    }  

   //public function sendToken(Request $request,MagicAuthentication $auth){

    public function sendToken(Request $request)
    {
          // dd($request->all());

          $this->validateForm($request);

          //generate token 

          //$auth->requestLink();

        $this->auth->requestLink();

          return back()->with('magicLinkSend',true);

    }  

    protected function validateForm($request){

           $request->validate([

            'email'=>['required','email','exists:users'],

           ]);
    } 

    public function login(LoginToken $token){

     
//dd($token);

$this->auth->authenticate($token)== $this->auth::AUTHENTICATED ?redirect()->route('home') : redirect()->route('auth.magic.login.form')->with('invalidToken',true);




    }
}
