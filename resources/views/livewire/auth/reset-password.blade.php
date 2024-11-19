<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h5 class="login-box-msg p-0 text-bold">Reset Your Password</h5>
    <p class="login-box-msg pl-0 pr-0">You are only one step a way from your new password, recover your password now.</p>

    <form method="post" wire:submit.prevent="resetPassword">
    <div class="input-group mb-3">
        <input type="email" wire:model="email" class="form-control" autofocus placeholder="Email" readOnly>
        
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

        <div class="input-group mb-3">
            <input type="password" wire:model="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" wire:model="password_confirmation" class="form-control" placeholder="Confirm Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </form>
    <hr>
    <p class="mt-3 mb-1">If you already have an account with us, please login at the <a href="{{route('login')}}" class="text-bold" wire:navigate>login here</a>.</p>
</div>