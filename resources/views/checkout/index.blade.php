@extends('layouts.app') 


@section('content') 

<form action="{{route('basket.checkout')}}"  method="POST" >
        @csrf
<div class="container" style="direction:rtl;">
<div class="row">
<div class="col-8 text-right">
      
<div class="card">
   
    <div class="card-header">
        اطلاعات کاربر
    </div>
    <div class="card-body">
        
        <h5 class="card-title">آدرس: {{Auth::user()->address}}</h5>
        <hr>
       <h5 class="card-title">گیرنده: {{Auth::user()->name}}</h5>
       <hr>
        <h5 class="card-title">شماره تلفن: {{Auth::user()->phone_number}}</h5>
    </div>
  
</div>
</div>
<div class="col-8 mt-3 text-right">
    <div class="card">
        <div class="card-header">
           روش پرداخت
        </div>
        <div class="card-body">
           <input type="radio"  name="method" value="online" ><span class="pl-2">پرداخت آنلاین</span>
           <select name="gateway" >
               <option  value="saman">سامان</option>
                <option  value="pasargad">پاسارگاد</option>
        </select> 
            <hr>
           <input type="radio" name="method"  value="cash" ><span>پرداخت نقدی</span> 
           <hr>
           <input type="radio"  name="method" value="cart-to-cart" ><span>کارت به کارت</span>
           
        </div>
       
    </div>
</div>

<div class="col-4 col-md-4">
@inject('basket','App\Support\Basket\Basket')
<div class="card text-right">

    <div class="card-header">
        پرداخت
    </div>
    <div class="card-body">
       
        <p class="card-text"> {{number_format($basket->subTotal())}}مبلغ کل</p>
        <hr>
        <p class="card-text">{{number_format(10000)}}هزینه حمل </p>
        <hr>
        <p class="card-text">{{number_format($basket->subTotal() + 10000)}}مبلغ قابل پرداخت</p>
    </div>
<button type="submit" class="btn btn-block btn-primary">ثبت و ادامه سفارش</button>
</div>
</div>
</div>
</div>

</form>



@endsection 