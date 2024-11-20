<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('assets/dist/img/favicon.jpg') }}" type="image/x-icon" />
        <title>{{ $menu }} | {{ config('app.name', 'Laravel') }}</title>
        @livewireStyles
        @vite([ 'resources/css/app.css' ])
    </head>
    
    <body class="hold-transition login-page" id="app" style="background-image: url('{{ asset('assets/dist/img/login-img.png') }}'); background-repeat: no-repeat; background-size: cover;background-position: bottom center;">

        @yield('content')

        @livewireScripts
        @vite([ 'resources/js/app.js' ])
    </body>
</html>