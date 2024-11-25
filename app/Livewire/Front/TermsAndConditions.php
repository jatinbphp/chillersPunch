<?php

namespace App\Livewire\Front;

use Livewire\Component;

class TermsAndConditions extends Component
{
    public function render(){
        return view('livewire.front.terms-and-conditions')->extends('layouts.front', ['menu' => 'Terms and Conditions'])->section('content');
    }
}
