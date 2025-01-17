<div class="song-list-left">
    <div class="song-list-scroll">
    <ul>
        @if(!empty($submissionsList))
            @foreach ($submissionsList as $value)
                <li>
                    <div class="left">
                        <div class="icon">
                            <button id="play-pause-btn-{{$value->id}}" class="play-button play-pause-btn" data-audio="{{asset($value->videoFile)}}">
                                <i class="fa-regular fa-circle-play"></i>
                            </button>
                            <button id="fast-forward-btn-{{$value->id}}" class="fast-forward-btn">
                                <i class="fas fa-fast-forward"></i>
                            </button>
                        </div>
                        <div class="song-name">
                            <h6>{{ $value->submissionTitle }}</h6>
                            <p>{{ $value->fullName }}</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="song-progress">
                            <div class="progress_bar_box">
                              <div class="progress">
                                <div class="progress-bar" id="progress-bar-{{$value->id}}" style="width:0%"></div>
                              </div>
                            </div>
                        </div>
                        <div class="song-btn">
                            <button><img src="{{url('assets/dist/front/img/like-icon.png') }}" alt="" /></button>
                            <button><img src="{{url('assets/dist/front/img/upload-file-icon.png') }}" alt="" /></button>
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

        // Create audio object
        const audio = new Audio(audioUrl);
        audioElements[key] = audio;

        // Get progress bar and buttons
        const progressBar = document.getElementById(`progress-bar-${key}`);
        const progressBox = progressBar.parentElement.parentElement;
        const fastForwardBtn = document.getElementById(`fast-forward-btn-${key}`);
        const playPauseBtn = document.getElementById(`play-pause-btn-${key}`);

        // Play/Pause button event
        playPauseBtn.addEventListener("click", () => {
            // Pause all other audios
            Object.keys(audioElements).forEach((k) => {
                if (k !== key && !audioElements[k].paused) {
                    audioElements[k].pause();
                    document.getElementById(`play-pause-btn-${k}`).innerHTML = "<i class='fa-regular fa-circle-play'></i>";
                }
            });

            // Play or pause current audio
            if (audio.paused) {
                audio.play();
                playPauseBtn.innerHTML = "<i class='fa-regular fa-circle-pause'></i>";
            } else {
                audio.pause();
                playPauseBtn.innerHTML = "<i class='fa-regular fa-circle-play'></i>";
            }
        });

        // Fast forward button event
        fastForwardBtn.addEventListener("click", () => {
            audio.currentTime += 10; // Skip 10 seconds
        });

        // Update progress bar as audio plays
        audio.addEventListener("timeupdate", () => {
            const progress = (audio.currentTime / audio.duration) * 100;
            progressBar.style.width = `${progress}%`;
        });

        // Dragging functionality for progress bar
        let isDragging = false;

        // Mouse down event to start dragging
        progressBox.addEventListener("mousedown", (e) => {
            isDragging = true;
            updateProgressBar(e);
        });

        // Mouse move event to update progress during drag
        progressBox.addEventListener("mousemove", (e) => {
            if (isDragging) {
                updateProgressBar(e);
            }
        });

        // Mouse up event to stop dragging
        document.addEventListener("mouseup", () => {
            if (isDragging) {
                isDragging = false;
            }
        });

        // Function to update progress bar and audio time
        function updateProgressBar(e) {
            const rect = progressBox.getBoundingClientRect();
            const offsetX = e.clientX - rect.left;
            const width = rect.width;
            const percentage = Math.min(Math.max((offsetX / width) * 100, 0), 100);

            progressBar.style.width = `${percentage}%`;
            audio.currentTime = (percentage / 100) * audio.duration;
        }

        // Reset progress bar when audio ends
        audio.addEventListener("ended", () => {
            progressBar.style.width = "0%";
            playPauseBtn.innerHTML = "<i class='fa-regular fa-circle-play'></i>";
        });
    });
});

</script>

