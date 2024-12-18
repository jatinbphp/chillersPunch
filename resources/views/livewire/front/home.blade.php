<div class="main-section">
    <section class="from-your">
        <div class="left">
            <img class="from-your-img" data-aos="fade-up" src="{{url('assets/dist/front/img/from-your.png') }}" alt="" />
        </div>
        <div class="right">
            <img class="products-img" data-aos="fade-up" src="{{url('assets/dist/front/img/products-img.png') }}" alt="" />
        </div>
    </section>

    <section class="win-your">
        <div class="left">
            <img class="win-your-img" data-aos="zoom-in" src="{{url('assets/dist/front/img/WIN-YOUR.png') }}" alt="" />
        </div>
        <div class="right">
            <div class="center" data-aos="fade-up">
                <h2>SHOWCASE YOUR MUSICAL TALENT AND BE A PART OF SOMETHING EPIC.</h2>
                <p>Create the original Chillers Anthem that defines our community. Upload your original song and you could stand a chance to win your share of R100 000!</p>
            </div>
        </div>
    </section>
    <section class="easy-steps">
        <div class="easy-steps-box">
            <div class="submitting-img">
                <img data-aos="zoom-in" src="{{url('assets/dist/front/img/submitting.png') }}" alt="" />
            </div>
            <div class="step-main">
                <div class="box" data-aos="fade-up">
                    <h2>STEP ONE</h2>
                    <p>Fill out the submission form below.</p>
                </div>
                <div class="box" data-aos="fade-up">
                    <h2>STEP TWO</h2>
                    <p>Upload your song file (MP3 or WAV).</p>
                </div>
                <div class="box" data-aos="fade-up">
                    <h2>STEP THREE</h2>
                    <p>Hit submit and get ready to shine!</p>
                </div>
            </div>
            <div class="ground-rule" data-aos="fade-up">
                <h3>Ground Rule: Song must mention Chillers Punch at least once.</h3>
                <p>Submit your anthem now and join the rhythm of the Chillers community.</p>
                @if(!empty($activeCompetition))
                    <button type="button" data-toggle="modal" data-target="#myModal">DOWNLOAD SUBMISSION FORM</button>
                @endif
            </div>
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
                                    <label for="submissionTitle" class="control-label"> Title :<span class="text-red">*</span></label>
                                    <input type="text" id="submissionTitle" class="form-control" wire:model="submissionTitle" placeholder="Enter Title">
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
                                    <label for="videoFile" class="control-label"> Upload Video File :<span class="text-red">*</span></label>
                                    <input type="file" class="form-control" id="videoFile" wire:model="videoFile">
                                    @error('videoFile') <span class="text-danger w-100">{{ $message }}</span> @enderror
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