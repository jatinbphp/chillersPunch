<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\Competition;
use FFMpeg;

class Home extends Component
{
    use WithFileUploads;

    public $submissionTitle, $fullName, $emailAddress, $phoneNumber, $videoFile;

    protected $rules = [
        'submissionTitle' => 'required|string|max:255',
        'fullName' => 'required|string|max:255',
        'emailAddress' => 'required|email|unique:submissions,emailAddress',
        'phoneNumber' => 'required|regex:/^\+?[0-9]{10,15}$/',
        'videoFile' => 'required|file|mimes:mp4,avi,mov',
    ];

    public function submitForm(){
        $competition = Competition::where('status', 'active')->first();

        if (!$competition) {
            $this->dispatch('notExitsCompetitionalert');
            return;
        }

        $existingSubmission = Submission::where('emailAddress', $this->emailAddress)->where('competitionId', $competition->id)->first();

        if ($existingSubmission) {
            $this->dispatch('exitsErroralert');
            return;
        }

        $validatedData = $this->validate();

        $videoFile = null;
        $thumbnail = null;

        if ($this->videoFile) {
            // Store video file
            $videoFile = $this->videoFile->store('uploads/submissions', 'public');

            // Create thumbnail
            $videoPath = public_path($videoFile);
            $thumbnailPath = public_path('uploads/submissions/thumbnails/'). pathinfo($this->videoFile->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';

            // Using FFmpeg to create the thumbnail
            $ffmpeg = FFMpeg\FFMpeg::create();
            $video = $ffmpeg->open($videoPath);
            $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1)) // Capture thumbnail at 1 second
                ->save($thumbnailPath);  // Save directly to the specified path

            $thumbnail = 'uploads/submissions/thumbnails/'.pathinfo($this->videoFile->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg'; // Path to the generated thumbnail
        }

        $institution = Submission::create([
            'competitionId' => $competition->id,
            'submissionTitle' => $this->submissionTitle,
            'fullName' => $this->fullName,
            'emailAddress' => $this->emailAddress,
            'phoneNumber' => $this->phoneNumber,
            'videoFile' => $videoFile,
            'thumbnail' => $thumbnail,
        ]);

        session()->flash('message', 'Your submission has been successfully submitted!');

        $this->reset(['submissionTitle', 'fullName', 'emailAddress', 'phoneNumber', 'videoFile']);
        $this->dispatch('showsuccessalert');
        return;
    }

    public function render(){
        return view('livewire.front.home')->extends('layouts.front', ['menu' => 'Home'])->section('content');
    }
}