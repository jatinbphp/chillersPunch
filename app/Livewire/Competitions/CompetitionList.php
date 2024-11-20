<?php

namespace App\Livewire\Competitions;

use Livewire\Component;
use App\Models\Competition;
use Yajra\DataTables\DataTables;

class CompetitionList extends Component
{
    public $menu;

    public function mount(){
        $this->menu = "Competitions";
    }

    public function deleteRecord($competitionId){
        $competition = Competition::find($competitionId);
        if ($competition) {
            $competition->delete();
            return response()->json(['success' => 'Competition deleted successfully!']);
        } else {
            return response()->json(['error' => 'Competition not found.']);
        }
    }

    public function getCompetitionsData(){
        return DataTables::of(Competition::withCount('submissions')->withCount('votings'))
            ->editColumn('title', function ($row) {
                $title = $row->title ?? '-';
                $counters = '<b>Total Submissions: </b>'.$row->submissions_count.' | <b>Total Vots: </b>'.$row->votings_count.'</span>';

                return "{$title}<br><small>{$counters}</small>";
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->editColumn('status', function ($row) {
              $table_name = 'competitions';
              return view('common.status-buttons', ['status' => $row->status, 'id'=>$row->id, 'table_name'=>$table_name] );
            })
            ->addColumn('actions', function ($row) {
                return view('livewire.competitions.competition-actions', ['competitionId' => $row->id]);
            })
            ->rawColumns(['title', 'actions'])
            ->make(true);
    }

    public function render(){
        return view('livewire.competitions.competition-list')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
