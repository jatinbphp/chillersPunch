<div class="song-list-left">
    <div class="song-list-scroll">
    <ul>
        @if(!empty($submissionsList))
            @foreach ($submissionsList as $value)
                <li>
                    <div class="left">
                        <div class="icon">
                            <button id="play-pause-btn-{{$value->id}}" class="play-button play-pause-btn" data-audio="{{asset($value->videoFile)}}">
                                <img src="{{url('assets/dist/front/img/play-button-white.svg') }}" alt="" />
                            </button>
                            <button id="fast-forward-btn-{{$value->id}}" class="play-button fast-forward-btn">
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
                                <div id="progress_bar">
                                <input type="range" id="progress-bar-{{$value->id}}" class="progress-bar" value="0" max="100" />
                                </div>
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
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", () => {
    const audioElements = {};
    document.querySelectorAll(".play-pause-btn").forEach((button) => {
        const key = button.id.split("-").pop();
        const audioUrl = button.getAttribute("data-audio");

        const audio = new Audio(audioUrl);
        audioElements[key] = new Audio(audioUrl);

        audio.onloadedmetadata = function() {
            const totalMinutes = Math.floor(audio.duration / 60);
            const totalSeconds = Math.floor(audio.duration % 60).toString().padStart(2, "0");
            totalDurationElement.innerText = `${totalMinutes}:${totalSeconds}`;
        };

        const progressBar = document.getElementById(`progress-bar-${key}`);
        const fastForwardBtn = document.getElementById(`fast-forward-btn-${key}`);
        const playPauseBtn = document.getElementById(`play-pause-btn-${key}`);

        playPauseBtn.addEventListener("click", () => {
            // Pause all other audios
            Object.keys(audioElements).forEach((k) => {
                if (k !== key && !audioElements[k].paused) {
                    audioElements[k].pause();
                    document.getElementById(`play-pause-btn-${k}`).innerText = "▶";
                }
            });

            if (audio.paused) {
                audio.play();
                playPauseBtn.innerText = "⏸"; // Change button to pause icon
            } else {
                audio.pause();
                playPauseBtn.innerText = "▶"; // Change button to play icon
            }
        });

        fastForwardBtn.addEventListener("click", () => {
            audio.currentTime += 5; // Skip 5 seconds
        });

        audio.addEventListener("timeupdate", () => {
            const progress = (audio.currentTime / audio.duration) * 100;
            progressBar.value = progress;
        });

        progressBar.addEventListener("input", () => {
            const seekTime = (progressBar.value / 100) * audio.duration;
            audio.currentTime = seekTime;
        });

        audio.addEventListener("ended", () => {
            progressBar.value = 0; // Reset progress bar
            playPauseBtn.innerText = "▶"; // Reset play button
        });
    });
});
</script>