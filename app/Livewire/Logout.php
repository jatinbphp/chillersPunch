<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\InstitutionsWorkingSection;

class Logout extends Component
{
    public function mount(){
        $user = Auth::user();
        if ($user) {
            $user->save();

            if($user->role!='super_admin'){
                InstitutionsWorkingSection::where('user_id', Auth::user()->id)->delete();
            }
        }
        
        Auth::logout();
        session()->flush();
        $this->redirect(route('login'), navigate: true);
    }
}
