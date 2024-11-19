@if($section_name=='companies-call-outs')
    
    <div class="btn-group">
        <button type="button" class="btn btn-info">Action</button>
        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            @if (!in_array(Auth::user()->role, ['controllers', 'accountants']) && !isset($login_user))
                <a href="{{ url('admin/'.$section_name.'/'.$id.'/edit') }}" title="Edit" class="dropdown-item text-info">
                    <i class="fa fa-edit"></i> Edit
                </a>
            @endif

            @if (in_array(Auth::user()->role, ['controllers']))
                @if($status!='open')
                    <a href="{{ url('admin/'.$section_name.'/'.$id.'/claimed') }}" title="Edit" class="dropdown-item text-info">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                @else  
                    <button class="dropdown-item claim-by-me text-success" data-section="{{$section_name}}_table" data-id="{{$id}}" data-url="{{route('controller.call-outs.claim')}}" type="button" title="Claim">
                        <i class="fa fa-exchange-alt"></i> Claim
                    </button>
                @endif
            @endif

            @if($section_name!='roles')
                @if(Auth::user()->role=='super_admin')
                    <button class="dropdown-item deleteRecord text-danger" data-id="{{$id}}" type="button" data-url="{{ url('admin/'.$section_name.'/'.$id) }}" data-section="{{$section_name}}_table" title="Delete">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                @endif
            @endif

            @if(!in_array(Auth::user()->role, ['controllers']))
                <a href="javascript:void(0)" title="View" data-id="{{$id}}" class="dropdown-item view-info text-warning" data-url="{{ route($section_name.'.show', [strtolower(str_replace(' ', '_', $section_title)) => $id]) }}">
                    <i class="fa fa-eye"></i> View
                </a>
            @endif

            @if($section_name=='companies-call-outs' && Auth::user()->role=='super_admin' && $status!='open')
                <a href="{{ url('admin/'.$section_name.'/'.$id.'/claimed') }}" title="Call-Out Claim Info" class="dropdown-item text-secondary">
                    <i class="fa fa-info-circle"></i> Claim Info
                </a>
            @endif

            @if($section_name=='companies-call-outs' && in_array(Auth::user()->role,['controllers','super_admin']) && $status=='closed')
                <a href="{{ url('admin/'.$section_name.'/'.$id.'/whatsapp') }}" title="To send to call-out info to whatsapp" class="dropdown-item text-success" target="_blank">
                    <i class="fab fa-whatsapp"></i> Send to Whatsapp
                </a>
                <a href="{{ url('admin/'.$section_name.'/'.$id.'/downloadimagesinzip') }}" title="To download images in zip file" class="dropdown-item text-primary">
                    <i class="fas fa-download"></i> Download Images
                </a>

                <a href="{{ url('admin/'.$section_name.'/'.$id.'/1/pdfsendtomail') }}" title="To download call-out report in PDF file" class="dropdown-item text-primary">
                    <i class="fas fa-download"></i> Download Report
                </a>

                <a href="{{ url('admin/'.$section_name.'/'.$id.'/0/pdfsendtomail') }}" title="To Generate PDF and send to company's mail" class="dropdown-item text-primary">
                    <i class="fas fa-envelope"></i> PDF &amp; MAIL
                </a>
            @endif
        </div>
    </div>

@else

    @if($section_name!='service-providers-fees' && $section_name!='service-provider-assign' && $section_name!='invoicing')

        @if (!in_array(Auth::user()->role, ['controllers', 'accountants']) && !isset($login_user))
            <a href="{{ url('admin/'.$section_name.'/'.$id.'/edit') }}" title="Edit" class="btn btn-sm btn-info tip ">
                <i class="fa fa-edit"></i>
            </a>
        @endif

        @if (in_array(Auth::user()->role, ['controllers']))
            @if($status!='open')
                <a href="{{ url('admin/'.$section_name.'/'.$id.'/claimed') }}" title="Edit" class="btn btn-sm btn-info tip w-75">
                    <i class="fa fa-edit"></i> Edit
                </a>
            @else  
                <button class="btn btn-sm btn-success claim-by-me w-100" data-section="{{$section_name}}_table" data-id="{{$id}}" data-url="{{route('controller.call-outs.claim')}}" type="button" title="Claim">
                    <i class="fa fa-exchange-alt"></i> Claim
                </button>
            @endif
        @endif

        @if($section_name!='roles')
            @if(Auth::user()->role=='super_admin')
                <button class="btn btn-sm btn-danger deleteRecord" data-id="{{$id}}" type="button" data-url="{{ url('admin/'.$section_name.'/'.$id) }}" data-section="{{$section_name}}_table" title="Delete">
                    <i class="fa fa-trash"></i>
                </button>
            @endif
        @endif

        @if(!in_array(Auth::user()->role, ['controllers']))
            <a href="javascript:void(0)" title="View" data-id="{{$id}}" class="btn btn-sm btn-warning tip  view-info" data-url="{{ route($section_name.'.show', [strtolower(str_replace(' ', '_', $section_title)) => $id]) }}">
                <i class="fa fa-eye"></i>
            </a>
        @endif

    @elseif($section_name=='service-provider-assign')
        
        @if($callout->assigned_branch_id==$id)
            <button class="btn btn-sm btn-secondary view-claim-sp-route" type="button" title="View Route" data-sp-latitude="{{$sp_latitude}}" data-sp-longitude="{{$sp_longitude}}" data-callout-latitude="{{$call_out_latitude}}" data-callout-longitude="{{$call_out_longitude}}">
                View Route
            </button>
            <button class="btn btn-sm btn-success" type="button" title="Assigned">
                Assigned
            </button>
        @else 
            <button class="btn btn-sm btn-info assign-by-controller w-100" data-section="{{$section_name}}_table" data-account_id="{{$account_id}}" data-id="{{$id}}" data-calloutsid="{{$callout->id}}" data-url="{{route('controller.call-outs.assign')}}" type="button" title="Assign">
                Assign
            </button>
        @endif

    @elseif($section_name=='invoicing')

        <a href="javascript:void(0)" title="View" data-id="{{$id}}" class="btn btn-sm btn-warning tip  view-info" data-url="{{ route($section_name.'.show', [strtolower(str_replace(' ', '_', $section_title)) => $id]) }}">
            <i class="fa fa-eye"></i>
        </a>

    @else 

        <button class="btn btn-sm btn-info tip update-price" data-toggle="tooltip" data-sp_id="{{$id}}" title="Update Price" data-trigger="hover" type="button">
            <i class="fa fa-edit"></i>
        </button>

    @endif

@endif