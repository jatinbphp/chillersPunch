<!-- Modal content -->
<div class="modal-header">
    <h5 class="modal-title" id="commonModalLabel">Submission Informations</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Song Title :</th>
                        <td>{{$submissioInfo->submissionTitle}}</td>
                    </tr>
                    <tr>
                        <th>Full Name :</th>
                        <td>{{$submissioInfo->fullName}}</td>
                    </tr>
                    <tr>
                        <th>Email :</th>
                        <td>{{$submissioInfo->emailAddress}}</td>
                    </tr>
                    <tr>
                        <th>Phone :</th>
                        <td>{{$submissioInfo->phoneNumber}}</td>
                    </tr>
                    <tr>
                        <th>Status :</th>
                        <td>{!! renderStatus($submissioInfo->status) !!}</td>
                    </tr>
                    <tr>
                        <th>Is Winner :</th>
                        <td>{!! $submissioInfo->isWinner == 1 ? 'Yes' : 'No' !!}</td>
                    </tr>
                    <tr>
                        <th>Song File :</th>
                        <td>
                            {{-- <iframe class="embed-responsive-item w-100" style="height: 350px !important;" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen=""></iframe>   --}}
                         
                            <div id="audio-player-container">
                                <img id="cover-image" src="{{ file_exists(public_path($submissioInfo->thumbnail)) ? url($submissioInfo->thumbnail) : url('assets/dist/img/default-song-cover.png') }}" alt="Cover Image" />
                                <audio id="player" controls>
                                    <source id="sourceOgg" src="audio/track.ogg" type="audio/ogg" />
                                    <source id="sourceMp3" src="{{ url($submissioInfo->videoFile) }}" type="audio/mp3" />
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times pr-1"></i></i> Close</button>
</div>
@php
function renderStatus($status) {
    $class = match ($status) {
        'approved' => 'success',
        'pending' => 'warning',
        'rejected' => 'danger',
    };
    return '<span class="badge badge-' . $class . '">' . ucfirst($status) . '</span>';
}
@endphp
