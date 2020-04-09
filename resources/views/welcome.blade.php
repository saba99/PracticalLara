@extends('layouts.app')


@section('title',__('public.main page'))

@section('content')
   
        <div class="flex-center position-ref full-height">
            {{--  @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif  --}}
                      <div class="content">

                        <div class="title m-b-md">
                          
                            @lang('public.register & login system')
                        </div>


                        <div class="library-title">

                            @lang('public.practical laravel')
                        </div>
                      </div>
          
        </div>
@endsection
