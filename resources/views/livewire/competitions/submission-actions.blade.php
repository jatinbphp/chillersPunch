<div class="action-buttons">
    <a href="javascript:void(0)" title="View Details" data-id="{{$submissionId}}" class="btn btn-info btn-sm view-info" data-url="{{route('competitions.submission.info',['id' => $submissionId])}}"><i class="fa fa-eye"></i></a>
    <button class="btn btn-danger btn-sm deleteRecord" data-id="{{$submissionId}}" data-url="{{route('competitions.submission.destroy',['id' => $submissionId])}}" data-table="submissionTable"><i class="fa fa-trash"></i></button>
</div>