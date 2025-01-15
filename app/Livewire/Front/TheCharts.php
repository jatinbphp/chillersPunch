<?php

namespace App\Livewire\Front;

use Livewire\Component;

class TheCharts extends Component
{   
    public function render()
    {
        return view('livewire.front.the-charts')->extends('layouts.front', ['menu' => 'The Charts'])->section('content');
    }
}
