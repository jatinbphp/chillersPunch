<div class="main-section terms-and-conditions">
    <section class="listen-vote-banner">
        <img src="{{url('assets/dist/front/img/terms-and-conditions-banner.png') }}" alt="" />
    </section>
    <section class="listen-vote-main" >
        <x-front.social-media-links />
        <div class="listen-vote" data-aos="fade-up">
            {!!$termsAndConditions->description!!}
        </div>
    </section>
</div>