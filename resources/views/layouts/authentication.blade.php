<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('assets/dist/img/favicon.jpg') }}" type="image/x-icon" />
        <title>{{ $menu }} | {{ config('app.name', 'Laravel') }}</title>
        @livewireStyles

        @vite([ 'resources/css/app.css' ])
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ URL('assets/dist/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ URL('assets/dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL('assets/dist/css/adminlte.min.css') }}">
    </head>
    
    <body class="hold-transition login-page" id="app" style="background-image: url('{{ asset('assets/dist/img/login-img.png') }}'); background-repeat: no-repeat; background-size: cover;background-position: bottom center;">

        <div class="login-box">

            <div class="login-logo">
                <a href="{{ URL::to('/admin') }}">
                    <img src="{{url('assets/dist/img/logo.png')}}?{{ time() }}"/>
                </a>
            </div>
            
            <div class="card card-outline card-primary">
                @yield('content')   
            </div>
        </div>

        @livewireScripts

        @vite([ 'resources/js/app.js' ])
        <script src="{{ URL::asset('assets/dist/plugins/jquery/jquery.min.js') }}" data-navigate-once></script>
        <script src="{{ URL::asset('assets/dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" data-navigate-once></script>
        <script src="{{ URL::asset('assets/dist/js/adminlte.min.js')}}" data-navigate-once></script>
    </body>
</html>