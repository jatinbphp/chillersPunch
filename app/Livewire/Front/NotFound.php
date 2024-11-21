<?php

namespace App\Livewire\Front;

use Livewire\Component;

class NotFound extends Component
{
    public function render()
    {
        return view('livewire.front.not-found')->extends('layouts.front', ['menu' => 'Home'])->section('content');
    }
}
