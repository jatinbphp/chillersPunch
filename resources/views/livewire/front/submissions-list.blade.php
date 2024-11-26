<div class="song-list-left">
    <ul>
        @if(!empty($submissionsList))
            @foreach ($submissionsList as $value)
                <li>
                    <button class="play-button" title="View Video" data-id="{{ $value->id }}" data-url="{{ route('submission.video', ['id' => $value->id]) }}">
                        <svg height="52px" width="52px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 142.448 142.448" xml:space="preserve">
                            <g>
                                <path style="fill:#fff;" d="M142.411,68.9C141.216,31.48,110.968,1.233,73.549,0.038c-20.361-0.646-39.41,7.104-53.488,21.639
                                    C6.527,35.65-0.584,54.071,0.038,73.549c1.194,37.419,31.442,67.667,68.861,68.861c0.779,0.025,1.551,0.037,2.325,0.037
                                    c19.454,0,37.624-7.698,51.163-21.676C135.921,106.799,143.033,88.377,142.411,68.9z M111.613,110.336
                                    c-10.688,11.035-25.032,17.112-40.389,17.112c-0.614,0-1.228-0.01-1.847-0.029c-29.532-0.943-53.404-24.815-54.348-54.348
                                    c-0.491-15.382,5.122-29.928,15.806-40.958c10.688-11.035,25.032-17.112,40.389-17.112c0.614,0,1.228,0.01,1.847,0.029
                                    c29.532,0.943,53.404,24.815,54.348,54.348C127.91,84.76,122.296,99.306,111.613,110.336z"/>
                                <path style="fill:#fff;" d="M94.585,67.086L63.001,44.44c-3.369-2.416-8.059-0.008-8.059,4.138v45.293
                                    c0,4.146,4.69,6.554,8.059,4.138l31.583-22.647C97.418,73.331,97.418,69.118,94.585,67.086z"/>
                            </g>
                        </svg>
                    </button>
                    <div class="song-name">
                        <h6>{{ $value->submissionTitle }}</h6>
                        <p>{{ $value->fullName }}</p>
                    </div>
                    <button class="vote-button" data-vote-id="{{ $value->id }}">VOTE</button>
                </li>
            @endforeach
        @endif
    </ul>

    <input type="hidden" id="submission-add-vote" value="{{ route('submission.add.vote') }}">
    
    @if(count($submissionsList) >= $totalVisible)
        <button class="submissions-btn" wire:click="loadMore">
            VIEW ALL SUBMISSIONS
        </button>
    @endif
</div>
