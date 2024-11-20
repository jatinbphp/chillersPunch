<a href="{{ $route }}" class="btn btn-sm btn-secondary" wire:navigate><i class="fa fa-arrow-left pr-1"></i> Back</a>

@if($type!="view")
	@if($type=="update")
		<button class="btn btn-sm btn-info float-right" type="submit" wire:loading.attr="disabled" wire:loading.class="spinner"><i class="fa fa-edit pr-1"></i> Update</button>
	@else
		<button class="btn btn-sm btn-info float-right" type="submit" wire:loading.attr="disabled" wire:loading.class="spinner"><i class="fa fa-save pr-1"></i> Save</button>
	@endif
@endif