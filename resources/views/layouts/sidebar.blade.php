<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{getRoleWiseHomeUrl()}}" class="brand-link" wire:navigate>
        

        @if (isset(Auth::user()->image) && file_exists(public_path(Auth::user()->image)))
            <img src="{{ asset(Auth::user()->image) }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        @else
            <img src="{{ URL::asset('assets/dist/img/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        @endif

        <span class="brand-text text-bold">
            {{ config('app.name', 'Laravel') }}
        </span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
            role="menu" data-accordion="false">
                @if(Auth::user() && Auth::user()->role == 'super_admin')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link text-bold @if(isset($menu) && $menu=='Dashboard') active @endif" wire:navigate>
                            <i class="nav-icon far fa-image"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link text-bold @if(isset($menu) && $menu=='Edit Profile') active @endif" wire:navigate>
                        <i class="nav-icon far fa-edit"></i>
                        <p>Edit Profile</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('competitions.list') }}" class="nav-link text-bold @if(isset($menu) && $menu=='Competitions') active @endif" wire:navigate>
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>Competitions</p>
                    </a>
                </li>                

                <li class="nav-item @if(isset($menu) && $menu=='CMS Pages') menu-open @endif">
                    <a href="#" class="nav-link @if(isset($menu) && $menu=='CMS Pages') active @endif">
                        <i class="nav-icon fa fa-file-signature"></i>
                        <p> CMS Pages <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cms.index',['slug'=>'winner_circle']) }}" class="nav-link @if(isset($slug) && $slug=='winner_circle') active @endif">
                                <i class="far fa-circle nav-icon"></i><p>Winner Circle</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cms.index',['slug'=>'terms_conditions']) }}" class="nav-link @if(isset($slug) && $slug=='terms_conditions') active @endif">
                            <i class="far fa-circle nav-icon"></i><p>Terms & Conditions</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-bold text-danger" wire:navigate>
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>Log out</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>