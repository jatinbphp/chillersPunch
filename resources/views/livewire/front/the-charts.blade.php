<div class="main-section">

	<section class="listen-vote-banner from-your">
        <div class="left">
            <img class="from-your-img" data-aos="fade-up" src="{{url('assets/dist/front/img/from-your.png') }}" alt="" />
            <img class="black-img" data-aos="fade-up" src="{{url('assets/dist/front/img/black-img.png') }}" alt="" />
        </div>
        <div class="right">
            <div class="listen-now-btn" data-aos="zoom-in">
                @if(getTotalSubmission()>0)
                    <a class="hidden" href="{{ route('listen-and-vote') }}" wire:navigate></a>
                @else
                @endif
                <a href="javascript:void(0)"></a>
            </div>
            <div class="submit-entry-btn" data-aos="zoom-in">
                @if(getTotalCompetition()>0)
                    <a class="hidden" href="{{ route('submit-now') }}" wire:navigate></a>
                @else
                @endif
                <a href="{{ route('submit-now') }}" wire:navigate></a>
            </div>
            <img class="products-img" data-aos="fade-up" src="{{url('assets/dist/front/img/products-img.png') }}" alt="" />
        </div>
    </section>

    <section class="the-finalists the-charts-page">
		<x-front.social-media-links />
	  <img class="circles-img" src="{{url('assets/dist/front/img/circles.png') }}" alt="" />
    	
		<div class="the-charts-title-img text-center" data-aos="fade-up">
			{{-- <img src="{{url('assets/dist/front/img/the-charts-title-img.png') }}" alt="" /> --}}
		</div>
        <div class="song-list" data-aos="fade-up" style="display: none;">
            <livewire:front.submissions-list :isChartsPage="true" :isFinalistPage="false"/>
        </div>
    </section>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" wire:ignore.self>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" id="agreeTerms" name="agreeTerms" wire:model="agreeTerms">
                                    <label class="form-check-label" for="agreeTerms">
                                      I agree to the <a href="{{ route('terms-and-conditions') }}" target="_blank">Terms and Conditions</a>.
                                    </label>
                                    <p>@error('agreeTerms') <span class="text-danger w-100">{{ $message }}</span> @enderror<p>
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
