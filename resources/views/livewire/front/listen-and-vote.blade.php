<div class="main-section">
    <section class="listen-vote-banner">
        <div class="listen-now-btn">
            <a href="#"></a>
        </div>
        <div class="submit-entry-btn">
            <button type="button" data-toggle="modal" data-target="#listen-now"></button>
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
                                            <img src="{{url('assets/dist/front/img/default-image.png') }}" alt="" />
                                        @endif
                                    </div>
                                    <div class="song-name">
                                        <h6>{{$value->submissionTitle}}</h6>
                                        <p>{{$value->fullName}}</p>
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

    <div class="modal fade" id="listen-now" tabindex="-1" role="dialog" aria-labelledby="listenNowlLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h1>listen-now</h1>
            </div>
        </div>
    </div>
    
</div>

