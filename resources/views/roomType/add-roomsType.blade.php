@extends('layouts.layout')
@section('content')


<!-- Start of the form -->
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add New Room Type</h5>
                            <!-- Back Button -->
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                        
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('roomType.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf 

                            <div class="mb-3">
                                <label for="hotelName" class="form-label"><strong>Hotel Name</strong></label>
                                <select id="hotelName" name="hotel_id" class="form-control" required>
                                    <option value="">Search for a hotel...</option>
                                </select>
                            </div>
                            

                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Room Type Name</strong></label>
                                <input type="text" id="roomType" name="roomType" placeholder="Enter Room Type Name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="breakfast" class="form-label"><strong>Breakfast</strong></label>
                                <select name="breakfast" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lunch" class="form-label"><strong>Lunch</strong></label>
                                <select name="lunch" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="dinner" class="form-label"><strong>Dinner</strong></label>
                                <select name="dinner" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="extra_bed" class="form-label"><strong>Extra Bed</strong></label>
                                <select name="extra_bed" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                            
                            <!-- Facilities Selection (loaded dynamically) -->
                            <div class="mb-3">
                                <label for="facilities" class="form-label"><strong>Select Facilities</strong></label>
                                <div id="facilities-container" class="d-flex flex-wrap">
                                    <!-- Facilities will be appended here dynamically -->
                                    <p class="text-muted" id="no-facilities-msg">Enter a valid Hotel ID to load facilities</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label"><strong>Room Type Name</strong></label>
                                <input type="text" id="description" name="description" placeholder="Enter Room Description" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="room_status" class="form-label"><strong>Status</strong></label>
                                <select id="room_status" name="room_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of the form -->



@endsection
