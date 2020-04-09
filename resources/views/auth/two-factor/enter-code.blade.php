@extends('layouts.app')


@section('content')

<div class="container" style="direction:rtl;">
    <div class="row justify-content-center" >
  
  <div class="card">
    <div class="card-header" >
       @lang('auth.twofactor')
    </div>
    <div class="card-body">
     
        <p class="card-text">@lang('auth.enter code')</p>

        <input type="text" class="form-control" placeholder="کد را وارد نمایید ">

        <a href=""  class="btn btn-primary">تایید کد</a>
    </div>
   
</div>  </div>
</div>






@endsection