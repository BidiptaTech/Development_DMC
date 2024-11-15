@extends('layouts.layout')

@section('title', 'Hotels')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
@endsection

@section('content')
<!-- Start of the form -->
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add New Hotel</h5>
                            <!-- Back Button -->
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="hotelForm" method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="input35" class="col-sm-3 col-form-label">Enter Hotel Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="input35" name="name" placeholder="Enter Hotel Name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address" placeholder="Enter Address" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37a" class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="city" placeholder="Enter City" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37a" class="col-sm-3 col-form-label">State</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="state" placeholder="Enter State" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37a" class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="country" placeholder="Enter Country" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Zip code</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="pincode" placeholder="Enter Zip Code" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Latitude</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="latitude" placeholder="Enter Latitude" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Longitude</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="longitude" placeholder="Enter Longitude" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Banner Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="main_image" placeholder="Enter Banner Image" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Check in time</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" name="check_in_time" placeholder="Enter Check in time" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Check out time</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" name="check_out_time" placeholder="Enter Check out time" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Hotel owner company name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="hotel_owner_company_name" placeholder="Enter Hotel owner company name" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone" placeholder="Enter phone" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" placeholder="Enter Email" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Images</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="images" multiple>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description" placeholder="Enter Description" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Policies</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="policies" placeholder="Enter Policies" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Management comp name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="management_comp_name" placeholder="Enter Management comp name" >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" id="input37">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4" name="submit2">Save and Next</button>
                                        <button type="reset" class="btn btn-secondary px-4">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
