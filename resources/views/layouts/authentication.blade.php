<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('assets/dist/img/favicon.jpg') }}" type="image/x-icon" />
        <title>{{ $menu }} | {{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ URL('assets/dist/css/auth.css') }}">
        <link rel="stylesheet" href="{{ URL('assets/dist/front/css/aos.css') }}">
    </head>
    <body class="hold-transition login-page" id="app">
        <img class="body-img" src="{{url('assets/dist/front/img/products-img.png')}}" alt="" data-aos="zoom-in">
        <img class="body-img-footer" src="{{url('assets/dist/front/img/easy-steps.png')}}" data-aos="zoom-in">
        
        @yield('content')

        <script src="{{ URL('assets/dist/front/js/aos.js') }}"></script>
        <script type="text/javascript">
            AOS.init({
                duration: 1200,
            })
        </script>
    </body>
</html>