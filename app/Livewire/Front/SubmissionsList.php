<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Submission;

class SubmissionsList extends Component
{
    public $submissionsList = [];
    public $totalVisible = 7;
    public $isChartsPage = false;
    public $isFinalistPage = false;

    public function mount($isChartsPage = false, $isFinalistPage = false){
        $this->isChartsPage = $isChartsPage;
        $this->isFinalistPage = $isFinalistPage;
        $this->fetchSubmissions();
    }

    public function fetchSubmissions(){
        if($this->isFinalistPage){
            $this->submissionsList = Submission::orderBy('id', 'desc')->where('isWinner',1)->take($this->totalVisible)->get();
        } else {
            $this->submissionsList = Submission::orderBy('id', 'desc')->take($this->totalVisible)->get();
        }
    }

    public function loadMore(){
        $this->totalVisible += 7;
        $this->fetchSubmissions();
    }

    public function render(){
        return view('livewire.front.submissions-list');
    }
}