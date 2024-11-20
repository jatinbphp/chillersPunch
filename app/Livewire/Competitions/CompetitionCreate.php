<?php

namespace App\Livewire\Competitions;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Competition;
use App\Models\Common;

class CompetitionCreate extends Component
{
    use WithFileUploads;

    public $menu, $title, $description, $image, $status, $statusList, $currentImage="";

    public function mount(){
        $this->menu = "Competitions";
        $this->statusList = Common::$status;
    }

    public function store(){

        $this->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:1024',
            'status' => 'required',
        ]);

        if ($this->image) {
            $imagePath= $this->image->store('uploads/competitions','public');
        } else {
            $imagePath = null;
        }

        if($this->status == 'active'){
            Competition::where('status','active')->update(['status'=>'inactive']);
        }

        $institution = Competition::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Competition created successfully.');
        
        $this->redirect(route('competitions.list'), navigate: true);
    }

    public function render(){
        return view('livewire.competitions.competition-create')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
