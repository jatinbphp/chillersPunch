<?php

use Carbon\Carbon;
use App\Models\Submission;
use App\Models\Competition;

if (!function_exists('formatCreatedAt')) {
    function formatCreatedAt($createdAt){
        return Carbon::parse($createdAt)->format('Y-m-d H:i:s');
    }
}

if (!function_exists('getTotalSubmission')) {
    function getTotalSubmission(){
        $competition = Competition::select('id')->where('status','active')->first();

        if(!empty($competition)){
            return Submission::where('competitionId', $competition->id)->count();    
        }
        
        return 0;
    }
}

if (!function_exists('getTotalSubmissionWinners')) {
    function getTotalSubmissionWinners(){
        $competition = Competition::select('id')->where('status','active')->first();

        if(!empty($competition)){
            return Submission::where('competitionId', $competition->id)->where('isWinner', 1)->count();
        }
        
        return 0;
    }
}