@extends('layouts.app')



@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center" >
        <div class="col-md-8">
             @include('partials.alert')
            <div class="card">
                <div class="card-header">{{ __('auth.MagicLogin') }}</div>

                <div class="card-body">

                    @if(session('magicLinkSend'))
                         <div class="alert alert-success">

                            @lang('auth.magicLinkSend')
                         </div>

                    @endif
                    

                       <form method="POST" action="{{route('auth.magic.send.token')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                     
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}"> --}}
                                        <a class="btn btn-link" href="{{ route('auth.password.forget.form') }}">
                                        {{ __('auth.Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 offset-sm-3">
                        @include('partials.validation-errors')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
