<div class="content-wrapper">
    
    @include('common.header', [
        'menu' => $menu,
        'breadcrumb' => [
            ['route' => getRoleWiseHomeUrl(), 'title' => getRoleWiseHomeLabel()],
            ['route' => route('competitions.list'), 'title' => 'Competitions']
        ],
        'active' => 'View'
    ])

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        @include('common.card-header', ['title' => 'View Competition Details'])
                    </div>
                    <div class="card-body">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <div class="text-center mb-3">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ $competition->image && file_exists(public_path($competition->image)) ? url($competition->image) : asset('assets/dist/img/no-image.png') }}"
                                                    >
                                                </div>
                                                <h3 class="text-bold text-center">{{$competition->title}}</h3>
                                                <p class="text-center">
                                                    @if ($competition->status == "active")
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </p>
                                                                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <p>
                                            {{$competition->description}}
                                        </p> 
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>