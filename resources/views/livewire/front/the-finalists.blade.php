<div class="main-section">
    <section class="listen-vote-banner the-finalists-banner">
        <div class="listen-now-btn" data-aos="zoom-in">
            <a href="{{ route('listen-and-vote') }}" wire:navigate></a>
        </div>
        <div class="submit-entry-btn" data-aos="zoom-in">
            <button type="button" data-toggle="modal" data-target="#myModal"></button>
        </div>
        <img src="{{url('assets/dist/front/img/listen-vote-banner.png') }}" alt="" />
    </section>

    <section class="the-finalists">
		<x-front.social-media-links />
		 <img class="circles-img" src="{{url('assets/dist/front/img/circles.png') }}" alt="" />
    	
    		<h2 data-aos="fade-up">THE FINALISTS</h2>
            <div class="song-list" data-aos="fade-up">
                <livewire:front.submissions-list :isChartsPage="false" :isFinalistPage="true"/>
            </div>
            
    </section>
</div>
