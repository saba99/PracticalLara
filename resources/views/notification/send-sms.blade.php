@extends('layouts.layout')


@section('title','send Sms')

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

      @lang('notification.send_sms')
    

    </div>
    <div class="card-body">
        <form action="{{route('notification.send.sms')}}" method="POST">
            @csrf
        <div class="form-group">
            <select class="form-control" id="user" name="user">
                <lable for="user">@lang('notification.users') </lable>
                @foreach ($users as $user )
                    <option {{ old('user') ==$user->id  ? 'selected' :''  }} value="{{$user->id}}">{{$user->name}}</option> 

                   
                @endforeach
     
    
            </select>
        </div>
   
        <div class="form-group">
            
                <lable for="text">@lang('notification.sms_text')</lable>
     <textarea name="text" id="text" cols="30" rows="10" class="form-control">
         
    {{old('textarea')}}
    
    </textarea>  
       
   
           
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

