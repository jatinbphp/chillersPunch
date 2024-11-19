<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Dashboard;
use App\Livewire\EditProfile;
use App\Livewire\Logout;
use App\Livewire\PageNotFound;
use App\Livewire\Front\Home;
use App\Livewire\Front\Competition;
use App\Http\Controllers\CacheController;

Route::get('/clear-cache', [CacheController::class, 'clearAllCache']);

if (App::environment('local')) {
    Livewire::setUpdateRoute(function($handle) {
        return Route::get('/chillersPunch/livewire/update', $handle);
    });
}

if (App::environment('production')) {
    Livewire::setUpdateRoute(function($handle) {
        return Route::get('/chillersPunch/livewire/update', $handle);
    });
}

Route::get('/', function () {
    return redirect()->route('home');
});

Route::middleware('guest')->group(function () {
    Route::get('admin/login', Login::class)->name('login');
    Route::get('admin/forgot-password', ForgotPassword::class)->name('forgot-password');
    Route::get('admin/reset-password/{token}', ResetPassword::class)->name('password.reset');

    Route::get('/', Home::class)->name('home');
    Route::get('competition', Competition::class)->name('competition');
});

Route::middleware(['auth'])->group(function () {
    Route::get('admin/profile/edit', EditProfile::class)->name('profile.edit');
    Route::middleware('role:super_admin')->group(function () {
        Route::get('admin/dashboard', Dashboard::class)->name('dashboard');
    });

    Route::get('admin/logout', Logout::class)->name('logout');
});

Route::get('admin/404', PageNotFound::class)->name('errors.404');

Route::fallback(function () {
    if (auth()->check()) {
        // If the user is authenticated, show the 404 page with a 404 status code
        return response()->view('livewire.page-not-found', ['menu' => '404'], 404);
    } else {
        // If the user is not authenticated, redirect them to the login page
        return redirect()->route('login');
    }
});