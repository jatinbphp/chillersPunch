<div class="auth-forms" id="auth-forms">
    <div class="form-container sign-in-container">
        <form wire:submit.prevent="login">
            <h1>Sign in</h1>
            <span>Sign in to start your session</span>
            <hr class="header-hr">

            <input type="text" id="email" wire:model="email" class="form-control" placeholder="User name">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

            <input type="password" id="password" wire:model="password" class="form-control" placeholder="Password">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

            <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>

            <a href="{{route('forgot-password')}}" style="display: none;" wire:navigate>I forgot my password</a>

            <hr class="footer-hr">

            <div class="copy-rights">&copy; {{ date('Y', strtotime('-1 year')) }} - {{ date('Y') }} <b>Chillers Punch</b></div>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right" data-aos="zoom-in">
                <img src="{{url('assets/dist/front/img/chillers-punch1.png')}}" alt="">
            </div>
        </div>
    </div>
</div>