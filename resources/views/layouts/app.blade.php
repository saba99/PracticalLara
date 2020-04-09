<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('links')
</head>
<body>
    <div id="app">
        @include('partials.navbar')

        @if(session('mustVerifyEmail')) 
        <div class="alert alert-danger">
            {{session('mustVerifyEmail')}}
      @lang('auth.you must verify your email',['link'=>route('auth.email.send-verification')])
      </div>
        @endif
     

      @if(session('verification.email.sent'))

       <div class="alert alert-success">

        @lang('auth.verification.email.sent')
      </div> 
      @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
