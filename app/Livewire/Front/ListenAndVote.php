<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Submission;
use App\Models\Competition;
use App\Models\Voting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ListenAndVote extends Component
{
    public $submissionsList, $topSubmissions;

    public function mount(){
        $competition = Competition::where('status', 'active')->first();

        if(!empty($competition)){
            $this->submissionsList = Submission::where('competitionId', $competition->id)->limit(5)->get();   

            $this->topSubmissions = DB::table('submissions')
                ->join('votings', 'submissions.id', '=', 'votings.submissionId')
                ->select('submissions.*', DB::raw('COUNT(votings.submissionId) as vote_count'))
                ->where('submissions.competitionId', $competition->id)
                ->groupBy('submissions.id', 'submissions.submissionTitle', 'submissions.fullName')
                ->orderByDesc('vote_count')
                ->limit(5)
                ->get(); 
        }
    }

    public function getSubmissioInfo($submissionId){
        $data['submissioInfo'] = Submission::where('id', $submissionId)->first();
        return view('livewire.front.submission-video', $data);
    }

    public function addSubmissioVote(Request $request){

        $ipAddress = request()->ip();
        $currentDate = Carbon::now()->toDateString(); // Get the current date in 'Y-m-d' format

        $checkVoting = Voting::where('submissionId', $request['id'])
            ->where('ipAdress', $ipAddress)
            ->whereDate('created_at', $currentDate) // Assuming the date is stored in 'created_at'
            ->first();

        if(empty($checkVoting)){

            $submissioInfo = Submission::where('id', $request['id'])->first();

            Voting::create([
                'competitionId' => $submissioInfo->competitionId,
                'submissionId' => $request['id'],
                'ipAdress' => $ipAddress,
            ]);

            return response()->json(['success' => 'Your vote has been successfully submitted!']);
        } else {
            return response()->json(['error' => 'You have already voted.']);
        }
    }

    public function render(){
        return view('livewire.front.listen-and-vote')->extends('layouts.front', ['menu' => 'Listen & Vote'])->section('content');
    }
}
