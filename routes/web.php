<?php

use App\Mail\TopicCreated;
use App\Mail\UserRegistered;
use App\Services\Notification\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use App\User;


Route::get('/', function () {

    /*Mail::to('sabaparadisesisco@gmail.com')->send(new TopicCreated);

    Mail::to('sabaparadisesisco@gmail.com')->send(new UserRegistered);*/


    //$notifaction=new Notification();

   $notifaction=resolve(Notification::class);
    
    $notifaction->sendEmail(User::find(1),new TopicCreated);
   //$notifaction->sendTelegram(User::find(1),new TopicCreated);

    //$notifaction->sendSms(User::find(2), 'این یک پیام تست از طرف صبا به آقام قوقول جیگر می باشد ');

    return view('layouts.home');

});

Route::get('/notification/send-email','NotificationsController@email')->name('notification.form.email');

Route::post('/notification/send-email','NotificationsController@sendEmail')->name('notification.send.email');

Route::get('/notification/send-sms', 'NotificationsController@sms')->name('notification.form.sms');

Route::post('/notification/send-sms', 'NotificationsController@sendSms')->name('notification.send.sms');

