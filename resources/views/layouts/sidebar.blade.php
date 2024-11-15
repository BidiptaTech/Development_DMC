<!-- Sidenav Menu Start -->
<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="index.html" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="{{ asset('assets/images/logo-light.png') }}" alt="logo"></span>
            <span class="logo-sm"><img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo"></span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg"><img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo"></span>
            <span class="logo-sm"><img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo"></span>
        </span>
    </a>


    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ti ti-circle align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title">Navigation</li>

            <li class="side-nav-item">
                <a href="/" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="calendar-days"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>
            @if(auth()->user()->user_type = 1)
            <li class="side-nav-title">Hotels</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesError" aria-expanded="false" aria-controls="sidebarPagesError" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="shield-x"></i></span>
                    <span class="menu-text"> All Hotels </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesError">
                    <ul class="sub-menu">                      
                        <li class="side-nav-item">
                            <a href="{{ route('category.index') }}" class="side-nav-link">
                                <span class="menu-text">Category</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('facility.index') }}" class="side-nav-link">
                                <span class="menu-text">Facility</span>
                            </a>
                        </li>                        
                        <li class="side-nav-item">
                            <a href="{{ route('hotels.index') }}" class="side-nav-link">
                                <span class="menu-text">Hotel</span>
                            </a>
                        </li>                       
                    </ul>
                </div>
            </li>
            @endif

            @if(auth()->user()->can('create users') || auth()->user()->can('edit users') || auth()->user()->can('view users') || auth()->user()->can('delete users') || auth()->user()->can('create roles') || auth()->user()->can('view roles') || auth()->user()->can('edit roles') || auth()->user()->can('delete roles') 
                || auth()->user()->can('view features') || auth()->user()->can('feature status'))
            <li class="side-nav-title">User</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarAppsEmail" aria-expanded="false" aria-controls="sidebarAppsEmail" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="mail"></i></span>
                    <span class="menu-text"> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarAppsEmail">
                    <ul class="sub-menu">                      
                        @if(auth()->user()->can('create users') || auth()->user()->can('view users') || auth()->user()->can('edit users') || auth()->user()->can('delete users'))
                        <li class="side-nav-item">
                            <a href="{{ route('users.index') }}" class="side-nav-link">
                                <span class="menu-text">Users</span>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->can('create roles') || auth()->user()->can('edit roles') || auth()->user()->can('view roles') || auth()->user()->can('delete roles'))
                        <li class="side-nav-item">
                            <a href="{{ route('roles.index') }}" class="side-nav-link">
                                <span class="menu-text">Roles</span>
                            </a>
                        </li>  
                        @endif    
                        @if(auth()->user()->can('view features') || auth()->user()->can('feature status'))
                        <li class="side-nav-item">
                            <a href="{{ route('features') }}" class="side-nav-link">
                                <span class="menu-text">Features</span>
                            </a>
                        </li>  
                        @endif                     
                    </ul>
                </div>
            </li>
            @endif
            @if(auth()->user()->user_type == 1)
            <li class="side-nav-title">Settings</li>
            <li class="side-nav-item">
                <a href="{{ route('master-setting') }}" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="calendar-days"></i></span>
                    <span class="menu-text"> Master Settings </span>
                </a>
            </li>
            @endif
            @if(auth()->user()->user_type = 1 || auth()->user()->user_type = 2)
            <li class="side-nav-title">Tranasaction</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="file-plus"></i></span>
                    <span class="menu-text"> Tranasaction </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('transaction') }}" class="side-nav-link">
                                <span class="menu-text">All Tranasaction</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>   
            @endif
        </ul>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Sidenav Menu End -->