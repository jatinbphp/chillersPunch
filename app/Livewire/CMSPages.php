<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CommonPages;

class CMSPages extends Component
{
    public $menu, $slugName, $title, $description;

    public function mount($slug){
        $this->menu = "CMS Pages";
        $this->slugName = $slug;
        $cmsPage = CommonPages::where('slug',$slug)->firstOrFail();
        $this->title = $cmsPage->title;
        $this->description = $cmsPage->description;
    }

    public function update(){
        $this->validate([
            'title' => 'required|max:255',
            'description' => 'required', 
        ]);

        $slug = $this->slugName;
        $cmsPages = CommonPages::where('slug',$slug)->firstOrFail();
        $cmsPages->update([
            'title' => $this->title,
            'description' => $this->description
        ]);

        session()->flash('success', 'CMS Page has been updated successfully.');
        $this->redirect(route('cms.index',['slug'=>$slug]), navigate: true);
    }

    public function render(){
        return view('livewire.c-m-s-pages')->extends('layouts.app', ['menu' => $this->menu, 'slug' => $this->slugName])->section('content');
    }
}
