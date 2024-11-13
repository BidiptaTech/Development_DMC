<header class="app-topbar">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-1">
            <!-- Brand Logo -->
            <a href="index.html" class="logo">
                <span class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                    </span>
                </span>
                <span class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                    </span>
                </span>
            </a>

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button px-2">
                <i data-lucide="menu" class="font-22"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i data-lucide="menu" class="font-22"></i>
            </button>

            <form class="app-search d-none d-sm-flex align-items-center">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn btn-icon" type="submit">
                                <i data-lucide="search" class="font-16"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="d-flex align-items-center gap-1">
            <!-- Light/Dark Mode Toggle -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link" id="light-dark-mode" type="button">
                    <i data-lucide="moon" class="font-22 light-mode"></i>
                    <i data-lucide="sun" class="font-22 dark-mode"></i>
                </button>
            </div>

            <!-- Notification Dropdown -->
            <div class="topbar-item">
                <div class="dropdown">
                    <button class="topbar-link dropdown-toggle drop-arrow-none position-relative" data-bs-toggle="dropdown" data-bs-offset="0,25" type="button" data-bs-auto-close="outside" aria-haspopup="false" aria-expanded="false">
                        <i data-lucide="bell" class="font-22"></i>
                        <span class="badge bg-pink rounded-circle noti-icon-badge">4</span>
                    </button>

                    <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="min-height: 300px;">
                        <div class="p-2 border-bottom bg-primary">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 font-16 fw-medium text-white"> Notifications</h6>
                                </div>
                                <div class="col-auto">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none link-dark" data-bs-toggle="dropdown" data-bs-offset="0,15" aria-expanded="false">
                                            <i class="mdi mdi-cog-outline font-22 align-middle text-white"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">Mark as Read</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Delete All</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Do not Disturb</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Other Settings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative z-2" style="max-height: 300px;" data-simplebar>
                            <!-- Notification Items -->
                            <div class="dropdown-item notification-item py-2 text-wrap active" id="notification-1">
                                <span class="d-flex align-items-center">
                                    <span class="me-3 position-relative flex-shrink-0">
                                        <div class="avatar avatar-md">
                                            <span class="avatar-title bg-success rounded-circle">
                                                <i class="mdi mdi-cog-outline font-20"></i>
                                            </span>
                                        </div>
                                    </span>
                                    <span class="flex-grow-1 text-muted">
                                        <p class="fw-medium mb-0 text-dark">New settings</p>
                                        <span class="font-12">There are new settings available</span>
                                    </span>
                                    <span class="notification-item-close">
                                        <button type="button" class="btn btn-ghost-danger rounded-circle btn-sm btn-icon" data-dismissible="#notification-1">
                                            <i class="mdi mdi-close font-16"></i>
                                        </button>
                                    </span>
                                </span>
                            </div>

                            <!-- More Notifications... -->
                            <!-- Similar notification items here... -->
                        </div>

                        <!-- View All Button -->
                        <a href="javascript:void(0);" class="dropdown-item notification-item position-fixed z-2 bottom-0 text-center text-reset text-decoration-underline link-offset-2 fw-bold notify-item border-top border-light py-2">
                            View All
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-0 d-flex align-items-center" data-bs-toggle="dropdown" data-bs-offset="0,19" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" width="32" class="rounded-circle me-lg-2" alt="user-image">
                        <span class="d-lg-flex flex-column d-none">
                            <span class="my-0">{{ Auth::user()->name }}</span>
                        </span>
                        <i data-lucide="chevron-down" class="d-none d-sm-flex ms-1" height="12"></i>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- Welcome Header -->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>

                        <!-- Account Link -->
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                            <i class="mdi mdi-account-circle-outline me-2 font-17"></i>
                            <span>My Account</span>
                        </a>

                        @php
                            $credits = \App\Models\Transaction::where('user_id', Auth::id())->sum('amount');
                            $debits = \App\Models\Transaction::where('credited_from', Auth::id())->sum('amount');
                            $walletBalance = $credits - $debits;
                        @endphp

                        <!-- Wallet Balance Display (Non-Admin Users) -->
                        @if(Auth::id() != 1)
                        <div class="text-center mb-2">
                            <h6 class="text-muted mb-0 d-inline-flex align-items-center gap-1">
                                <i class="material-icons-outlined" style="font-size: 18px;">account_balance_wallet</i>
                                <span>Balance:</span>
                                <span class="fw-bold text-primary">₹{{ number_format($walletBalance, 2) }}</span>
                            </h6>
                        </div>
                        @endif

                        <hr class="dropdown-divider my-2">

                        <!-- Back to Admin Button (if session 'from_admin' is active) -->
                        @if(session('from_admin'))
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item d-flex align-items-center justify-content-center gap-2 mb-2 btn btn-sm btn-outline-secondary">
                                <i class="material-icons-outlined" style="font-size: 18px;">arrow_back</i>
                                Back to Admin
                            </a>
                        @endif

                        <!-- Sign Out Button -->
                        <form method="POST" action="{{ route('logout') }}" class="d-block">
                            @csrf
                            <button type="submit" class="dropdown-item btn btn-sm btn-danger d-flex align-items-center justify-content-center gap-1 w-100">
                                <i class="material-icons-outlined" style="font-size: 18px;">logout</i>Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Button Trigger Customizer Offcanvas -->
            <div class="topbar-item">
                <button class="topbar-link" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" type="button">
                    <i data-lucide="settings" class="font-22"></i>
                </button>
            </div>
        </div>
    </div>
</header>
