<div class="song-list-left">
    <div class="song-list-scroll">
        <ul>
            @if(!empty($submissionsList))
                @foreach ($submissionsList as $value)
                    <li>
                        <div class="left">
                            <div class="icon">
                                <button id="play-pause-btn-{{$value->id}}" class="play-button play-pause-btn" data-audio="{{asset($value->videoFile)}}"  data-id="{{$value->id}}">
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
                                <button class="vote-button" data-vote-id="{{ $value->id }}"><img src="{{url('assets/dist/front/img/like-icon.png') }}" alt="" /></button>
                                <button class="audio-download-btn" onclick="downloadAudio('{{ asset($value->videoFile) }}', '{{ basename($value->videoFile) }}')">
                                    <img src="{{ url('assets/dist/front/img/upload-file-icon.png') }}" alt="Download" />
                                </button>
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
const audioElements = {}; // Store all audio elements

document.addEventListener("DOMContentLoaded", () => {
    // Initialize audio controls after DOM content is loaded
    initializeAudioControls();

    // Re-initialize audio controls after Livewire updates the DOM
    Livewire.on('audioControlsInitialized', () => {
        setTimeout(() => {
            initializeAudioControls();
        }, 600);
    });
});

// Reinitialize audio controls after Livewire updates
document.addEventListener("livewire:navigated", () => {
    Livewire.on('audioControlsInitialized', () => {
        setTimeout(() => {
            initializeAudioControls();
        }, 600);
    });
});

function initializeAudioControls() {
    document.querySelectorAll(".play-pause-btn").forEach((button) => {
        const key = button.id.split("-").pop();
        const audioUrl = button.getAttribute("data-audio");

        // Create audio object for each button
        const audio = new Audio(audioUrl);
        audioElements[key] = audio;

        // Get progress bar and buttons
        const progressBar = document.getElementById(`progress-bar-${key}`);
        const progressBox = progressBar.parentElement.parentElement;
        const fastForwardBtn = document.getElementById(`fast-forward-btn-${key}`);
        const playPauseBtn = document.getElementById(`play-pause-btn-${key}`);

        // Play/Pause button event
        playPauseBtn.addEventListener("click", () => {
            if (audio.paused) {
                // Play the current audio and pause all other audios
                playAudio(key, audio, playPauseBtn);
            } else {
                // Pause the current audio
                pauseAudio(key, audio, playPauseBtn);
            }
        });

        // Fast forward button event (Play Next)
        if (fastForwardBtn) {
            fastForwardBtn.addEventListener("click", () => {
                // Pause all audio elements and reset their play button icons
                Object.keys(audioElements).forEach((k) => {
                    audioElements[k].pause();
                    document.getElementById(`play-pause-btn-${k}`).innerHTML = "<i class='fa-regular fa-circle-play'></i>";
                });

                // Pause the current audio and reset its play button icon
                audio.pause();
                playPauseBtn.innerHTML = "<i class='fa-regular fa-circle-play'></i>";

                // Find the current `<li>` and the next `<li>`
                const currentLi = playPauseBtn.closest("li");
                const nextLi = currentLi.nextElementSibling;

                // If there's a next `<li>`, play its audio
                if (nextLi) {
                    const nextPlayPauseBtn = nextLi.querySelector(".play-pause-btn");
                    const nextKey = nextPlayPauseBtn.id.split("-").pop();
                    const nextAudio = audioElements[nextKey];

                    if (nextAudio) {
                        nextAudio.play();
                        nextPlayPauseBtn.innerHTML = "<i class='fa-regular fa-circle-pause'></i>";
                    }
                }
            });
        }

        // Update progress bar as audio plays
        audio.addEventListener("timeupdate", () => {
            const progress = (audio.currentTime / audio.duration) * 100;
            progressBar.style.width = `${progress}%`;
        });

        // Dragging functionality for progress bar
        let isDragging = false;

        progressBox.addEventListener("mousedown", (e) => {
            isDragging = true;
            updateProgressBar(e);
        });

        progressBox.addEventListener("mousemove", (e) => {
            if (isDragging) {
                updateProgressBar(e);
            }
        });

        document.addEventListener("mouseup", () => {
            if (isDragging) {
                isDragging = false;
            }
        });

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
}

// Separate function to play the audio
function playAudio(key, audio, playPauseBtn) {
    // Pause all other audios
    Object.keys(audioElements).forEach((k) => {
        if (k !== key && !audioElements[k].paused) {
            // Pause all other audios and reset their play button icon
            audioElements[k].pause();
            document.getElementById(`play-pause-btn-${k}`).innerHTML = "<i class='fa-regular fa-circle-play'></i>";
        }
    });

    // Play the current audio
    audio.play().then(() => {
        playPauseBtn.innerHTML = "<i class='fa-regular fa-circle-pause'></i>";
    }).catch((error) => {
        console.error("Error playing audio:", error);
    });
}

// Separate function to pause the audio
function pauseAudio(key, audio, playPauseBtn) {
    // Pause the current audio
    audio.pause();
    playPauseBtn.innerHTML = "<i class='fa-regular fa-circle-play'></i>";
}

function downloadAudio(fileUrl, fileName) {
    const link = document.createElement('a');
    link.href = fileUrl;
    link.download = fileName;
    link.click();
}
</script>
