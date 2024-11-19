<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPassword extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink(){
        $this->validate();

        $response = Password::sendResetLink(['email' => $this->email]);

        if ($response === Password::RESET_LINK_SENT) {
            session()->flash('status', 'Password reset link sent to your email.');
            return redirect()->route('login');
        }

        throw ValidationException::withMessages([
            'email' => [trans($response)],
        ]);
    }

    public function render(){
        return view('livewire.auth.forgot-password')->extends('layouts.authentication', ['menu' => 'Forgot Password'])->section('content');
    }
}
