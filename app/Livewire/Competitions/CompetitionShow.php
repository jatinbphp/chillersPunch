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

    public function getSubmissionData(){
        return DataTables::of(Submission::select())
            ->editColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->make(true);
    }

    public function getVotingData(){
        return DataTables::of(Voting::with('submission'))
            ->addColumn('submission_info', function ($row) {
                $submission = $row->submission;

                $fullName = $submission->fullName ?? '-';
                $emailAddress = '<b>Email: </b>'.$submission->emailAddress ?? '-';
                $phoneNumber = '<b>Phone: </b>'.$submission->phoneNumber ?? '-';

                return "{$fullName}<br><small>{$emailAddress}</small><br><small>{$phoneNumber}</small>";
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->rawColumns(['submission_info'])
            ->make(true);
    }

    public function render(){
        return view('livewire.competitions.competition-show')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
