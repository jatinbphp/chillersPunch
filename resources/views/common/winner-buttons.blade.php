@if ($isWinner == 1)
    <div class="btn-group-horizontal" id="assign_remove_{{$id}}">
        <button class="btn btn-success btn-sm ladda-button" data-style="slide-left" id="remove" data-url="{{route('competitions.submission.winner.update')}}" data-id="{{$id}}" type="button" data-type="no" data-table_name="{{$table_name}}">
            <span class="ladda-label">Yes</span> 
        </button>
    </div>
    <div class="btn-group-horizontal" id="assign_add_{{$id}}" style="display: none">
        <button class="btn btn-danger btn-sm ladda-button" data-style="slide-left" data-id="{{$id}}" data-url="{{route('competitions.submission.winner.update')}}" type="button" data-type="yes" data-table_name="{{$table_name}}">
            <span class="ladda-label">No</span>
        </button>
    </div>
@else
    <div class="btn-group-horizontal" id="assign_add_{{$id}}">
        <button class="btn btn-danger btn-sm ladda-button" data-style="slide-left" data-id="{{$id}}" data-url="{{route('competitions.submission.winner.update')}}" type="button" data-type="yes" data-table_name="{{$table_name}}">
            <span class="ladda-label">No</span>
        </button>
    </div>
    <div class="btn-group-horizontal" id="assign_remove_{{$id}}" style="display: none">
        <button class="btn btn-success btn-sm ladda-button" id="remove" data-id="{{$id}}" data-style="slide-left" data-url="{{route('competitions.submission.winner.update')}}" type="button" data-type="no" data-table_name="{{$table_name}}">
            <span class="ladda-label">Yes</span>
        </button>
    </div>
@endif