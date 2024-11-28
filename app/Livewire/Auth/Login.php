<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class Login extends Component
{
    public $email;
    public $password;

    public function login(){
        $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Check if the user exists
        $user = User::where('email', $this->email)->first();

        // Check if the user exists
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Attempt to log in
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user->save();

        $this->redirect(getRoleWiseHomeUrl());
    }

    public function render(){
        return view('livewire.auth.login')->extends('layouts.authentication', ['menu' => 'Login'])->section('content');
    }
}

