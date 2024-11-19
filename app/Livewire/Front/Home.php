<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Home extends Component
{
    public function render(){
        return view('livewire.front.home')->extends('layouts.front', ['menu' => 'Home'])->section('content');
    }
}
