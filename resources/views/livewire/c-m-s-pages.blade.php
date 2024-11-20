<div class="content-wrapper">
    
    @include('common.header', [
        'menu' => $menu,
        'breadcrumb' => [
            ['route' => getRoleWiseHomeUrl(), 'title' => getRoleWiseHomeLabel()],
            ['route' => route('competitions.list'), 'title' => 'CMS Pages']
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
                                    <div class="form-group">
                                        <label for="title" class="control-label"> Description :<span class="text-red">*</span></label>
                                        <textarea class="form-control" wire:model="description" id='description' placeholder="Description" rows="5"></textarea>
                                        @error('description') <span class="text-danger w-100">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                           </div>
                        </div>
                        <div class="card-footer">
                            @include('common.footer-buttons', ['route' => route('competitions.list'), 'type' => 'create'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>