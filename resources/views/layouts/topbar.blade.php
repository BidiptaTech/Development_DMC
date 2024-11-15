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

        </div>
    </div>
</header>
