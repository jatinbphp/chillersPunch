<div class="song-list-left">
    <ul>
        @if(!empty($submissionsList))
            @foreach ($submissionsList as $value)
                <li>
                    <button class="play-button" title="View Video" data-id="{{ $value->id }}" data-url="{{ route('submission.video', ['id' => $value->id]) }}">
                        <img src="{{url('assets/dist/front/img/play-button-white.svg') }}" alt="" />
                    </button>
                    <div class="song-name">
                        <h6>{{ $value->submissionTitle }}</h6>
                        <p>{{ $value->fullName }}</p>
                    </div>
                    <button class="vote-button" data-vote-id="{{ $value->id }}">VOTE</button>
                </li>
            @endforeach
        @else
            <li class="song-name">
                <div class="song-name"><h6>No submissions found.</h6></div>
            </li>
        @endif
    </ul>
    @if(!empty($submissionsList))
        <input type="hidden" id="submission-add-vote" value="{{ route('submission.add.vote') }}">
        
        @if(count($submissionsList) >= $totalVisible)
            <button class="submissions-btn" wire:click="loadMore">
                VIEW ALL SUBMISSIONS
            </button>
        @endif
    @endif
</div>
