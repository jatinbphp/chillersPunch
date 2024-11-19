<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Submission;
use App\Models\Voting;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $menu, $totalSubmission, $totalVoting;

    public function mount(){
        $this->menu = "Dashboard";
        $this->totalSubmission = Submission::count();
        $this->totalVoting = Voting::count();
    }

    public function render(){
        return view('livewire.dashboard')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
