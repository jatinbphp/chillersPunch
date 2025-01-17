<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\Competition;
use FFMpeg;

class TheCharts extends Component
{   
    use WithFileUploads;

    public $submissionTitle, $fullName, $emailAddress, $phoneNumber, $videoFile, $activeCompetition, $thumbnail;

    protected $rules = [
        'submissionTitle' => 'required|string|max:255',
        'fullName' => 'required|string|max:255',
        'emailAddress' => 'required|email|unique:submissions,emailAddress',
        'phoneNumber' => 'required|regex:/^\+?[0-9]{10,15}$/',
        'videoFile' => 'required|file|mimes:mp3,wav,aac,flac',
        'thumbnail' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
    ];

    protected $messages = [
        'submissionTitle.required' => 'The song title field is required.',
        'videoFile.required' => 'Please upload a valid audio file.',
        'videoFile.mimes' => 'The audio file must be one of the following types: MP3, WAV, AAC, or FLAC.',
    ];

    public function render()
    {
        return view('livewire.front.the-charts')->extends('layouts.front', ['menu' => 'The Charts'])->section('content');
    }

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

             // Check if a thumbnail is uploaded
            if ($this->thumbnail) {
                
                $uploadedThumbnail = $this->thumbnail->store('uploads/submissions/thumbnails', 'public');
                $thumbnail = 'uploads/submissions/thumbnails/' . basename($uploadedThumbnail);

            } else {

                // Create thumbnail
                $videoPath = public_path($videoFile);

                $fileName = time();
                $thumbnailPath = public_path('uploads/submissions/thumbnails/').$fileName. '.jpg';

                // Ensure the thumbnails directory exists
                if (!file_exists(public_path('uploads/submissions/thumbnails/'))) {
                    mkdir(public_path('uploads/submissions/thumbnails/'), 0755, true);
                }

                // Generate a waveform image using FFmpeg
                $command = "ffmpeg -i " . escapeshellarg($videoPath) . " -filter_complex 'aformat=channel_layouts=mono,showwavespic=s=640x120' -frames:v 1 " . escapeshellarg($thumbnailPath);

                // Execute the command
                exec($command, $output, $returnCode);

                // Check if the waveform image was successfully generated
                if ($returnCode === 0 && file_exists($thumbnailPath)) {
                    $thumbnail = 'uploads/submissions/thumbnails/' . $fileName . '.png'; // Path to the generated waveform image
                } else {
                    // Handle errors
                    $thumbnail = null;
                    // Log::error('Failed to generate waveform: ' . implode("\n", $output));
                }
            }
            
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
}
