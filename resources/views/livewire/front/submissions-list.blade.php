<div class="song-list-left">
    <div class="song-list-scroll">
        <ul>
            @if (!empty($submissionsList))
                @foreach ($submissionsList as $value)
                    <li>
                        <div class="left">
                            <div class="icon">
                                <button id="play-pause-btn-{{ $value->id }}" class="play-button play-pause-btn"
                                    data-audio="{{ asset($value->videoFile) }}" data-id="{{ $value->id }}">
                                    <i class="fa-regular fa-circle-play"></i>
                                </button>
                                <button id="fast-forward-btn-{{ $value->id }}" class="fast-forward-btn">
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
                                        <div class="progress-bar" id="progress-bar-{{ $value->id }}"
                                            style="width:0%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="song-btn">
                                <button class="vote-button" data-vote-id="{{ $value->id }}"><img
                                        src="{{ url('assets/dist/front/img/like-icon.png') }}"
                                        alt="" /></button>

                                <button class="audio-download-btn"
                                    wire:click="openShareModal('{{ $value->submissionTitle }}', '{{ basename($value->videoFile) }}')">
                                    <img src="{{ url('assets/dist/front/img/upload-file-icon.png') }}"
                                        alt="Download" />
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <li class="song-name">
                    <div class="song-name">
                        <h6>No submissions found.</h6>
                    </div>
                </li>
            @endif
        </ul>
    </div>

    @if ($isLoading)
        <div class="fullscreen-loader">
            <div class="loader">Loading...</div>
        </div>
    @endif

    <!-- Modal for sharing -->
    @if ($isModalOpen)
        <div class="modal show shareModalPopup" style="display: block;" tabindex="-1" role="dialog"
            aria-labelledby="shareModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                            wire:click="closeModal">&times;</button>
                        <h3 class="modal-title">Share item</h3>
                    </div>
                    <div class="modal-body">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($modalAudioFileName . ' - ' . $shareableLink) }}"
                            target="_blank" class="btn btn-whatsapp">
                            <img src="{{ url('assets/dist/front/img/whatsapp-icon.svg') }}" alt="" />
                            <span>Share on WhatsApp</span>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareableLink) }}&quote={{ urlencode($modalAudioFileName) }}"
                            target="_blank" class="btn btn-facebook">
                            <img src="{{ url('assets/dist/front/img/facebook-icon.svg') }}" alt="" />
                            <span>Share on Facebook</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript">
    const audioElements = {}; // Store all audio elements
    let isDragging = false; // Declare isDragging variable at the top

    // Listen for Livewire updates and initialize audio controls
    document.addEventListener('livewire:load', function () {
        initializeAudioControls();
    });

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

    // Reinitialize audio controls after Livewire navigation
    document.addEventListener("livewire:navigated", () => {
        setTimeout(() => {
            initializeAudioControls();
        }, 600);
    });

    function initializeAudioControls() {
        document.querySelectorAll(".play-pause-btn").forEach((button) => {
            const key = button.id.split("-").pop();
            const audioUrl = button.getAttribute("data-audio");
            
            // Create audio object for each button
            const audio = new Audio(audioUrl);
            audioElements[key] = audio;

            const progressBar = document.getElementById(`progress-bar-${key}`);
            const progressBox = progressBar?.parentElement?.parentElement; // Safe navigation operator
            const fastForwardBtn = document.getElementById(`fast-forward-btn-${key}`);
            const playPauseBtn = document.getElementById(`play-pause-btn-${key}`);

            if (playPauseBtn) {
                playPauseBtn.addEventListener("click", () => {
                    if (audio.paused) {
                        playAudio(key, audio, playPauseBtn);
                    } else {
                        pauseAudio(key, audio, playPauseBtn);
                    }
                });
            }

            if (fastForwardBtn) {
                fastForwardBtn.addEventListener("click", () => {
                    Object.keys(audioElements).forEach((k) => {
                        audioElements[k].pause();
                        const button = document.getElementById(`play-pause-btn-${k}`);
                        if (button) {
                            button.innerHTML = "<i class='fa-regular fa-circle-play'></i>";
                        }
                    });

                    audio.pause();
                    playPauseBtn.innerHTML = "<i class='fa-regular fa-circle-play'></i>";

                    const currentLi = playPauseBtn.closest("li");
                    const nextLi = currentLi?.nextElementSibling;

                    if (nextLi) {
                        const nextPlayPauseBtn = nextLi.querySelector(".play-pause-btn");
                        const nextKey = nextPlayPauseBtn?.id.split("-").pop();
                        const nextAudio = audioElements[nextKey];

                        if (nextAudio) {
                            nextAudio.play();
                            nextPlayPauseBtn.innerHTML = "<i class='fa-regular fa-circle-pause'></i>";
                        }
                    }
                });
            }

            audio.addEventListener("timeupdate", () => {
                const progress = (audio.currentTime / audio.duration) * 100;
                if (progressBar) {
                    progressBar.style.width = `${progress}%`;
                }
            });

            progressBox?.addEventListener("mousedown", (e) => {
                isDragging = true;
                updateProgressBar(e);
            });

            progressBox?.addEventListener("mousemove", (e) => {
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

                if (progressBar) {
                    progressBar.style.width = `${percentage}%`;
                    audio.currentTime = (percentage / 100) * audio.duration;
                }
            }

            audio.addEventListener("ended", () => {
                if (progressBar) {
                    progressBar.style.width = "0%";
                }
                if (playPauseBtn) {
                    playPauseBtn.innerHTML = "<i class='fa-regular fa-circle-play'></i>";
                }
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
                document.getElementById(`play-pause-btn-${k}`).innerHTML =
                    "<i class='fa-regular fa-circle-play'></i>";
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
