<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Dashboard;
use App\Livewire\EditProfile;
use App\Livewire\Logout;
use App\Livewire\Competitions\CompetitionList;
use App\Livewire\Competitions\CompetitionCreate;
use App\Livewire\Competitions\CompetitionEdit;
use App\Livewire\Competitions\CompetitionShow;
use App\Livewire\CMSPages;
use App\Livewire\PageNotFound;
use App\Livewire\Front\Home;
use App\Livewire\Front\ListenAndVote;
use App\Livewire\Front\TermsAndConditions;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\Controller;

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

// Route::get('/', function () {
//     return redirect()->route('home');
// });

Route::middleware('guest')->group(function () {
    
    Route::get('/', Home::class)->name('home');
    Route::get('listen-and-vote', ListenAndVote::class)->name('listen-and-vote');
    Route::get('terms-and-conditions', TermsAndConditions::class)->name('terms-and-conditions');
    Route::get('submission-video/{id}', [ListenAndVote::class, 'getSubmissioInfo'])->name('submission.video');
    Route::post('submission-add-vote', [ListenAndVote::class, 'addSubmissioVote'])->name('submission.add.vote');

    Route::get('admin/login', Login::class)->name('login');
    Route::get('admin/forgot-password', ForgotPassword::class)->name('forgot-password');
    Route::get('admin/reset-password/{token}', ResetPassword::class)->name('password.reset');
 
});

Route::middleware(['auth'])->group(function () {
    Route::get('admin/profile/edit', EditProfile::class)->name('profile.edit');
    Route::middleware('role:super_admin')->group(function () {
        Route::get('admin/dashboard', Dashboard::class)->name('dashboard');
    });

    Route::get('admin/logout', Logout::class)->name('logout');

    Route::prefix('admin/competitions')->name('competitions.')->group(function () {
        Route::get('/', CompetitionList::class)->name('list'); 
        Route::get('/create', CompetitionCreate::class)->name('create');
        Route::get('/{id}/edit', CompetitionEdit::class)->name('edit');
        Route::get('/{id}/view', CompetitionShow::class)->name('show');
        Route::delete('/{id}/delete', [CompetitionList::class, 'deleteRecord'])->name('destroy');
        Route::get('/competitions-data', [CompetitionList::class, 'getCompetitionsData'])->name('data');
        Route::get('/submission-data/{id}', [CompetitionShow::class, 'getSubmissionData'])->name('submissions');
        Route::get('/submission-info/{id}', [CompetitionShow::class, 'getSubmissioInfo'])->name('submission.info');
        Route::post('/submission/winner/update', [CompetitionShow::class, 'winnerUpdate'])->name('submission.winner.update');
        Route::post('/submission/status/update', [CompetitionShow::class, 'statusUpdate'])->name('submission.status.update');
        Route::get('/voting-data/{id}', [CompetitionShow::class, 'getVotingData'])->name('votings');
        Route::get('/submission-voting-data', [CompetitionShow::class, 'getSubmissionVotingData'])->name('submission.votings');
    });
    
    Route::post('admin/status_update', [Controller::class, 'statusUpdate'])->name('common.statusUpdate');
    Route::get('admin/cms-page/{slug}',CMSPages::class)->name('cms.index');
    Route::get('/{id}/edit', CompetitionEdit::class)->name('edit');
    Route::get('admin/404', PageNotFound::class)->name('errors.404');
});

Route::get('404', PageNotFound::class)->name('errors.404');

Route::fallback(function () {
    if (request()->is('admin/*')) {
        if (auth()->check()) {
            return response()->view('livewire.page-not-found', ['menu' => '404'], 404);
        } else {
            return redirect()->route('login');
        }
    } else {
        return response()->view('livewire.front.not-found');
    }
});
