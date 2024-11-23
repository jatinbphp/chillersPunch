<select id="status{{$id}}" data-id="{{$id}}" class="form-control updateSubmissionStatus {{ $status == 'pending' ? 'btn-info' : ($status == 'approved' ? 'btn-success' : 'btn-danger') }}">
    <option value="pending" @if($status == 'pending') selected @endif>Pending</option>
    <option value="approved" @if($status == 'approved') selected @endif>Approved</option>
    <option value="rejected" @if($status == 'rejected') selected @endif>Rejected</option>    
</select>