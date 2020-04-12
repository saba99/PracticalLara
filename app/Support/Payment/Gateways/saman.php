<?php  


namespace App\Support\Payment\Gateways;

use App\Order;
use Illuminate\Http\Request;


class  Saman implements GatewayInterface{


private $merchantID;

private  $callback;



public function __construct()
{
    $this->merchantID='4225855658';

    $this->callback=route('payment.verify',$this->getName()); 

}
public function pay(Order $order){

    //dd('saman pay');

   ($this->redirectToBank($order)) ;



}
public function verify(Request $request){

// if(!$request->has('state') || $request->input('state') != 'Ok'){


// //return self::TRANSACTION_FAILED;
// return $this->transactionFailed();

// }
$soapClient= new \SoapClient('https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL');

$response=$soapClient->verifyTransaction($request->input('RefNum'),$this->merchantID);


//dd($response);

$order=$this->getOrder($request->input('ResNum'));

//dd($order);

$response=$order->amount +10000;

$request->merge(['RefNum'=='4585234']);

return $response==($order->amount+10000)

?$this->transactionSuccess($order,$request->input('RefNum'))

:$this->transactionFailed();
}

private function transactionSuccess($order,$refNum){

return[

'status'=>self::TRANSACTION_SUCCESS,
'order'=>$order, 
'refNum'=>$refNum,

'gateway'=>$this->getName()
];

}
private function transactionFailed(){


    return[

        'status'=>self::TRANSACTION_FAILED,
    ];
} 

private function getOrder($resNum){


return Order::where('code',$resNum)->firstOrFail();
}

private function redirectToBank($order){

    ($amount=$order->amount +10000);

echo "<form id='samanPayment' action='https://sep.shaparak.ir/payment.aspx' method='post'>

<input type='hidden' name='Amount' value='{$amount}'/>>

<input type='hidden' name='ResNum' value='{$order->code}'/>

<input type='hidden'  name='RedirectUrl' value='{$this->callback}'>

<input type='hidden'  name='MID' value='{$this->merchantID}'/>
</form><script>document.forms['samanPayment'].submit()</script>";


}

public function getName():string{

    return 'saman';
}


}