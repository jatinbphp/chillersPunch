<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Competition;
use App\Models\Submission;
use App\Models\Voting;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $menu, $totalSubmission, $totalVoting, $totalCompetitions;

    public function mount(){
        $this->menu = "Dashboard";

        $competition = Competition::where('status', 'active')->first();

        if ($competition) {
            $this->totalSubmission = Submission::where('competitionId', $competition->id)->count();
            $this->totalVoting = Voting::where('competitionId', $competition->id)->count();
        } else {
            $this->totalSubmission = 0;
            $this->totalVoting = 0;
        }
        $this->totalCompetitions = Competition::count();
    }

    public function render(){
        return view('livewire.dashboard')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
