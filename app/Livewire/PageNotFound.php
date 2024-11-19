<?php

namespace App\Livewire;

use Livewire\Component;

class PageNotFound extends Component
{
    public $menu;

    public function mount()
    {
        $this->menu = '404';
    }

    public function render()
    {
        return view('livewire.page-not-found')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
