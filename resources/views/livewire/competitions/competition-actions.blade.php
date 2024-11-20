<div class="action-buttons">
    <a href="{{route('competitions.show',['id' => $competitionId])}}" class="btn btn-info btn-sm" wire:navigate><i class="fa fa-eye"></i></a>
    <a href="{{route('competitions.edit',['id' => $competitionId])}}" class="btn btn-primary btn-sm" wire:navigate><i class="fa fa-edit" aria-hidden="true"></i></a>
    <button class="btn btn-danger btn-sm deleteRecord" data-id="{{$competitionId}}" data-url="{{route('competitions.destroy',['id' => $competitionId])}}" data-table="competitionsTable"><i class="fa fa-trash"></i></button>
</div>