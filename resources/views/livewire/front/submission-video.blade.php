<div class="modal-body">
    @if ($submissioInfo->videoFile && file_exists(public_path($submissioInfo->videoFile)))
        <iframe class="embed-responsive-item" style="height: 350px !important;width: 100%;" src="{{ asset($submissioInfo->videoFile) }}" allowfullscreen=""></iframe>
    @else
        Video is not available..
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times pr-1"></i></i> Close</button>
</div>