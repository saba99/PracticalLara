@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">داشبورد</div> 
                <div class="alrt alert-danger">

                    <a href="{{route('auth.email.send.verification')}}"> ارسال ایمیل تاییدیه</a>
                </div>

               @include('partials.alert')

           @if(session('mustVerifyEmail')) 
        <div class="alert alert-danger">
            {{session('mustVerifyEmail')}}
        @lang('auth.you must verify your email')
        </div> 
        @endif  

        
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    شما با موفقیت وارد شدید 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
