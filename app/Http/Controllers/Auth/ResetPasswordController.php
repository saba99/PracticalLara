<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function showResetForm(\Illuminate\Http\Request $request)
    {
        return view('auth.passwords.reset',[

        'email'=>$request->query('email'),

        'token'=>$request->query('token')


        ]);
    } 

    public function reset(Request $request){


        //validate 

        //$this->validateForm($request);

        //check token and email 


       $response= Password::broker()->reset([

          $request->only('email','password','password_confirmation','token'),
            
           function($user,$password){

            $this->resetPassword($user,$password);
           }
        ]);

        if($response==Password::PASSWORD_RESET){

            redirect()->route('auth.login')->with('passwordChanged',true);
        }

        back()->with('cant change password',true);
    }

    public function validateForm($request){

     $request->validate([

        'password'=>['required','string','confirmed','numeric'],
        'email'=>['required','email','exists:users'],
         
        'token'=>['required','string']

     ]);
    
    }

    protected function resetPassword($user, $password)
    {
        // dd($user,$password);

        $user->password=Hash::make($password);

        $user->save();
    }
}
