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
        return DataTables::of(Competition::select())
            ->editColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->editColumn('status', function ($row) {
                return view('common.status-buttons', $row);
            })
            ->addColumn('actions', function ($row) {
                return view('livewire.competitions.competition-actions', ['competitions' => $row]);
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function render()
    {
        return view('livewire.competitions.competition-list')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
