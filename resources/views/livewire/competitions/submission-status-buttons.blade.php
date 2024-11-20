@switch($status)
    @case('approved')
        <span class="badge bg-success">Approved</span>
        @break
    @case('pending')
        <span class="badge bg-warning">Pending</span>
        @break
    @case('rejected')
        <span class="badge bg-danger">Rejected</span>
        @break
    @default
        <span class="badge bg-secondary">Unknown</span>
@endswitch