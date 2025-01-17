<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Submission;

class SubmissionsList extends Component
{
    public $submissionsList = [];
    public $totalVisible = 10;

    public function mount(){
        $this->fetchSubmissions();
    }

    public function fetchSubmissions(){
        $this->submissionsList = Submission::orderBy('id', 'desc')->take($this->totalVisible)->get();
    }

    public function loadMore(){
        $this->totalVisible += 10;
        $this->fetchSubmissions();
    }

    public function render(){
        return view('livewire.front.submissions-list');
    }
}