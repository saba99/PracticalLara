@extends('layouts.app')

@if(session('cant sent code'))
<div class="alert alert-danger">
    @lang('auth.cant sent code')
{{-- {{session('cant sent code')}} --}}
</div>
@endif
@section('content')

<div class="container" style="direction:rtl;">
    <div class="row justify-content-center" >
  
  <div class="card">
    <div class="card-header" >
       @lang('auth.twofactor')
    </div>
    <div class="card-body">
     
        <p class="card-text">@lang('auth.content',['number'=>Auth::user()->phone_number])</p>

        <a href="{{route('auth.two.factor.activate')}}"  class="btn btn-primary">فعال سازی</a>
    </div>
   
</div>  </div>
</div>






@endsection