@extends('layouts.layout')

@section('title', 'Hotels')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
@endsection
<x-alert />
@section('content')
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white; margin-top: 10px !important;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add New Hotel</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="hotelForm" method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Hotel Name -->
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Hotel Name</strong></label>
                                <input type="text" class="form-control" id="input35" name="name" placeholder="Enter Hotel Name" required>
                            </div>

                            <!-- Category Type -->
                            <div class="mb-3">
                                <label for="category_type" class="form-label"><strong>Category Type</strong></label>
                                <select id="category_type" name="category_type" class="form-control" required>
                                    <option value="">Select Category Type</option>
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option>No categories available</option>
                                    @endforelse
                                </select>
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label"><strong>Address</strong></label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                            </div>

                            <!-- City -->
                            <div class="mb-3">
                                <label for="city" class="form-label"><strong>City</strong></label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                            </div>

                            <!-- State -->
                            <div class="mb-3">
                                <label for="state" class="form-label"><strong>State</strong></label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" required>
                            </div>

                            <!-- Country -->
                            <div class="mb-3">
                                <label for="country" class="form-label"><strong>Country</strong></label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" required>
                            </div>

                            <!-- Zip code -->
                            <div class="mb-3">
                                <label for="pincode" class="form-label"><strong>Zip Code</strong></label>
                                <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Enter Zip Code" required>
                            </div>

                            <!-- Latitude and Longitude -->
                            <div class="mb-3">
                                <label for="latitude" class="form-label"><strong>Latitude</strong></label>
                                <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude">
                            </div>
                            <div class="mb-3">
                                <label for="longitude" class="form-label"><strong>Longitude</strong></label>
                                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude">
                            </div>

                            <!-- Main Image -->
                            <div class="mb-3">
                                <label for="main_image" class="form-label"><strong>Banner Image</strong></label>
                                <input type="file" class="form-control" id="main_image" name="main_image" required>
                            </div>

                            <!-- Check in and Check out time -->
                            <div class="mb-3">
                                <label for="check_in_time" class="form-label"><strong>Check in Time</strong></label>
                                <input type="time" class="form-control" id="check_in_time" name="check_in_time">
                            </div>
                            <div class="mb-3">
                                <label for="check_out_time" class="form-label"><strong>Check out Time</strong></label>
                                <input type="time" class="form-control" id="check_out_time" name="check_out_time">
                            </div>

                            <!-- Additional Fields (Phone, Email, etc.) -->
                            <div class="mb-3">
                                <label for="hotel_owner_company_name" class="form-label"><strong>Hotel Owner Company Name</strong></label>
                                <input type="text" class="form-control" id="hotel_owner_company_name" name="hotel_owner_company_name" placeholder="Enter Hotel Owner Company Name">
                            </div>

                            <div class="mb-3">
                                <label for="management_comp_name" class="form-label"><strong>Management Company Name</strong></label>
                                <input type="text" class="form-control" id="management_comp_name" name="management_comp_name" placeholder="Enter Management Company Name">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label"><strong>Phone</strong></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label"><strong>Email</strong></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                            </div>

                            <!-- Additional Images -->
                            <div class="mb-3">
                                <label for="images" class="form-label"><strong>Additional Images</strong></label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label"><strong>Description</strong></label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                            </div>

                            <!-- Policies -->
                            <div class="mb-3">
                                <label for="policies" class="form-label"><strong>Policies</strong></label>
                                <input type="text" class="form-control" id="policies" name="policies" placeholder="Enter Policies">
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label"><strong>Status</strong></label>
                                <select name="hotel_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <!-- Submit and Reset Buttons -->
                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Save and Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
