<div class="card-body">
    <h5 class="login-box-msg p-0 text-bold">Forgot Your Password?</h5>
    <p class="login-box-msg pl-0 pr-0">Here you can easily retrieve a new password.</p>
    <form wire:submit.prevent="sendResetLink">
        <div class="input-group mb-3">
            <input type="email" id="email" wire:model="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email') <span class="text-danger w-100">{{ $message }}</span> @enderror
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
            </div>
        </div>
    </form>
    <hr>
    <p class="mt-3 mb-1">If you already have an account with us, please login at the <a href="{{route('login')}}" class="text-bold" wire:navigate>login here</a>.</p>
</div>