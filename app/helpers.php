<?php

use Carbon\Carbon;
use App\Models\QuestionAnswer;
use App\Models\InstitutionsCompletedSection;

if (!function_exists('formatCreatedAt')) {
    function formatCreatedAt($createdAt)
    {
        return Carbon::parse($createdAt)->format('Y-m-d H:i:s');
    }
}

if (!function_exists('getHomeUrl')) {
    function getHomeUrl()
    {
        return route('home');
    }
}

if (!function_exists('getRoleWiseHomeUrl')) {
    function getRoleWiseHomeUrl()
    {
        if(!Auth::user()){
            return '';
        }
        return route('dashboard');
    }
}
