<?php

namespace App\Http\Controllers;

use App\Support\Payment\Transaction;
use Illuminate\Http\Request;


class PaymentController extends Controller
{  

    private $transaction;

    public function __construct(Transaction $transaction)
    {
       $this->transaction=$transaction;
        
    }
    public function verify(Request $request){

        //dd('test');

       // dd($request->all());

      return  $this->transaction->Verify()

       ? $this->sendSuccessResponse()
       : $this->sendSuccessResponse();
    }

    private function sendErrorResponse(){

    return redirect()->route('products.index')->with('error-transaction','مشکلی در هنگام  سفارش رخ داده است ');

    }

    private function sendSuccessResponse(){

        return redirect()->route('products.index')->with('success-transaction','تراکنش موفقیت آمیز بود ');
    }
}
