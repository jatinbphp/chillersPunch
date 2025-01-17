<div class="main-section">
    <section class="listen-vote-banner">
        <div class="listen-now-btn" data-aos="zoom-in">
            <a href="{{ route('listen-and-vote') }}" wire:navigate></a>
        </div>
        <div class="submit-entry-btn" data-aos="zoom-in">
            <button type="button" onclick="openCompetitionModal()"></button>
        </div>
        <img src="{{url('assets/dist/front/img/listen-vote-banner.png') }}" alt="" />
    </section>

    <section class="win-your">
        <img class="circles-img" src="{{url('assets/dist/front/img/circles.png') }}" alt="" />

        <x-front.social-media-links />
        <div class="left">
            <img class="win-your-img" data-aos="zoom-in" src="{{url('assets/dist/front/img/WIN-YOUR.png') }}" alt="" />
        </div>
        <div class="right">

            <div class="center" data-aos="fade-up">
                <h1>HOW TO ENTER</h1>
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
</div>