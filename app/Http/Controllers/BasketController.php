<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Product;
use App\Support\Basket\Basket;
use App\Support\Payment\Transaction;
use Illuminate\Http\Request;


class BasketController extends Controller
{
    private $basket;

    private $transaction;

    public function __construct(Basket $basket,Transaction $transaction)
    {   

        $this->middleware('auth')->only(['checkoutForm','checkout']);
        $this->basket=$basket;

        $this->transaction=$transaction;
    }

    public function add(Product $product){
       

       try {
            // dd($product);
            $this->basket->add($product, 1);
            //dump(session()->all());

            return back()->with('success', __('payment.added to basket'));
       } catch (QuantityExceededException $e) {
           

        return back()->with('error',__('payment.quantity payment exceeded'));
       }
    } 

    public function index(){
      
         $items=$this->basket->all();
        //dd($this->basket->all());
        return view('basket.index',compact(['items']));
    }


    public function update(Request $request,Product $product){
   

        //dd($product);
       //dd($request->quantity)
       ($this->basket->update($product,$request->quantity));

       return back();
    } 

    public function checkoutForm(){

         return view('checkout.index');
    }  

    public function checkout(Request $request){

   //dd($request->all());

   $this->validateForm($request);

   $order=$this->transaction->checkout();

   //dd($order);

   return redirect()->route('products.index')->with('order-success',__('payment.your order has been registered',['orderNum'=>$order->id]));

    }

    private function validateForm($request){

    $request->validate([

      'method'=>['required'],
      'gateway'=>['required_if:method,online']
    ]);

    }
}
