<div class="content-wrapper">
    
    @include('common.header', [
        'menu' => $menu,
        'breadcrumb' => [
            ['route' => getRoleWiseHomeUrl(), 'title' => getRoleWiseHomeLabel()],
            ['route' => route('cms.index',['slug'=>$slugName]), 'title' => 'CMS Pages'],
            ['route' => route('cms.index',['slug'=>$slugName]), 'title' => $title]
        ],
        'active' => 'Edit'
    ])

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        @include('common.card-header', ['title' => 'Edit ' . $menu])
                    </div>
                    <form wire:submit.prevent="update">
                        <div class="card-body">                            
                           <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="control-label"> Title :<span class="text-red">*</span></label>
                                        <input type="text" id="title" class="form-control" wire:model="title" placeholder="Title">
                                        @error('title') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" wire:ignore>
                                        <label for="title" class="control-label"> Description :<span class="text-red">*</span></label>
                                        <textarea class="form-control" wire:model="description" id='description' placeholder="Description" rows="5"></textarea>
                                    </div>
                                    @error('description') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                </div>
                           </div>
                        </div>
                        <div class="card-footer">
                            @include('common.footer-buttons', ['route' => getRoleWiseHomeUrl(), 'type' => 'update'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    function updateDescription() {
        //console.log(":", $('#description').summernote('code'), ":");
        @this.set('description', $('#description').summernote('code'));
        var content = $('#description').summernote('code');
        content = cleanUpEmptyTags(content);
        //console.log("Updated content:", content);
        @this.set('description', content);
    }
</script>