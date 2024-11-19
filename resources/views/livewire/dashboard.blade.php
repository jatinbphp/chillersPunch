<div class="content-wrapper">

    @include('common.header', [
        'menu' => $menu,
        'breadcrumb' => [],
        'active' => ''
    ])
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3>{{ $totalCompetitions }}</h3>
                            <p class="text-bold">Total Cometitions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <a href="{{route('competitions.list')}}" class="small-box-footer" wire:navigate>
                            More info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalSubmission }}</h3>
                            <p class="text-bold">Total Submissions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <a href="#" class="small-box-footer" wire:navigate>
                            More info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalVoting }}</h3>
                            <p class="text-bold">Total Votes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-vote-yea"></i>
                        </div>
                        <a href="#" class="small-box-footer" wire:navigate>
                            More info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>