<?php 

namespace App\Services\Auth\Traits;

use App\LoginToken;

use Illuminate\Support\Str;

trait MagicallyAuthenticable{

public function MagicToken(){

return $this->hasOne(LoginToken::class);

}


public function CreateToken(){

    $this->MagicToken()->delete();

    return $this->MagicToken()->create([

        'token'=>Str::random(50)
    ]);
} 


}
