<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\TwoFactorAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TwofactorController extends Controller
{  

    public function __construct()
    {
      $this->middleware('auth');  
    }
    public function showToggleForm(){


        return view('auth.two-factor.toggle');
    } 

    public function activate(TwoFactorAuthentication $twoFactor){

       // dd('test');

     $response= $twoFactor->requestCode(Auth::user());


     return $response==$twoFactor::CODE_SENT ? redirect()->route('auth.two.factor.code.form'): back()->with('cant sent code',true);
    } 

    public function showEnterCodeForm(){

         return view('auth.two-factor.enter-code');
    }
}
