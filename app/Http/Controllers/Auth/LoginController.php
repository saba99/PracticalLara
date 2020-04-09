<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use ThrottlesLogins;

//protected $maxAttemps=2;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
      
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    } 

    public function showLoginForm(){

        return view('auth.login');
    } 

    public function login(Request $request){

    //validate 

$this->validateForm($request);

    if($this->hasTooManyLoginAttempts($request)){


        //$this->fireLockoutEvent($request);
         $this->incrementLoginAttempts($request);
        return $this->sendLockoutResponse($request);
    }



    //check user and password

    //login 
    
    if($this->attemptLogin($request)){

    
       return  $this->sendSuccessResponse();

    }

    return $this->sendFailedLoginResponse();
    

    }

   protected function validateForm(Request $request){

    $request->validate([

'email'=>['required','email','exists:users'],
'password'=>['required'],
//'g-recaptcha-response'=>['required',new Recaptcha]


    ],[

        'g-recaptcha-response'=>__('auth.recaptcha')
    ]);

   } 

   protected function attemptLogin(\Illuminate\Http\Request $request)
   {
       return Auth::attempt($request->only('email' , 'password'), $request->filled('remember'));
   } 

   protected function sendSuccessResponse(){
      

    session()->regenerate();
      return redirect()->intended();
   }

   protected function sendFailedLoginResponse(){

    return back()->with('wrongCredentials',true);
   }  

   public function logout(){

    session()->invalidate();
    Auth::logout();
    return redirect()->route('home');
   } 

   protected function username(){

              return 'email';
   }
} 
