<?php

namespace App\Livewire\Competitions;

use Livewire\Component;
use App\Models\Competition;
use App\Models\Common;
use Yajra\DataTables\DataTables;

class CompetitionShow extends Component
{
    public $menu, $competition,$competitionId;

    public function mount($id){
        $this->menu = "Competitions";
        $this->competition = Competition::findOrFail($id);
        $this->competitionId = $this->competition->id;
    }

    public function getSubmissionData(){
        $institutionId = request()->institution_id;

        if(!empty($institutionId)){
            $user = User::where('institution_id', $institutionId)->select();

            return DataTables::of($user)
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d');
                })
                ->editColumn('status', function ($row) {
                    return view('common.status-buttons', $row);
                })
                ->make(true);
        }
    }

    public function render(){
        return view('livewire.competitions.competition-show')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
