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
                                    <b>Total Submissions</b> <a class="float-right">{{number_format($totalSubmission)}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Votes</b> <a class="float-right">{{number_format($totalVoting)}}</a>
                                </li>
                            </ul>  
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link text-bold active" href="#informations" data-toggle="tab">Overview</a></li>
                                <li class="nav-item"><a class="nav-link text-bold" href="#submissions" data-toggle="tab">User Submissions ({{number_format($totalSubmission)}})</a></li>
                                <li class="nav-item"><a class="nav-link text-bold" href="#votes" data-toggle="tab">Voting Summary ({{number_format($totalVoting)}})</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="informations">
                                    {{$competition->description}}
                                </div>

                                <div class="tab-pane" id="submissions">
                                  <input type="hidden" id="submission_route_name" value="{{ route('competitions.submissionData',['id' => $competition->id]) }}">
                                  <section class="content">
                                      <div class="card-solid">
                                          <div class="pb-0">
                                            <div id="cardGrid" class="row"></div>
                                            <nav>
                                                <ul class="pagination justify-content-center" id="pagination"></ul>
                                            </nav>
                                          </div>
                                          <div class="card-footer">
                                              <nav aria-label="Contacts Page Navigation">
                                                  <ul class="pagination justify-content-center m-0" id="pagination-links">
                                                      <!-- Pagination links will be dynamically added -->
                                                  </ul>
                                              </nav>
                                          </div>
                                      </div>
                                  </section>
                                </div>
                                <div class="tab-pane" id="votes">
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