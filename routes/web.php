<?php

use App\Mail\TopicCreated;
use App\Mail\UserRegistered;
use App\Services\Notification\Notification;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

Route::get('/', function () {

    /*Mail::to('sabaparadisesisco@gmail.com')->send(new TopicCreated);

    Mail::to('sabaparadisesisco@gmail.com')->send(new UserRegistered);*/


    //$notifaction=new Notification();

   $notifaction=resolve(Notification::class);
    
    $notifaction->sendEmail(User::find(1),new TopicCreated);
   //$notifaction->sendTelegram(User::find(1),new TopicCreated);

    //$notifaction->sendSms(User::find(2), 'این یک پیام تست از طرف صبا به آقام قوقول جیگر می باشد ');
    

    $url=URL::temporarySignedRoute('test',now()->addMinutes(60),['id'=>12]);
   //dd($url);

    return view('layouts.home');

});

Route::get('/notification/send-email','NotificationsController@email')->name('notification.form.email');

Route::post('/notification/send-email','NotificationsController@sendEmail')->name('notification.send.email');

Route::get('/notification/send-sms', 'NotificationsController@sms')->name('notification.form.sms');

Route::post('/notification/send-sms', 'NotificationsController@sendSms')->name('notification.send.sms');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){

Route::get('register','RegisterController@showRegisterationForm')->name('auth.register.form');

    Route::post('register', 'RegisterController@register')->name('auth.register');

    Route::get('login', 'LoginController@showLoginForm')->name('auth.login.form');

    Route::post('login', 'LoginController@login')->name('auth.login');

    Route::get('logout','LoginController@logout')->name('auth.logout');

    Route::get('email/send-verification', 'VerificationController@send')->name('auth.email.send.verification');

    Route::get('email/verify','VerificationController@verify')->name('auth.email.verify');

    Route::get('password/forget','ForgotPasswordController@showForgetForm')->name('auth.password.forget.form');

    Route::post('password/forget', 'ForgotPasswordController@sendResetPasswordLink')-> name('auth.password.forget');

    Route::get('password/reset','ResetPasswordController@showResetForm')->name('auth.password.reset.form');

    Route::post('password/reset', 'ResetPasswordController@reset')->name('auth.password.reset');
   

    Route::get('magic/login','MagicController@showMagicForm')->name('auth.magic.login.form');

    Route::post('magic/login', 'MagicController@sendToken')->name('auth.magic.send.token');

    Route::get('magic/login/{token}','MagicController@login')->name('auth.magic.login');
 
    Route::get('two-factor/toggle','TwofactorController@showToggleForm')->name('auth.two.factor.toggle.form');


    Route::get('two-factor/activate','TwofactorController@activate')->name('auth.two.factor.activate');


    Route::get('two-factor/code','TwoFactorController@ShowEnterCodeForm')->name('auth.two.factor.code.form');



    


}); 
Route::get('products','ProductController@index')->name('products.index');

Route::get('basket/add/{product}','BasketController@add')->name('basket.add');

Route::get('basket/clear',function(){

resolve(StorageInterface::class)->clear();

});
Route::get('basket','BasketController@index')->name('basket.index');


Route::post('basket/update/{product}','BasketController@update')->name('basket.update');

Route::get('basket/checkout','BasketController@checkoutForm')->name('basket.checkout.form');

Route::post('basket/checkout/post','BasketController@checkout')->name('basket.checkout');

Route::post('payment/{gateway}/callback','PaymentController@verify')->name('payment.verify');



Route::get('verify',function(Request $request){

Url::hasValidSignature($request);
})->name('test');


