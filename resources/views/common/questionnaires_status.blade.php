@if ($completedStatus == "Completed")
    <span class="badge bg-success float-right">{{$completedStatus}}</span>
@else
    <span class="badge bg-danger float-right">{{$completedStatus}}</span>
@endif