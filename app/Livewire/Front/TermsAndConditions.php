<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\CommonPages;

class TermsAndConditions extends Component
{
    public $termsAndConditions;

    public function mount(){
        $this->termsAndConditions = CommonPages::where('slug','terms-conditions')->firstOrFail();
    }

    public function render(){
        return view('livewire.front.terms-and-conditions')->extends('layouts.front', ['menu' => 'Terms and Conditions'])->section('content');
    }
}
