<?php 


namespace App\Support\Payment\Gateways;

use App\Order;
use Illuminate\Http\Request;


class Pasargad implements GatewayInterface{


    public function pay(Order $Order)
    { 
        dd('pasargad pay');
    }
    public function verify(Request $request)
    {
    }

    public function getName(): string
    {

        return 'pasargad';
    }









}