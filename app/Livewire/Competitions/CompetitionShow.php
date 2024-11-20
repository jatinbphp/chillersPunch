<?php

namespace App\Livewire\Competitions;

use Livewire\Component;
use App\Models\Competition;
use App\Models\Submission;
use App\Models\Voting;
use App\Models\Common;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitionShow extends Component
{
    public $menu, $competition,$competitionId, $totalSubmission, $totalVoting, $totalWinners;

    public function mount($id){
        $this->menu = "Competitions";
        $this->competition = Competition::findOrFail($id);
        $this->competitionId = $this->competition->id;
        $this->totalSubmission = Submission::where('competitionId', $id)->count();
        $this->totalVoting = Voting::where('competitionId', $id)->count();
        $this->totalWinners = Submission::where('competitionId', $id)->where('isWinner', 1)->count();
    }

    public function getSubmissionData($competitionId){
        return DataTables::of(Submission::withCount('votings')->where('competitionId', $competitionId))
            ->addColumn('submission_info', function ($row) {
                $fullName = $row->fullName ?? '-';
                $emailAddress = '<b>Email: </b>'.$row->emailAddress ?? '-';
                $phoneNumber = '<b>Phone: </b>'.$row->phoneNumber ?? '-';
                $dateCreated = '<b>Date Created: </b>'.$row->created_at ?? '-';
                $totalVots = '<b>Total Vots: </b>'.$row->votings_count;

                return "{$fullName}<br><small>{$emailAddress}</small><br><small>{$phoneNumber}</small><br><small>{$dateCreated}</small></br><small>{$totalVots}</small>";
            })
            ->editColumn('status', function ($row) {
                return view('livewire.competitions.submission-status-buttons', $row);
            })
            ->editColumn('isWinner', function ($row) {
                $table_name = 'submissions';
                return view('common.winner-buttons', ['isWinner' => $row->isWinner, 'id'=>$row->id, 'table_name'=>$table_name] );
            })
            ->addColumn('actions', function ($row) {
                return view('livewire.competitions.submission-actions', ['submissionId' => $row->id]);
            })
            ->rawColumns(['actions', 'submission_info'])
            ->make(true);
    }

    public function getVotingData($competitionId){
        return DataTables::of(Voting::with('submission')->where('competitionId', $competitionId))
            ->editColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->addColumn('submission_info', function ($row) {
                $submission = $row->submission;

                $fullName = $submission->fullName ?? '-';
                $emailAddress = '<b>Email: </b>'.$submission->emailAddress ?? '-';
                $phoneNumber = '<b>Phone: </b>'.$submission->phoneNumber ?? '-';

                return "{$fullName}<br><small>{$emailAddress}</small><br><small>{$phoneNumber}</small>";
            })
            ->rawColumns(['submission_info'])
            ->make(true);
    }

    public function getSubmissioInfo($submissionId){
        $data['submissioInfo'] = Submission::where('id', $submissionId)->first();
        return view('livewire.competitions.submission-video', $data);
    }

    public function winnerUpdate(Request $request){
        $updateInput = DB::table($request['table_name'])->where('id', $request['id'])->first();
        $updateInput->isWinner = ($request['type'] == 'no') ? 0 : 1;
        DB::table($request['table_name'])->where('id', $request['id'])->update((array) $updateInput);
    }

    public function render(){
        return view('livewire.competitions.competition-show')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
