<div class="row">
    <div class="col-md-9">
        <div class="form-group">
            <label for="title" class="control-label"> Title :<span class="text-red">*</span></label>
            <input type="text" id="title" class="form-control" wire:model="title" placeholder="Title">
            @error('title') <span class="text-danger w-100">{{ $message }}</span> @enderror
        </div>
    </div>
     <div class="col-md-3">
        <div class="form-group">
            <label for="status" class="control-label"> Status :<span class="text-red">*</span></label>
            {!! Form::select('status', ['' => 'Please Select'] + $statusList, null, ['class' => 'form-control select2', 'wire:model' => 'status']) !!}
            @error('status') <span class="text-danger w-100">{{ $message }}</span> @enderror
        </div>
    </div> 
    <div class="col-md-12">
        <div class="form-group">
            <label for="title" class="control-label"> Description :<span class="text-red">*</span></label>
            <textarea class="form-control" wire:model="description" placeholder="Description" rows="5"></textarea>
            @error('description') <span class="text-danger w-100">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-3"  wire:ignore>
        <div class="form-group">
            <label for="image" class="control-label"> Image:</span></label>
            <input type="file" class="form-control" id="image" wire:model="image" onChange="AjaxUploadImage(this)">
            @error('image') <span class="text-danger w-100">{{ $message }}</span> @enderror

            @if ($currentImage && file_exists(public_path($currentImage)))
                <img src="{{ asset($currentImage) }}" style="border: 1px solid #ccc; margin-top: 5px;" width="150" id="DisplayImage">
            @else
                <img src="{{ url('assets/dist/img/no-image.png') }}" alt="Placeholder Image" style="border: 1px solid #ccc; margin-top: 5px; padding: 20px;" width="150" id="DisplayImage">
            @endif
        </div>
    </div>      
</div>