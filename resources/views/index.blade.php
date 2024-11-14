@extends('layouts.layout')

@section('content')
<div class="page-content">

    <div class="page-container">

        <!-- Page Title -->
        <div class="card page-title-box rounded-0">
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                <div class="flex-grow-1">
                    <h4 class="font-18 fw-semibold mb-0">Dashboard</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Adminox</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row">
            <!-- Total Revenue -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                <i class="mdi mdi-currency-usd avatar-title font-30 text-white"></i>
                            </div>

                            <div class="wigdet-two-content media-body text-end text-truncate">
                                <p class="m-0 text-uppercase fw-medium text-truncate" title="Statistics">Total Revenue</p>
                                <h3 class="fw-medium my-2">$ <span data-plugin="counterup">65,841</span></h3>
                                <p class="m-0">Jan - Apr 2019</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Unique Visitors -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                            </div>

                            <div class="wigdet-two-content media-body text-end text-truncate">
                                <p class="m-0 text-uppercase fw-medium text-truncate" title="Statistics">Total Unique Visitors</p>
                                <h3 class="fw-medium my-2"> <span data-plugin="counterup">26,521</span></h3>
                                <p class="m-0">Jan - Apr 2019</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Number of Transactions -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                <i class="mdi mdi-crown avatar-title font-30 text-white"></i>
                            </div>

                            <div class="wigdet-two-content media-body text-end text-truncate">
                                <p class="m-0 text-uppercase fw-medium text-truncate" title="Statistics">Number of Transactions</p>
                                <h3 class="fw-medium my-2"><span data-plugin="counterup">7,842</span></h3>
                                <p class="m-0">Jan - Apr 2019</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conversation Rate -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                <i class="mdi mdi-auto-fix  avatar-title font-30 text-white"></i>
                            </div>

                            <div class="wigdet-two-content media-body text-end text-truncate">
                                <p class="m-0 text-uppercase fw-medium text-truncate" title="Statistics">Conversation Rate</p>
                                <h3 class="fw-medium my-2"><span data-plugin="counterup">2.07</span>%</h3>
                                <p class="m-0">Jan - Apr 2019</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- Revenue Comparison, Visitors Overview, Goal Completion -->
        <div class="row">
            <!-- Revenue Comparison -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Revenue Comparison</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="fw-normal text-muted">You have to pay</h5>
                            <h3 class="mb-3 fw-semibold"><i class="mdi mdi-arrow-up-bold-hexagon-outline text-success"></i> 25643 <small>USD</small></h3>
                        </div>

                        <div class="chart-container" dir="ltr">
                            <div class="" style="height:280px" id="platform_type_dates_donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visitors Overview -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Visitors Overview</h4>
                    </div>

                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="fw-normal text-muted">You have to pay</h5>
                            <h3 class="mb-3 fw-semibold"><i class="mdi mdi-arrow-down-bold-hexagon-outline text-danger"></i> 5623 <small>USD</small></h3>
                        </div>

                        <div class="chart-container" dir="ltr">
                            <div class="" style="height:280px" id="user_type_bar"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goal Completion -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Goal Completion</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="fw-normal text-muted">You have to pay</h5>
                            <h3 class="mb-3 fw-semibold"><i class="mdi mdi-arrow-up-bold-hexagon-outline text-success"></i> 12548 <small>USD</small></h3>
                        </div>

                        <div class="chart-container" dir="ltr">
                            <div class="chart has-fixed-height" style="height:280px" id="page_views_today"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- Recent Candidates, Unique Visitors, Transactions -->
        <div class="row">
            <!-- Recent Candidates -->
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Recent Candidates</h4>
                        <p class="card-subtitle">Your awesome text goes here.</p>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table table-hover m-0 table-actions-bar">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="btn-group dropdown">
                                                <button type="button" class="btn btn-light btn-xs dropdown-toggle waves-effect waves-light drop-arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                                </div>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Job Timing</th>
                                        <th>Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 fw-medium">Tomaslau</h5>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-map-marker text-primary"></i> New York
                                        </td>
                                        <td>
                                            <i class="mdi mdi-clock-outline text-success"></i> Full Time
                                        </td>
                                        <td>
                                            <i class="mdi mdi-currency-usd text-warning"></i> 3265
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn-light">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-4.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 fw-medium">Chad Stein</h5>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-map-marker text-primary"></i> Paris
                                        </td>
                                        <td>
                                            <i class="mdi mdi-clock-outline text-danger"></i> Part Time
                                        </td>
                                        <td>
                                            <i class="mdi mdi-currency-usd text-warning"></i> 2560
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn-light">View</button>
                                        </td>
                                    </tr>
                                    <!-- More rows can be added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unique Visitors -->
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Unique Visitors</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table table-hover m-0 table-actions-bar">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Location</th>
                                        <th>Visits</th>
                                        <th>Device</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-5.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 fw-medium">John Doe</h5>
                                        </td>
                                        <td>12</td>
                                        <td>
                                            <i class="mdi mdi-laptop text-success"></i>
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn-light">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-7.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 fw-medium">Jane Smith</h5>
                                        </td>
                                        <td>8</td>
                                        <td>
                                            <i class="mdi mdi-phone text-warning"></i>
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn-light">View</button>
                                        </td>
                                    </tr>
                                    <!-- More rows can be added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
