<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ResetPassword extends Component
{
    public $email;
    public $password;
    public $password_confirmation;
    public $token;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ];

    public function mount($token,$email=null){
        $this->token = $token;
        
        $resetRecords = DB::table('password_reset_tokens')->get();
        $resetRecord = $resetRecords->first(function($record) {
            return Hash::check($this->token, $record->token);
        });

        if ($resetRecord) {
            $this->email = $resetRecord->email;
        }
    }

    public function resetPassword(){
        $this->validate();
        $response = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user) {
                $user->password = Hash::make($this->password);
                $user->save();
            }
        );

        if ($response === Password::PASSWORD_RESET) {
            session()->flash('success', 'Password has been reset successfully.');
            $this->redirect(route('login'), navigate: true);
        }

        throw ValidationException::withMessages([
            'email' => [trans($response)],
        ]);
    }

    public function render(){
        return view('livewire.auth.reset-password')->extends('layouts.authentication', ['menu' => 'Reset Password'])->section('content');
    }
}
