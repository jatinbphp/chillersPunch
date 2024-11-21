<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    @include('common.header', [
        'menu' => $menu,
        'breadcrumb' => [
            ['route' => getRoleWiseHomeUrl(), 'title' => getRoleWiseHomeLabel()],
            ['route' => route('competitions.list'), 'title' => 'Competitions'],
            ['route' => route('competitions.show',['id' => $competition->id]), 'title' => $competition->title]
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

                            <h3 class="profile-username text-center text-danger text-bold p-2">{{$competition->title}}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <span><i class="fa fa-circle"></i> Status :</span> 
                                    <a class="float-right">
                                        @if ($competition->status == "active")
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <span><i class="fa fa-calendar"></i> Date Created :</span> <a class="float-right">{{$competition->created_at}}</a>
                                </li>
                                <li class="list-group-item">
                                    <span><i class="fa fa-paper-plane"></i> Total Submissions :</span> <a class="float-right">{{number_format($totalSubmission)}}</a>
                                </li>
                                <li class="list-group-item">
                                    <span><i class="fa fa-vote-yea"></i> Total Votes :</span> <a class="float-right">{{number_format($totalVoting)}}</a>
                                </li>
                                <li class="list-group-item">
                                    <span><i class="fa fa-award"></i> Total Winners :</span> <a class="float-right" id="totalWinners">{{number_format($totalWinners)}}</a>
                                </li>
                            </ul>  
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="">
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-bold" data-toggle="pill" href="#informations" role="tab" aria-controls="informations" aria-selected="false">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-bold" data-toggle="pill" href="#submissions" role="tab" aria-controls="submissions" aria-selected="false">User Submissions ({{number_format($totalSubmission)}})</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-bold" data-toggle="pill" href="#votes" role="tab" aria-controls="votes" aria-selected="false">Voting Summary ({{number_format($totalVoting)}})</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="informations">
                                        {!! $competition->description !!}
                                    </div>
                                    <div class="tab-pane table-responsive" id="submissions">
                                        <input type="hidden" id="submission_route_name" value="{{ route('competitions.submissions', ['id' => $competition->id]) }}">

                                        <input type="hidden" id="submission_status_route_name" value="{{ route('competitions.submission.status.update', ['id' => $competition->id]) }}">
                                        
                                        <table id="submissionTable" class="table table-bordered table-striped w-100 datatable-dynamic">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Submission Information</th>
                                                    <th>Status</th>
                                                    <th>Is Winner</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-responsive" id="votes">
                                        <input type="hidden" id="route_name" value="{{ route('competitions.votings', ['id' => $competition->id]) }}">
                                        <table id="votingTable" class="table table-bordered table-striped w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Submission Information</th>
                                                    <th>Ip Address</th>                                    
                                                    <th>Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>