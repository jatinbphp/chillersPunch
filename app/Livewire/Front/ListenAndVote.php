<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Submission;
use App\Models\Competition;
use App\Models\Voting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use FFMpeg;

class ListenAndVote extends Component
{
    use WithFileUploads;

    public $topSubmissions, $submissionTitle, $fullName, $emailAddress, $phoneNumber, $videoFile, $activeCompetition, $thumbnail, $agreeTerms;

    protected $rules = [
        'submissionTitle' => 'required|string|max:255',
        'fullName' => 'required|string|max:255',
        'emailAddress' => 'required|email|unique:submissions,emailAddress',
        'phoneNumber' => 'required|regex:/^\+?[0-9]{10,15}$/',
        'videoFile' => 'required|file|mimes:mp3,wav,aac,flac',
        'thumbnail' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        'agreeTerms' => 'required',
    ];

    protected $messages = [
        'submissionTitle.required' => 'The song title field is required.',
        'videoFile.required' => 'Please upload a valid audio file.',
        'videoFile.mimes' => 'The audio file must be one of the following types: MP3, WAV, AAC, or FLAC.',
        'agreeTerms.required' => 'Please accept the Terms & Conditions.',
    ];

    public function mount(){
        $competition = Competition::where('status', 'active')->first();

        if(!empty($competition)){
            /*$this->topSubmissions = DB::table('submissions')
                ->join('votings', 'submissions.id', '=', 'votings.submissionId')
                ->select('submissions.*', DB::raw('COUNT(votings.submissionId) as vote_count'))
                ->where('submissions.competitionId', $competition->id)
                ->groupBy('submissions.id', 'submissions.submissionTitle', 'submissions.fullName')
                ->orderByDesc('vote_count')
                ->limit(5)
                ->get(); */

            $this->topSubmissions = DB::table('submissions')
                ->join('votings', 'submissions.id', '=', 'votings.submissionId')
                ->select('submissions.id', 'submissions.submissionTitle', 'submissions.fullName', 'submissions.videoFile', DB::raw('COUNT(votings.submissionId) as vote_count'))
                ->where('submissions.competitionId', $competition->id)
                ->groupBy('submissions.id', 'submissions.submissionTitle', 'submissions.fullName', 'submissions.videoFile')
                ->orderByDesc('vote_count')
                ->limit(5)
                ->get();

        }
    }

    public function getSubmissioInfo($submissionId){
        $data['submissioInfo'] = Submission::where('id', $submissionId)->first();
        return view('livewire.front.submission-video', $data);
    }

    public function addSubmissioVote(Request $request){

        $ipAddress = request()->ip();
        $currentDate = Carbon::now()->toDateString(); // Get the current date in 'Y-m-d' format

        $checkVoting = Voting::where('submissionId', $request['id'])
            ->where('ipAdress', $ipAddress)
            ->whereDate('created_at', $currentDate) // Assuming the date is stored in 'created_at'
            ->first();

        if(empty($checkVoting)){

            $submissioInfo = Submission::where('id', $request['id'])->first();

            Voting::create([
                'competitionId' => $submissioInfo->competitionId,
                'submissionId' => $request['id'],
                'ipAdress' => $ipAddress,
            ]);

            return response()->json(['success' => 'Your vote has been successfully submitted!']);
        } else {
            return response()->json(['error' => 'You have already voted.']);
        }
    }

    public function render(){
        return view('livewire.front.listen-and-vote')->extends('layouts.front', ['menu' => 'Listen & Vote'])->section('content');
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

        session()->flash('message', "Thank you for your submission! We've received your entry, and once approved, it will be displayed on our website. Stay tuned!");

        $this->reset(['submissionTitle', 'fullName', 'emailAddress', 'phoneNumber', 'videoFile']);
        $this->dispatch('showsuccessalert');
        return;
    }
}
