<div class="main-section">
    <section class="listen-vote-banner">
        <div class="listen-now-btn" data-aos="zoom-in">
            <a href="{{ route('listen-and-vote') }}" wire:navigate></a>
        </div>
        <div class="submit-entry-btn" data-aos="zoom-in">
            <button type="button" data-toggle="modal" data-target="#myModal"></button>
        </div>
        <img src="{{url('assets/dist/front/img/listen-vote-banner.png') }}" alt="" />
    </section>

    <section class="listen-vote-main">
        <x-front.social-media-links />
        <div class="listen-vote">
            <img class="circles-img" src="{{url('assets/dist/front/img/circles.png') }}" alt="" />
            <div class="heding" data-aos="fade-up">
                <h2>LISTEN & VOTE</h2>
                <p>Public voting is open, so browse through the dope entries from our talented Chillers fam. Support your fellow Chillers by listening, sharing, and getting ready to vote for your favourite. Let the best beat win!</p>
            </div>
            <div class="song-list">
                <livewire:front.submissions-list />
                
                <div class="corrent-top-song" data-aos="zoom-in">
                    <h2>CURRENT TOP 5</h2>
                    <ul>
                        @if(!empty($topSubmissions))
                            @foreach ($topSubmissions as $key => $value)
                                <li>
                                    <div class="song-img">
                                        @if (isset($value->thumbnail) && file_exists(public_path($value->thumbnail)))
                                            <img src="{{ asset($value->thumbnail) }}" style="width: 110px;">
                                        @else
                                            <img src="{{url('assets/dist/front/img/default-song-cover.png') }}" alt="" />
                                        @endif
                                    </div>
                                    <div class="song-name">
                                        <h6>{{$value->submissionTitle}}</h6>
                                        <p>{{$value->fullName}}</p>
                                        <div class="likes-text">300 Likes</div>
                                    </div>
                                    
                                    <div class="play-progress">
                                        <button class="play-button" title="View Video" data-id="{{$value->id}}" data-url="{{route('submission.video',['id' => $value->id])}}">
                                            <i class="fa-regular fa-circle-play"></i>
                                        </button>
                                        <div class="song-progress">
                                            <div class="progress_bar_box">
                                              <div class="progress">
                                                <div class="progress-bar" id="progress-bar-{{$value->id}}" style="width:0%"></div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>


                                </li>
                            @endforeach
                        @else
                            <li>
                                <div class="song-name"><h6>No submissions found.</h6></div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" wire:navigate.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Join the Competition</h4>
                </div>

                <form wire:submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="submissionTitle" class="control-label">Song Title :<span class="text-red">*</span></label>
                                    <input type="text" id="submissionTitle" class="form-control" wire:model="submissionTitle" placeholder="Enter Song Title">
                                    @error('submissionTitle') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fullName" class="control-label"> Full Name :<span class="text-red">*</span></label>
                                    <input type="text" id="fullName" class="form-control" wire:model="fullName" placeholder="Enter Full Name">
                                    @error('fullName') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="emailAddress" class="control-label"> Email Address :<span class="text-red">*</span></label>
                                    <input type="text" class="form-control" wire:model="emailAddress" placeholder="Enter Email Address">
                                    @error('emailAddress') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phoneNumber" class="control-label"> Phone Number :<span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="phoneNumber" wire:model="phoneNumber" placeholder="Enter Phone Number">
                                    @error('phoneNumber') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="videoFile" class="control-label"> Upload Song File :<span class="text-red">*</span></label>
                                    <input type="file" class="form-control" id="videoFile" wire:model="videoFile" accept=".mp3, .wav, .ogg, .aac, .flac, .m4a">
                                    @error('videoFile') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thumbnail" class="control-label"> Upload Song Cover Image :</label>
                                    <input type="file" class="form-control" id="thumbnail" wire:model="thumbnail" accept=".jpg, .jpeg, .png, .gif, .bmp, .webp, .svg">
                                    @error('thumbnail') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="loading-spinner-main" wire:loading.flex wire:target="submitForm">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

