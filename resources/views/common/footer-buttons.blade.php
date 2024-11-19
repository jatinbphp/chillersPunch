@if(!isset($is_hide_back))
	<a href="{{ $route }}" class="btn btn-sm btn-secondary" wire:navigate><i class="fa fa-arrow-left pr-1"></i> Back</a>

	@if($type!="view")
		@if($type=="update")
			<button class="btn btn-sm btn-info float-right" type="submit" wire:loading.attr="disabled" wire:loading.class="spinner"><i class="fa fa-edit pr-1"></i> Update</button>
		@else
			<button class="btn btn-sm btn-info float-right" type="submit" wire:loading.attr="disabled" wire:loading.class="spinner"><i class="fa fa-save pr-1"></i> Save</button>
		@endif
	@endif
@else
	@if (Auth::user() && in_array(Auth::user()->role, ['submitter']))
		<!-- <button class="btn btn-sm btn-success float-right" wire:click="setSubmitType(1)" type="submit" wire:loading.attr="disabled" wire:loading.class="spinner"  wire:model="submit"><i class="fa fa-save pr-1"></i> Save and Complete</button> -->

		<button class="btn btn-sm btn-success float-right" wire:click="setSubmitType(1)" type="submit" wire:loading.attr="disabled" wire:model="submit">
		    <span wire:loading.remove wire:target="setSubmitType(1)"><i class="fa fa-save pr-1"></i> Save and Complete</span>
		    <span wire:loading wire:target="setSubmitType(1)" ><i class="fa fa-spinner fa-spin"></i> Loading...</span>
		</button>
	@endif

	<!-- <button class="btn btn-sm btn-info float-right mr-2" wire:click="setSubmitType(3)" type="submit" wire:loading.attr="disabled" wire:loading.class="spinner" wire:model="submit"><i class="fa fa-save pr-1"></i> Save and Exit</button> -->

	<button class="btn btn-sm btn-info float-right mr-2" wire:click="setSubmitType(3)" type="submit" wire:loading.attr="disabled" wire:model="submit">
	    <span wire:loading.remove wire:target="setSubmitType(3)"><i class="fa fa-save pr-1"></i> Save and Exit</span>
	    <span wire:loading wire:target="setSubmitType(3)" ><i class="fa fa-spinner fa-spin"></i> Loading...</span>
	</button>

	<!-- <button class="btn btn-sm btn-warning float-right mr-2" wire:click="setSubmitType(2)"type="submit" wire:loading.attr="disabled" wire:loading.class="spinner" wire:model="submit"><i class="fa fa-save pr-1"></i> Save and Continue Editing</button> -->

	<button class="btn btn-sm btn-warning float-right mr-2" wire:click="setSubmitType(2)" type="submit" wire:loading.attr="disabled" wire:model="submit">
	    <span wire:loading.remove wire:target="setSubmitType(2)"><i class="fa fa-save pr-1"></i> Save and Continue Editing</span>
	    <span wire:loading wire:target="setSubmitType(2)" ><i class="fa fa-spinner fa-spin"></i> Loading...</span>
	</button>
@endif
