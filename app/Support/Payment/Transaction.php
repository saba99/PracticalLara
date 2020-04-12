<?php  

namespace App\Support\Payment;

use App\Events\OrderRegistered;
use Illuminate\Http\Request;

use App\Support\Basket\Basket;

use App\Order;

use App\Payment;
use App\Support\Payment\Gateways\GatewayInterface;
use App\Support\Payment\Gateways\Pasargad;
use App\Support\Payment\Gateways\Saman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Transaction{


private $request;

private $basket;

public function __construct(Request $request,Basket $basket)
{
    $this->request=$request;

     $this->basket=$basket;



    
}
public function checkout(){

//DB::beginTransaction();
//dd('checkout');

try {
         $order = $this->makeOrder();

         //dd($order);

         $payment = $this->makePayment($order);

        // DB::commit();

} catch (\Exception $th) {

  // DB::rollback();
   return null;
}
//dd($payment);
if($payment->isOnline()){

//dd('online');

event(new OrderRegistered($order));

return ($this->gatewayFactory()->pay($order));

$this->normalizeQuantity($order);

}

$this->basket->clear();

return $order;

}

private function gatewayFactory(){

$gateway=[

'saman'=>Saman::class,
'pasargad'=>Pasargad::class,
   
][
$this->request->gateway];

return resolve($gateway);


}

public function Verify(){


  $result=$this->gatewayFactory()->verify($this->request);
  
  if($result['status']==GatewayInterface::TRANSACTION_FAILED) return false;

  //dd($result);

  //($this->confirmPayment($result));
  $this->normalizeQuantity($result['order']);

  $this->basket->clear();


  return true;
} 

private function confirmPayment($result){

     ($result['order']->payment->confirm($result['refNum'],$result['gateway']));

}

private function makeOrder(){

$order=Order::create([

'user_id'=>Auth::user()->id,

'code'=>bin2hex(Str::random(10)),
'amount'=>$this->basket->subTotal()


]);

$order->products()->attach($this->products());

return $order;

}

public function makePayment($order){

    

    return Payment::create([
      'order_id'=>$order->id,
      'method'=>$this->request->method,
      'amount'=>$order->amount

    ]);
}


private function products(){


   foreach($this->basket->all() as $product){

$products[$product->id]=['quantity'=>$product->quantity];

   } 

   return ($products);
}

private function normalizeQuantity($order){

//dd($order->products);

foreach($order->products as $product){

//dump($product->pivot->quantity);

$product->decrementStock($product->pivot->quantity);
}

}



}