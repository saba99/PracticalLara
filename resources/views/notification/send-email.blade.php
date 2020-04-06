@extends('layouts.layout')


@section('title','send Email')

@section('content')

@if(session('succcess'))
<div class="alert alert-success">
  

    {{session('success')}}
</div>
@endif
@if(session('failed'))
<div class="alert alert-danger">


    {{session('failed')}}
</div>
@endif
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
  <div class="card">
    <div class="card-header">
       {{-- {{__('notification.send_email')}} --}}

       {{-- @lang('notification.send_email') --}}
    ارسال ایمیل

    </div>
    <div class="card-body">
        <form action="{{route('notification.send.email')}}" method="POST">
            @csrf
        <div class="form-group">
            <select class="form-control" id="user" name="user">
                <lable for="user">users</lable>
                @foreach ($users as $user )
                    <option value="{{$user->id}}">{{$user->name}}</option> 

                   
                @endforeach
       <option value=""> @lang('notification.users') </option>
    
            </select>
        </div>
   
        <div class="form-group">
            <select class="form-control" id="email_type" name="email_type">
                <lable for="email_type">users</lable>
             @foreach ($emailTypes as $key=>$type )
                    <option value="{{$key}}">{{$type}}</option>  
   
                    
             @endforeach   
       <option value="">@lang('notification.email_type') </option>
   
            </select>
        </div> 
        {{--  --}}
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
           <div class="small mb-2">

            <li class="text-danger">
               {{$error}} 
            </li>
               </div>
               @endforeach 
        </ul>
        @endif 
<button type="submit" class="btn btn-info"> @lang('notification.send') </button>
    </div>
</form> 
</div>
</div>  
</div>


@endsection

