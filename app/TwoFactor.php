<?php

namespace App;

use App\Jobs\SendSms;
use Illuminate\Database\Eloquent\Model;

use App\User;

class TwoFactor extends Model
{
    protected $fillable=['user_id','code'];



    public static function generateCodeForm(User $user){
    
       $user->code()->delete();

        return static::create([


            'user_id'=>$user->id,
            'code'=>mt_rand(1000,9999),

        ]);

    } 

    public function getCodeForSendAttribute(){

return  __('auth.codeForSend',['code'=>$this->code]);

    }

    public function send(){

       SendSms::dispatchNow($this->user,$this->code_for_send); 
    }

    public function user(){


        return $this->belongsTo(User::class);


    }
}
