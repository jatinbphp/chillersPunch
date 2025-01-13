<div class="song-list-left">
    <div class="song-list-scroll">
    <ul>
        @if(!empty($submissionsList))
            @foreach ($submissionsList as $value)
                <li>
                    <div class="left">
                        <div class="icon">
                            <button class="play-button" title="View Video" data-id="{{ $value->id }}" data-url="{{ route('submission.video', ['id' => $value->id]) }}">
                                <img src="{{url('assets/dist/front/img/play-button-white.svg') }}" alt="" />
                            </button>
                            <button class="play-button">
                                <img src="{{url('assets/dist/front/img/play-button-white.svg') }}" alt="" />
                            </button>
                        </div>
                        <div class="song-name">
                            <h6>{{ $value->submissionTitle }}</h6>
                            <p>{{ $value->fullName }}</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="song-progress">
                            <div id="progress_bar_box">
                                <div id="progress_bar"></div>
                                <div id="progress"></div>
                            </div>
                        </div>
                        <div class="song-btn">
                            <button><img src="{{url('assets/dist/front/img/like-icon.png') }}" alt="" /></button>
                            <button><img src="{{url('assets/dist/front/img/upload-free-icon.png') }}" alt="" /></button>
                        </div>
                    </div>
                </li>
            @endforeach
        @else
            <li class="song-name">
                <div class="song-name"><h6>No submissions found.</h6></div>
            </li>
        @endif
    </ul>
</div>
    @if(!empty($submissionsList))
        <input type="hidden" id="submission-add-vote" value="{{ route('submission.add.vote') }}">
        
        @if(count($submissionsList) >= $totalVisible)
            <button class="submissions-btn" wire:click="loadMore">
                VIEW ALL SUBMISSIONS
            </button>
        @endif
    @endif
</div>
