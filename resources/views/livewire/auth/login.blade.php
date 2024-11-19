<div class="card-body">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @include ('common.error')

    <h5 class="login-box-msg p-0 text-bold">Login</h5>
    <p class="login-box-msg pl-0 pr-0">Sign in to start your session</p>

    <form wire:submit.prevent="login">
        <div class="input-group mb-3">
            <input type="text" id="email" wire:model="email" class="form-control" placeholder="User name">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('email') <span class="text-danger w-100">{{ $message }}</span> @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" id="password" wire:model="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password') <span class="text-danger w-100">{{ $message }}</span> @enderror
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
            </div>
        </div>
    </form>
    <hr>
    <p class="mb-1">
        <a href="{{route('forgot-password')}}" class="text-bold" wire:navigate>I forgot my password</a>
    </p>
</div>
