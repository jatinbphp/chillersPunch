<div class="main-section">

	<section class="listen-vote-banner from-your">
        <div class="left">
            <img class="from-your-img" data-aos="fade-up" src="{{url('assets/dist/front/img/from-your.png') }}" alt="" />
            <img class="black-img" data-aos="fade-up" src="{{url('assets/dist/front/img/black-img.png') }}" alt="" />
        </div>
        <div class="right">
        	<div class="listen-now-btn" data-aos="zoom-in">
            	<a href="{{ route('listen-and-vote') }}" wire:navigate></a>
        	</div>
	        <div class="submit-entry-btn" data-aos="zoom-in">
	            <button type="button" data-toggle="modal" data-target="#myModal"></button>
	        </div>
            <img class="products-img" data-aos="fade-up" src="{{url('assets/dist/front/img/products-img.png') }}" alt="" />
        </div>
    </section>

    <section class="the-finalists the-charts-page">
		<x-front.social-media-links />
		 <img class="circles-img" src="{{url('assets/dist/front/img/circles.png') }}" alt="" />
    	
    		<div class="the-charts-title-img text-center" data-aos="fade-up">
    			<img src="{{url('assets/dist/front/img/the-charts-title-img.png') }}" alt="" />
    		</div>
            <div class="song-list" data-aos="fade-up">
                <livewire:front.submissions-list :isChartsPage="true" :isFinalistPage="false"/>
            </div>
            
    </section>
</div>
