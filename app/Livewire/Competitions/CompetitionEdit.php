<?php

namespace App\Livewire\Competitions;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Competition;
use App\Models\Common;

class CompetitionEdit extends Component
{
    use WithFileUploads;

    public $menu, $id, $competition, $title, $description, $image, $status, $statusList, $currentImage;

    public function mount($id){
        $this->menu = "Competitions";
        $competition = Competition::findOrFail($id);
        $this->id = $competition->id;
        $this->title = $competition->title;
        $this->status = $competition->status;
        $this->statusList = Common::$status;
        $this->description = $competition->description;
        $this->currentImage = $competition->image; 
    }

    public function update(){

        $this->validate([
            'title' => 'required|max:255',
            'description' => 'required', 
            'image' => 'nullable|image|max:1024',           
            'status' => 'required',
        ]);

        $competition = Competition::findOrFail($this->id);

        if($this->status == 'active'){
            Competition::where('status','active')->update(['status'=>'inactive']);
        }

        if ($this->image) {
            if ($competition->image && file_exists(public_path($competition->image))) {
                unlink(public_path($competition->image));
            }
            $imagePath = $this->image->store('uploads/competitions','public');
        } else {
            $imagePath = $competition->image;
        }

        $competition->update([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Competition updated successfully.');
        $this->redirect(route('competitions.list'), navigate: true);
    }

    public function render(){
        return view('livewire.competitions.competition-edit')->extends('layouts.app', ['menu' => $this->menu])->section('content');
    }
}
