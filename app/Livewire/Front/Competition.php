<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Competition extends Component
{
    public function render(){
        return view('livewire.front.competition')->extends('layouts.front', ['menu' => 'Competition'])->section('content');
    }
}
