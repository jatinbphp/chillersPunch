<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Common;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;


class EditProfile extends Component
{   
    use WithFileUploads;

    public $menu, $fullname, $email, $password, $password_confirmation, $status, $image, $currentImage='';

    public function mount(){
        $this->menu = "Edit Profile";
        $user = Auth::user();
        $this->fullname = $user->fullname;
        $this->email = $user->email;
        $this->currentImage = $user->image; 
    }

    public function updateProfile(){

        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $this->validate($rules);
        $user = Auth::user();
        if ($this->image) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            $imagePath = $this->image->store('uploads/users','public');
        } else {
            $imagePath = $user->image;
        }

        $data = [
            'fullname' => $this->fullname,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
            'image' => $imagePath,
        ];

        // Perform the update
        $user->update($data);

        session()->flash('success', 'Profile updated successfully.');
        $this->redirect(route('profile.edit'), navigate: true);
    }

    public function render(){
        return view('livewire.edit-profile')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}