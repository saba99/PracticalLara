<?php

namespace App;

use App\Jobs\SendEmail;
use App\Mail\SendMagicLink;
use Illuminate\Database\Eloquent\Model;

class LoginToken extends Model
{  

    const TOKEN_EXPIRY=120;

    protected $fillable=['token'];

    public function getRouteKeyName()
    {
        return 'token';
    }




    public function user(){

        return $this->belongsTo(User::class);
    }

    public function send(array $option){

         SendEmail::dispatchNow($this->user,new SendMagicLink($this,$option));
    } 

    public function isExpired(){

        return $this->created_at->diffInSeconds(now()) >self::TOKEN_EXPIRY;

       
    }

    public function scopeExpired($query){

          return $query->where('created_at','<'.now()->subSeconds(Self::TOKEN_EXPIRY));
    }
}
