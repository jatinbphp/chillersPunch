<?php

namespace App\Livewire\Front;

use Livewire\Component;

class TheFinalists extends Component
{
    public function render()
    {
        return view('livewire.front.the-finalists')->extends('layouts.front', ['menu' => 'The Charts'])->section('content');
    }
}
