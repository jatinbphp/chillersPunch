<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="icon" href="{{ asset('assets/dist/img/favicon.jpg') }}" type="image/x-icon" />
    <title>{{ $menu }} | {{ config('app.name', 'Laravel') }}</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" href="{{ URL('assets/dist/front/css/style.css?v=1') }}">
    <link rel="stylesheet" href="{{ URL('assets/dist/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL('assets/dist/front/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ URL('assets/dist/front/css/aos.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $menu }}" />
    <meta property="og:description" content="Check out this amazing audio file!" />
    <meta property="og:image" content="{{ asset('assets/dist/img/favicon.jpg') }}" />
    @livewireStyles
    @vite([ 'resources/css/app.css' ])
</head>
<body class="front-home" id="app">
    <header class="front-header">
        <div class="logo">
            <a href="{{ route('home') }}" wire:navigate>
                <img data-aos="zoom-in" class="chillers-punch1" src="{{url('assets/dist/front/img/chillers-punch1.png')}}" alt="" />
            </a>
        </div>
        <div class="search-menu">
            <div class="menu-search" style="display: none;">
                <input type="text" id="toggleInput" style="display: none;" placeholder="Search here..." />
                <button id="toggleButton">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                  </svg>
                </button>
            </div>
            <div class="menu-toggle">
                <div class="the-charts">
                    <!-- @if(getTotalSubmission()>0)
                        <a href="{{ route('listen-and-vote') }}" wire:navigate>THE CHARTS</a>
                    @else -->
                        <a href="{{ route('home') }}" wire:navigate>THE CHARTS</a>
                    <!-- @endif -->
                </div>
                <a href="javascript:void(0)" class="toggle">
                    <img src="{{url('assets/dist/front/img/menu-icon.png')}}" alt="" />
                </a>
                <ul class="menu-list">
                    <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>

                    @if(getTotalCompetition()>0)
                    <li><a href="{{ route('submit-now') }}" wire:navigate>Submit Now</a></li>
                    @endif

                    <!-- @if(getTotalSubmission()>0)
                    <li><a href="{{ route('listen-and-vote') }}" wire:navigate>Listen & Vote</a></li>
                    @endif

                    @if(getTotalSubmissionWinners()>0)
                    <li><a href="{{ route('thefinalists') }}" wire:navigate>The Finalists</a></li>
                    @endif -->
                </ul>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="front-footer footer-bg-color">
        <div class="footer-img">
            <a href="{{ route('home') }}" wire:navigate><img src="{{url('assets/dist/front/img/footer-img.png') }}" alt="" /></a>
        </div>
        <ul class="footer-link">
            <li><a href="{{ route('terms-and-conditions') }}" wire:navigate>Terms & Conditions</a></li>
            <li><a href="{{ route('home') }}" wire:navigate>© 2024 Chillers Punch</a></li>
        </ul>
        <ul class="social-media">
            <li><a href="https://www.facebook.com/profile.php?id=61567600423182" target="_blank"><img src="{{url('assets/dist/front/img/facebook-icon.png') }}" alt="" /></a></li>
            <li><a href="https://www.instagram.com/chillerspunch/" target="_blank"><img src="{{url('assets/dist/front/img/instagram-icon.png') }}" alt="" /></a></li>
            <li><a href="https://www.youtube.com/@podcastandchillnetwork" target="_blank"><img src="{{url('assets/dist/front/img/youtube-icon.png') }}" alt="" /></a></li>
            <li><a href="https://x.com/ChillersPunch" target="_blank"><img src="{{url('assets/dist/front/img/x-icon.png') }}" alt="" /></a></li>
        </ul>
    </footer>
    @livewireScripts
    <script src="{{ URL('assets/dist/front/js/jquery.min.js') }}"></script>
    <script src="{{ URL('assets/dist/front/js/bootstrap.min.js') }}" data-navigate-once></script>
    <script src="{{ URL('assets/dist/front/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL('assets/dist/front/js/aos.js') }}"></script>
    <script src="{{ URL('assets/dist/front/js/custom.js') }}"></script>
    @vite([ 'resources/js/app.js' ])
</body>
</html>