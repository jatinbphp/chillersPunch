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

if (!function_exists('getRoleWiseHomeUrl')) {
    function getRoleWiseHomeUrl()
    {
        if(!Auth::user()){
            return '';
        }
        if (in_array(Auth::user()->role, ['user', 'submitter'])) {
            return route('questionnaire',['id' => 1]);
        }
        return route('dashboard');
    }
}

if (!function_exists('getRoleWiseHomeLabel')) {
    function getRoleWiseHomeLabel()
    {
        if(!Auth::user()){
            return '';
        }
        if (in_array(Auth::user()->role, ['user', 'submitter'])) {
            return "Questionnaire";
        }
        return 'Dashboard';
    }
}

if (!function_exists('getYears')) {
    function getYears()
    {
        return ['2019', '2020', '2021', '2022', '2023'];
    }
}

if (!function_exists('getSectionWiseFormData')) {
    function getSectionWiseFormData($sectionId, $institutionId = 0){
        if(!$institutionId){
            $institutionId = Auth::user()->institution_id;
        }
        $questionAnswers = QuestionAnswer::where('institution_id', $institutionId)->where('section_id', $sectionId)->orderBy('question_id', 'ASC')->get();
        $questionsData = ($questionAnswers ? $questionAnswers->toArray() : []);

        if(!$questionsData || !count($questionsData)){
            return [];
        }

        $questions = [];

        foreach ($questionsData as $data) {
            $questionId = $data['question_id'] ?? 0;
            if(!$questionId){
                continue;
            }
            $answer = (isset($data['answers']) && $data['answers']) ? json_decode($data['answers'], 1) : [];
            
            $questions[$questionId] = $answer;
        }
        return $questions;
    }
}

if (!function_exists('updateOrCreateInstitutionSection')) {
    function updateOrCreateInstitutionSection($sectionId, $submit_type)
    {
        $attributes = [
            'section_id' => $sectionId,
            'institution_id' => Auth::user()->institution_id,
        ];

        $values['status'] = 0;
        if (Auth::user()->role == 'submitter' && $submit_type == 1) {
            $values['status'] = 1;
        }

        return InstitutionsCompletedSection::updateOrCreate($attributes, $values);
    }
}


if (!function_exists('deleteInstitutionSection')) {
    function deleteInstitutionSection($sectionId)
    {
        return InstitutionsCompletedSection::where('section_id', $sectionId)
            ->where('institution_id', Auth::user()->institution_id)
            ->delete();
    }
}