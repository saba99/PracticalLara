@extends('layouts.app') 


@section('content')

<div class="container text-right" style="direction: rtl" >
     @if(session('success'))
       <div class="alert alert-success">

        @lang('payment.added to basket')
        
       </div>
      @endif
      @if(session('success-transaction'))
       <div class="alert alert-success">

       {{session('success-transaction')}}
        
       </div>
      @endif
       @if(session('error-transaction'))
       <div class="alert alert-danger">

       {{session('error-transaction')}}
        
       </div>
      @endif


       @if(session('order-success'))
       <div class="alert alert-success">

        @lang('payment.your order has been registered')
        
       </div>
      @endif
       @if(session('error'))
       <div class="alert alert-danger">

        @lang('payment.quantity payment exceeded')
        
       </div>
      @endif
      <div class="row mb-5">

     
 @foreach($products as $product)
 <div class="col-md-3 m-3">
  <div class="card" style="width:300px">
    <img class="card-img-top" src="{{$product->image}}" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">{{$product->title}}</h4>
      <p class="card-text">{{$product->description}} </p>
      <a href="{{route('basket.add',$product->id)}}" class="btn btn-primary stretched-link">افزودن به سبد خرید</a>
    </div></div>
  </div>@endforeach</div>
  
</div>




@endsection 