<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Submission;
use App\Models\Voting;
use App\Models\Competition;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $menu, $totalSubmission, $totalVoting, $totalCompetitions;

    public function mount(){
        $this->menu = "Dashboard";
        $this->totalSubmission = Submission::count();
        $this->totalVoting = Voting::count();
        $this->totalCompetitions = Competition::count();
    }

    public function render(){
        return view('livewire.dashboard')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
