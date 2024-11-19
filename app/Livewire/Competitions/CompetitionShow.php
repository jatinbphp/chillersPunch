<?php

namespace App\Livewire\Competitions;

use Livewire\Component;
use App\Models\Competition;
use App\Models\Submission;
use App\Models\Voting;
use App\Models\Common;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class CompetitionShow extends Component
{
    public $menu, $competition,$competitionId, $totalSubmission, $totalVoting;

    public function mount($id){
        $this->menu = "Competitions";
        $this->competition = Competition::findOrFail($id);
        $this->competitionId = $this->competition->id;
        $this->totalSubmission = Submission::count();
        $this->totalVoting = Voting::count();
    }

    public function getSubmissionData(Request $request, $competitionId){
        $submission = Submission::where('competitionId', $competitionId);
        $submissions = $submission->paginate(12);
        return response()->json([
            'total' => $submissions->total(),
            'data' => $submissions->items(),
        ]);
    }

    public function render(){
        return view('livewire.competitions.competition-show')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
