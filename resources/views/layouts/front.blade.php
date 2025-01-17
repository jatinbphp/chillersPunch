<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="icon" href="{{ asset('assets/dist/img/favicon.jpg') }}" type="image/x-icon" />
    <title>{{ $menu }} | {{ config('app.name', 'Laravel') }}</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" href="{{ URL('assets/dist/front/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL('assets/dist/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL('assets/dist/front/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ URL('assets/dist/front/css/aos.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                <div class="the-charts">THE CHARTS</div>
                <a href="#" class="toggle">
                    <img src="{{url('assets/dist/front/img/menu-icon.png')}}" alt="" />
                </a>
                <ul class="menu-list">
                    <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                    <li><a href="{{ route('listen-and-vote') }}" wire:navigate>Listen & Vote</a></li>
                    <li><a href="{{ route('thecharts') }}" wire:navigate>The Charts</a></li>
                    <li><a href="{{ route('thefinalists') }}" wire:navigate>The Finalists</a></li>
                </ul>
            </div>
        </div>
    </header>

    @yield('content')

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Join the Competition</h4>
                </div>

                <form wire:submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="submissionTitle" class="control-label">Song Title :<span class="text-red">*</span></label>
                                    <input type="text" id="submissionTitle" class="form-control" wire:model="submissionTitle" placeholder="Enter Song Title">
                                    @error('submissionTitle') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fullName" class="control-label"> Full Name :<span class="text-red">*</span></label>
                                    <input type="text" id="fullName" class="form-control" wire:model="fullName" placeholder="Enter Full Name">
                                    @error('fullName') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="emailAddress" class="control-label"> Email Address :<span class="text-red">*</span></label>
                                    <input type="text" class="form-control" wire:model="emailAddress" placeholder="Enter Email Address">
                                    @error('emailAddress') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phoneNumber" class="control-label"> Phone Number :<span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="phoneNumber" wire:model="phoneNumber" placeholder="Enter Phone Number">
                                    @error('phoneNumber') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="videoFile" class="control-label"> Upload Song File :<span class="text-red">*</span></label>
                                    <input type="file" class="form-control" id="videoFile" wire:model="videoFile" accept=".mp3, .wav, .ogg, .aac, .flac, .m4a">
                                    @error('videoFile') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thumbnail" class="control-label"> Upload Song Cover Image :</label>
                                    <input type="file" class="form-control" id="thumbnail" wire:model="thumbnail" accept=".jpg, .jpeg, .png, .gif, .bmp, .webp, .svg">
                                    @error('thumbnail') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="loading-spinner-main" wire:loading.flex wire:target="submitForm">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <footer class="front-footer footer-bg-color">
        <div class="footer-img">
            <a href="{{ route('home') }}" wire:navigate><img data-aos="zoom-in" src="{{url('assets/dist/front/img/footer-img.png') }}" alt="" /></a>
        </div>
        <ul class="footer-link">
            <li><a href="{{ route('terms-and-conditions') }}" wire:navigate>Terms & Conditions</a></li>
            <li><a href="{{ route('home') }}" wire:navigate>© 2024 Chillers Punch</a></li>
        </ul>
        <ul class="social-media">
            <li><a href="#" target="_blank"><img src="{{url('assets/dist/front/img/facebook-icon.png') }}" alt="" /></a></li>
            <li><a href="#" target="_blank"><img src="{{url('assets/dist/front/img/instagram-icon.png') }}" alt="" /></a></li>
            <li><a href="#" target="_blank"><img src="{{url('assets/dist/front/img/youtube-icon.png') }}" alt="" /></a></li>
            <li><a href="#" target="_blank"><img src="{{url('assets/dist/front/img/x-icon.png') }}" alt="" /></a></li>
            <li><a href="#" target="_blank"><img src="{{url('assets/dist/front/img/tiktok-icon.png') }}" alt="" /></a></li>
        </ul>
    </footer>
    @livewireScripts
    <script src="{{ URL('assets/dist/front/js/jquery.min.js') }}"></script>
    <script src="{{ URL('assets/dist/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL('assets/dist/front/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL('assets/dist/front/js/aos.js') }}"></script>
    <script src="{{ URL('assets/dist/front/js/custom.js') }}"></script>
    @vite([ 'resources/js/app.js' ])
</body>
</html>