@if ($status == "active")
    <div class="btn-group-horizontal" id="assign_remove_{{$id}}">
        <button class="btn btn-success btn-sm assign_unassign ladda-button w-100" data-style="slide-left" id="remove" data-url="{{route('common.statusUpdate')}}" data-id="{{$id}}" type="button" data-type="unassign" data-table_name="{{$table_name}}">
            <span class="ladda-label">Active</span> 
        </button>
    </div>
    <div class="btn-group-horizontal" id="assign_add_{{$id}}" style="display: none">
        <button class="btn btn-danger btn-sm assign_unassign ladda-button w-100" data-style="slide-left" data-id="{{$id}}" data-url="{{route('common.statusUpdate')}}" type="button" data-type="assign" data-table_name="{{$table_name}}">
            <span class="ladda-label">In Active</span>
        </button>
    </div>
@else
    <div class="btn-group-horizontal" id="assign_add_{{$id}}">
        <button class="btn btn-danger btn-sm assign_unassign ladda-button w-100" data-style="slide-left" data-id="{{$id}}" data-url="{{route('common.statusUpdate')}}" type="button" data-type="assign" data-table_name="{{$table_name}}">
            <span class="ladda-label">In Active</span>
        </button>
    </div>
    <div class="btn-group-horizontal" id="assign_remove_{{$id}}" style="display: none">
        <button class="btn btn-success btn-sm assign_unassign ladda-button w-100" id="remove" data-id="{{$id}}" data-style="slide-left" data-url="{{route('common.statusUpdate')}}" type="button" data-type="unassign" data-table_name="{{$table_name}}">
            <span class="ladda-label">Active</span>
        </button>
    </div>
@endif