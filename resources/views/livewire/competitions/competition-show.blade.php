<!-- Content Wrapper. Contains page content -->
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid" src="{{ $competition->image && file_exists(public_path($competition->image)) ? url($competition->image) : asset('assets/dist/img/no-image.png') }}">
                            </div>

                            <h3 class="profile-username text-center">{{$competition->title}}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Status</b> 
                                    <a class="float-right">
                                        @if ($competition->status == "active")
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Created Data</b> <a class="float-right">{{$competition->created_at}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Submissions</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Votes</b> <a class="float-right">543</a>
                                </li>
                            </ul>  
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Informations</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Submissions</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Votes</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    {{$competition->description}}
                                </div>
                                <div class="tab-pane" id="timeline">
                                    <section class="content">
                                        <div class="card card-solid">
                                            <div class="card-body pb-0">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                        <div class="card bg-light d-flex flex-fill">
                                                            
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                        
                                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                            <li class="small">
                                                                                <span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ
                                                                            </li>
                                                                            <li class="small">
                                                                                <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="text-right">
                                                                    <a href="#" class="btn btn-sm bg-teal">
                                                                        <i class="fas fa-comments"></i>
                                                                    </a>
                                                                    <a href="#" class="btn btn-sm btn-primary"> <i class="fas fa-user"></i> View Profile </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                        <div class="card bg-light d-flex flex-fill">
                                                            
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                        
                                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                            <li class="small">
                                                                                <span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ
                                                                            </li>
                                                                            <li class="small">
                                                                                <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="text-right">
                                                                    <a href="#" class="btn btn-sm bg-teal">
                                                                        <i class="fas fa-comments"></i>
                                                                    </a>
                                                                    <a href="#" class="btn btn-sm btn-primary"> <i class="fas fa-user"></i> View Profile </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                        <div class="card bg-light d-flex flex-fill">
                                                            
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h2 class="lead"><b>Nicole Pearson</b></h2>
                                                                        
                                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                            <li class="small">
                                                                                <span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ
                                                                            </li>
                                                                            <li class="small">
                                                                                <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="text-right">
                                                                    <a href="#" class="btn btn-sm bg-teal">
                                                                        <i class="fas fa-comments"></i>
                                                                    </a>
                                                                    <a href="#" class="btn btn-sm btn-primary"> <i class="fas fa-user"></i> View Profile </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <nav aria-label="Contacts Page Navigation">
                                                    <ul class="pagination justify-content-center m-0">
                                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">8</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>                                        
                                    </section>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px;">#</th>
                                                <th>Task</th>
                                                <th>Progress</th>
                                                <th style="width: 40px;">Label</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Update software</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%;"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">55%</span></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Clean database</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar bg-warning" style="width: 70%;"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning">70%</span></td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Cron job running</td>
                                                <td>
                                                    <div class="progress progress-xs progress-striped active">
                                                        <div class="progress-bar bg-primary" style="width: 30%;"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-primary">30%</span></td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>Fix and squish bugs</td>
                                                <td>
                                                    <div class="progress progress-xs progress-striped active">
                                                        <div class="progress-bar bg-success" style="width: 90%;"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">90%</span></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>