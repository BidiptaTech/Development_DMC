@extends('layouts.layout')
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
.facility-group {
    display: flex;
    flex-direction: column;
    gap: 10px;  
}
.facility-group .form-control {
    width: 100%;  
}
.remove-facility {
    margin-top: 10px;  /* Adds space from the input field above */
    align-self: flex-start;  /* Ensures the button stays aligned at the left */
}
#add-facility {
    margin-top: 15px;  /* Adds a little more spacing above the "Add More" button */
}
</style>
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
                <ul class="nav nav-pills mb-4 mt-4 d-flex justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-hotel-tab" data-bs-toggle="pill" href="{{ route('hotels.create') }}" 
                            role="tab" aria-controls="pills-hotel" aria-selected="true">
                            Hotel Details
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="pills-contact-tab" href="#" 
                            role="tab" aria-controls="pills-contact" aria-selected="false" tabindex="-1">
                            Contact Details
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="pills-room-tab" href="#" 
                            role="tab" aria-controls="pills-room" aria-selected="false" tabindex="-1">
                            Room Details
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="pills-season-tab" href="#" 
                            role="tab" aria-controls="pills-season" aria-selected="false" tabindex="-1">
                            Season Details
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="pills-event-tab" href="#" 
                            role="tab" aria-controls="pills-event" aria-selected="false" tabindex="-1">
                            Event Details
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="pills-calendar-tab" href="#" 
                            role="tab" aria-controls="pills-calendar" aria-selected="false" tabindex="-1">
                            Calendar
                        </a>
                    </li>
                </ul>



                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
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
                            <div class="row">
                                <!-- Hotel Name -->
                                <div class="mb-3 col-md-4">
                                    <label for="input35" class="form-label"><strong>Hotel Name</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="input35" name="name" placeholder="Enter Hotel Name" required>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Category Type -->
                                <div class="mb-3 col-md-4">
                                    <label for="category_type" class="form-label"><strong>Category Type</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <select id="category_type" name="category_type" class="form-control" required>
                                        <option value="">Select Category Type</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                        @empty
                                            <option>No categories available</option>
                                        @endforelse
                                    </select>
                                    @error('category_type')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="phone" class="form-label"><strong>Phone</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required>
                                    @error('phone')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="email" class="form-label"><strong>Email</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="mb-3 col-md-4">
                                    <label for="address" class="form-label"><strong>Address</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                                    @error('address')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="mb-3 col-md-4">
                                    <label for="city" class="form-label"><strong>City</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                                    @error('city')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div class="mb-3 col-md-4">
                                    <label for="state" class="form-label"><strong>State/Provision</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" required>
                                    @error('state')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div class="mb-3 col-md-4">
                                    <label for="country" class="form-label"><strong>Country</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" required>
                                    @error('country')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Zip code -->
                                <div class="mb-3 col-md-4">
                                    <label for="pincode" class="form-label"><strong>Postal Code</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Enter Postal Code" required>
                                    @error('pincode')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Latitude and Longitude -->
                                <div class="mb-3 col-md-4">
                                    <label for="latitude" class="form-label"><strong>Latitude</strong>
                                    <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude">
                                    @error('latitude')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="longitude" class="form-label"><strong>Longitude</strong></label>
                                    <span style="color: red; font-weight: bold;">*</span>
                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude">
                                    @error('longitude')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Main Image -->
                                <div class="mb-3 col-md-4">
                                    <label for="main_image" class="form-label"><strong>Banner Image</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="main_image" name="main_image" required>
                                    @error('main_image')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Check in and Check out time -->
                                <div class="mb-3 col-md-4">
                                    <label for="check_in_time" class="form-label"><strong>Check in Time</strong>
                                    <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="time" class="form-control" id="check_in_time" name="check_in_time">
                                    @error('check_in_time')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="check_out_time" class="form-label"><strong>Check out Time</strong>
                                    <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="time" class="form-control" id="check_out_time" name="check_out_time">
                                    @error('check_out_time')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Additional Fields (Phone, Email, etc.) -->
                                <div class="mb-3 col-md-4">
                                    <label for="infant_age_limit" class="form-label"><strong>Infrant Upper Age Limit</strong></label>
                                    <input type="number" class="form-control" id="infant_age_limit" name="infant_age_limit" placeholder="Enter Hotel Owner Company Name">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="child_age_limit" class="form-label"><strong>Child Upper Age Limit</strong></label>
                                    <input type="number" class="form-control" id="child_age_limit" name="child_age_limit" placeholder="Enter Hotel Owner Company Name">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="weekend_days" class="form-label"><strong>Weekend Days</strong></label>
                                    <select name="weekend_days[]" id="weekend_days" class="form-control" multiple required>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Monday">Monday</option>
                                    </select>
                                    <small class="form-text text-muted">Select the weekend days (use Ctrl or Cmd to select multiple days).</small>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="hotel_owner_company_name" class="form-label"><strong>Hotel Owner Company Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="text" class="form-control" id="hotel_owner_company_name" name="hotel_owner_company_name" placeholder="Enter Hotel Owner Company Name" required>
                                    @error('hotel_owner_company_name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="management_comp_name" class="form-label"><strong>Management Company Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="text" class="form-control" id="management_comp_name" name="management_comp_name" placeholder="Enter Management Company Name" required>
                                    @error('management_comp_name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Additional Images -->
                                <div class="mb-3 col-md-4">
                                    <label for="images" class="form-label"><strong>Additional Images</strong></label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                </div>

                                <!-- 12 hours booking -->
                                <div class="mb-3 col-md-4">
                                    <label for="date_range" class="form-label"><strong>Day Use Range</strong></label>
                                    <div class="input-group">
                                        <input type="text" id="date_range" name="date_range" class="form-control" placeholder="Select date range">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="12_hours_booking_price" class="form-label"><strong>Day Usage Price</strong></label>
                                    <input type="number" name="twelve_hours_booking_price" id="twelve_hours_booking_price" class="form-control" placeholder="Enter price">
                                </div>

                                <!-- Description -->
                                <div class="mb-3 col-md-4">
                                    <label for="description" class="form-label"><strong>Description</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter Description" required></textarea>
                                    @error('description')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Policies -->
                                <div class="mb-3 col-md-4">
                                    <label for="policies" class="form-label"><strong>Policies</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <textarea class="form-control" id="policies" name="policies" rows="4" placeholder="Enter Policies"></textarea>
                                    @error('policies')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="facilities" class="form-label"><strong>Facilities</strong></label>
                                    <div id="facilities-container">
                                        <!-- Initial Facility Group -->
                                        <div class="facility-group mb-3 d-flex flex-column">
                                            <div class="d-flex flex-column mb-2">
                                                <select id="selectFacility" class="form-control" name="facilities[]">
                                                    <option value="0">Select facility</option>
                                                    @foreach ($facilities as $facility)
                                                        <option value="{{$facility->id}}">{{ $facility->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-flex flex-column mb-2">
                                                <input type="file" name="facility_images[0][]" multiple class="form-control">
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm remove-facility ms-2 mt-2">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-facility" class="btn btn-sm btn-primary mt-2">Add More Facility</button>
                                </div>

                            <!-- key locations -->
                            <b>Port of Entry & Port of Exit & Others</b>
                            <hr>
                            <!-- Port of Entry Section -->
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="port_of_entry" class="form-check-input">
                                        <label class="form-check-label" for="port_of_entry"><strong>Enable Port of Entry</strong></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Port of Entry Conditional Fields (Initially Hidden) -->
                            <div id="entry_fields_container" style="display: none;">
                                <div class="row">
                                    <!-- Port Name Select Box -->
                                    <div class="mb-3 col-md-3">
                                        <label for="port_name" class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <select id="port_name" name="port_name[]" class="form-control port-name-select">
                                            <option value="">Select a Port</option>
                                            <option value="Airport">Airport</option>
                                            <option value="Seaport">Seaport</option>
                                            <option value="LandPort">Land Border Crossing</option>
                                            <option value="Railway">Railway</option>
                                            <option value="BusStand">Bus Stand</option>
                                        </select>
                                    </div>

                                    <!-- Latitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="latitude" class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="latitudentry[]" class="form-control" placeholder="Enter Latitude">
                                    </div>

                                    <!-- Longitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="longitude" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="longitudeentry[]" class="form-control" placeholder="Enter Longitude">
                                    </div>

                                    <!-- Distance Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="distance" class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="distanceentry[]" class="form-control" placeholder="Enter Distance">
                                    </div>

                                </div>

                                <!-- Add More Button for Port of Entry -->
                                <div id="entry_key_locations">
                                    <div id="entry_locations-additional-fields"></div>
                                    <div class="mb-3 col-md-3">
                                        <button type="button" id="entry-locations-add-more" class="btn btn-primary">Add More</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Port of Exit Section -->
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" id="port_of_exit" class="form-check-input">
                                        <label class="form-check-label" for="port_of_exit"><strong>Enable Port of Exit</strong></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Port of Exit Conditional Fields (Initially Hidden) -->
                            <div id="exit_fields_container" style="display: none;">
                                <div class="row">
                                    <!-- Port Name Select Box -->
                                    <div class="mb-3 col-md-3">
                                        <label for="port_name" class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <select id="port_name" name="exit_port_name[]" class="form-control port-name-select">
                                            <option value="">Select a Port</option>
                                            <option value="Airport">Airport</option>
                                            <option value="Seaport">Seaport</option>
                                            <option value="LandPort">Land Border Crossing</option>
                                            <option value="Railway">Railway</option>
                                            <option value="BusStand">Bus Stand</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Latitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="exit_latitude" class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="exit_latitude[]" class="form-control" placeholder="Enter Latitude">
                                    </div>

                                    <!-- Longitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="exit_longitude" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="exit_longitude[]" class="form-control" placeholder="Enter Longitude">
                                    </div>

                                    <!-- Distance Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="exit_distance" class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="exit_distance[]" class="form-control" placeholder="Enter Distance">
                                    </div>

                                    <div class="mb-3 col-md-3 others-input-container" style="display: none;">
                                        <label for="port_name_others" class="form-label"><strong>Specify Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" id="port_name_others" name="exit_name_others[]" class="form-control" placeholder="Enter Port Name">
                                    </div>
                                </div>

                                <!-- Add More Button for Port of Exit -->
                                <div id="exit_key_locations">
                                    <div id="exit_locations-additional-fields"></div>
                                    <div class="mb-3 col-md-4">
                                        <button type="button" id="exit-locations-add-more" class="btn btn-primary">Add More</button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Others Section -->
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="others" class="form-check-input">
                                        <label class="form-check-label" for="others"><strong>Enable Others</strong></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Others Conditional Fields (Initially Hidden) -->
                            <div id="others_fields_container" style="display: none;">
                                <div class="row">
                                    <!-- Port Name Select Box -->
                                    <div class="mb-3 col-md-3">
                                        <label for="others_port_name" class="form-label"><strong>Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <select id="others_port_name" name="others_port_name[]" class="form-control port-name-select">
                                            <option value="">Select One</option>
                                            <option value="CityCenter">City Center</option>
                                            <option value="Seaport">Seaport</option>
                                            <option value="LandPort">Land Border Crossing</option>
                                            <option value="Railway">Railway</option>
                                            <option value="BusStand">Bus Stand</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <!-- Latitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="others_latitude" class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="others_latitude[]" class="form-control" placeholder="Enter Latitude">
                                    </div>

                                    <!-- Longitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="others_longitude" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="others_longitude[]" class="form-control" placeholder="Enter Longitude">
                                    </div>

                                    <!-- Distance Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="others_distance" class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="others_distance[]" class="form-control" placeholder="Enter Distance">
                                    </div>

                                    <!-- Specify Port Name (Others) -->
                                    <div class="mb-3 col-md-3 others-input-container" style="display: none;">
                                        <label for="others_name_others" class="form-label"><strong>Specify Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" id="others_name_others" name="others_name_others[]" class="form-control" placeholder="Enter Port Name">
                                    </div>
                                </div>

                                <!-- Add More Button for Others -->
                                <div id="others_key_locations">
                                    <div id="others_locations-additional-fields"></div>
                                    <div class="mb-3 col-md-4">
                                        <button type="button" id="others-locations-add-more" class="btn btn-primary">Add More</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Conference Room Availability -->
                            <b>Conference Room Availability</b>
                            <hr>
                            <div class="mb-3 col-md-4">
                                <label for="conference" class="form-label"><strong>Conference Room</strong><span style="color: red; font-weight: bold;">*</span></label>
                                <select name="conference" id="conference" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="0">Not Available</option>
                                    <option value="1">Available</option>
                                </select>
                            </div>

                            <!-- <div class="row" id="conference-options" style="display: none;">
                                <div class="mb-3 col-md-4">
                                    <label for="conference_head" class="form-label"><strong>Head</strong></label>
                                    <input type="text" class="form-control" name="conference_head[]" placeholder="Enter Head">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="conference_duration" class="form-label"><strong>Duration</strong></label>
                                    <input type="text" class="form-control" name="conference_duration[]" placeholder="Enter Duration">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="conference_price" class="form-label"><strong>Price</strong></label>
                                    <input type="number" class="form-control" name="conference_price[]" placeholder="Enter Price">
                                </div>
                                <div id="conference-additional-fields"></div>
                                <div class="mb-3 col-md-4">
                                    <button type="button" id="conference-add-more" class="btn btn-primary">Add More</button>
                                </div>
                            </div> -->

                            <!-- Cancellation Details -->
                            <b>Cancellation Details</b>
                            <hr>
                            <div class="mb-3 col-md-4">
                                <label for="cancellation_type" class="form-label"><strong>Cancellation Type</strong><span style="color: red; font-weight: bold;">*</span></label>
                                <select name="cancellation_type" id="cancellation_type" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="0">Free</option>
                                    <option value="1">Chargeable</option>
                                </select>
                            </div>

                            <div class="row" id="cancellation-options" style="display: none;">
                                <div class="mb-3 col-md-6">
                                    <label for="cancellation_duration" class="form-label"><strong>Duration</strong></label>
                                    <input type="text" class="form-control" name="cancellation_duration[]" placeholder="Enter Duration">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="cancellation_price" class="form-label"><strong>Price</strong></label>
                                    <input type="number" class="form-control" name="cancellation_price[]" placeholder="Enter Price">
                                </div>
                                <div id="cancellation-additional-fields"></div>
                                <div class="mb-3 col-md-4">
                                    <button type="button" id="cancellation-add-more" class="btn btn-primary">Add More</button>
                                </div>
                            </div>


                            <div class="form-check form-switch">
                                <label for="hotel_status" class="form-label"><strong>Status</strong><span style="color: red; font-weight: bold;">*</span></label>
                                <input type="hidden" name="hotel_status" value="0">
                                <input class="form-check-input" name="hotel_status" type="checkbox" id="hotel_status" value="1" required>
                                <label class="form-check-label"></label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Save and Next</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#hotelName').select2({
            placeholder: 'Search for a hotel...', 
            ajax: {
                url: '{{ route("hotels.search") }}', 
                type: 'GET',
                dataType: 'json',
                delay: 20, 
                data: function (params) {
                    return {
                        query: params.term 
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (hotel) {
                            return {
                                id: hotel.id, 
                                text: `${hotel.name} - ${hotel.city || 'No Location'}` 
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 1 
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#weekend_days').select2({
            placeholder: "Select weekend days",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function () {
    // Conference Room Logic
    $('#conference').on('change', function () {
        if ($(this).val() == '1') {
            $('#conference-options').show();
        } else {
            $('#conference-options').hide();
            $('#conference-additional-fields').empty();
        }
    });

    $('#conference-add-more').on('click', function () {
        const newConferenceFields = `
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="conference_head" class="form-label"><strong>Head</strong></label>
                    <input type="text" class="form-control" name="conference_head[]" placeholder="Enter Head">
                </div>
                <div class="col-md-4">
                    <label for="conference_duration" class="form-label"><strong>Duration</strong></label>
                    <input type="text" class="form-control" name="conference_duration[]" placeholder="Enter Duration">
                </div>
                <div class="col-md-4">
                    <label for="conference_price" class="form-label"><strong>Price</strong></label>
                    <input type="number" class="form-control" name="conference_price[]" placeholder="Enter Price">
                </div>
            </div>
        `;
        $('#conference-additional-fields').append(newConferenceFields);
    });
    // Cancellation Details Logic
    $('#cancellation_type').on('change', function () {
        if ($(this).val() == '1') {
            $('#cancellation-options').show();
        } else {
            $('#cancellation-options').hide();
            $('#cancellation-additional-fields').empty();
        }
    });

    $('#cancellation-add-more').on('click', function () {
        const newCancellationFields = `
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cancellation_duration" class="form-label"><strong>Duration</strong></label>
                    <input type="text" class="form-control" name="cancellation_duration[]" placeholder="Enter Duration">
                </div>
                <div class="col-md-6">
                    <label for="cancellation_price" class="form-label"><strong>Price</strong></label>
                    <input type="number" class="form-control" name="cancellation_price[]" placeholder="Enter Price">
                </div>
            </div>
        `;
        $('#cancellation-additional-fields').append(newCancellationFields);
    });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const portOfEntryCheckbox = document.getElementById('port_of_entry');
        const entryFields = document.getElementById('entry_fields');

        // Toggle fields on checkbox change
        portOfEntryCheckbox.addEventListener('change', function () {
            if (this.checked) {
                entryFields.style.display = 'flex'; // Show fields
            } else {
                entryFields.style.display = 'none'; // Hide fields
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle Port of Entry Toggle
        const portOfEntryCheckbox = document.getElementById('port_of_entry');
        const entryFieldsContainer = document.getElementById('entry_fields_container');

        portOfEntryCheckbox.addEventListener('change', function () {
            entryFieldsContainer.style.display = this.checked ? 'block' : 'none';
        });

        // Handle Add More for Port of Entry
        const entryAddMoreButton = document.getElementById('entry-locations-add-more');
        const entryAdditionalFieldsContainer = document.getElementById('entry_locations-additional-fields');

        const addEntryField = () => {
            const newEntryContainer = document.createElement('div');
            newEntryContainer.classList.add('mt-3', 'border', 'p-3');
            const uniqueId = `entry_checkbox_${Date.now()}`;
            newEntryContainer.innerHTML = `
                <div class="form-check">
                    <input type="checkbox" class="form-check-input entry-checkbox" id="${uniqueId}">
                    <label class="form-check-label" for="${uniqueId}">Enable Additional Input</label>
                </div>
                <div class="entry-input-fields mt-3" style="display: none;">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                            <select name="port_name[]" class="form-control port-name-select">
                                <option value="">Select a Port</option>
                                <option value="Airport">Airport</option>
                                <option value="Seaport">Seaport</option>
                                <option value="LandPort">Land Border Crossing</option>
                                <option value="Railway">Railway</option>
                                <option value="BusStand">Bus Stand</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                            <input type="text" name="latitudentry[]" class="form-control" placeholder="Enter Latitude">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                            <input type="text" name="longitudeentry[]" class="form-control" placeholder="Enter Longitude">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                            <input type="text" name="distanceentry[]" class="form-control" placeholder="Enter Distance">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger delete-entry">Delete</button>
                </div>
            `;
            entryAdditionalFieldsContainer.appendChild(newEntryContainer);

            // Handle "Others" Field Visibility
            const portNameSelect = newEntryContainer.querySelector('.port-name-select');
            const othersInputContainer = newEntryContainer.querySelector('.others-input-container');
            portNameSelect.addEventListener('change', function () {
                othersInputContainer.style.display = this.value === 'Others' ? 'block' : 'none';
            });

            // Handle Checkbox Toggle
            const newCheckbox = newEntryContainer.querySelector('.entry-checkbox');
            const inputFields = newEntryContainer.querySelector('.entry-input-fields');
            newCheckbox.addEventListener('change', function () {
                inputFields.style.display = this.checked ? 'block' : 'none';
            });

            // Handle Delete Button
            const deleteButton = newEntryContainer.querySelector('.delete-entry');
            deleteButton.addEventListener('click', function () {
                newEntryContainer.remove();
            });
        };

        entryAddMoreButton.addEventListener('click', addEntryField);

        // Repeat similar logic for Port of Exit
        const portOfExitCheckbox = document.getElementById('port_of_exit');
        const exitFieldsContainer = document.getElementById('exit_fields_container');

        portOfExitCheckbox.addEventListener('change', function () {
            exitFieldsContainer.style.display = this.checked ? 'block' : 'none';
        });

        const exitAddMoreButton = document.getElementById('exit-locations-add-more');
        const exitAdditionalFieldsContainer = document.getElementById('exit_locations-additional-fields');

        const addExitField = () => {
            const newExitContainer = document.createElement('div');
            newExitContainer.classList.add('mt-3', 'border', 'p-3');
            const uniqueId = `exit_checkbox_${Date.now()}`;
            newExitContainer.innerHTML = `
                <div class="form-check">
                    <input type="checkbox" class="form-check-input exit-checkbox" id="${uniqueId}">
                    <label class="form-check-label" for="${uniqueId}">Enable Additional Input</label>
                </div>
                <div class="exit-input-fields mt-3" style="display: none;">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                            <select name="exit_port_name[]" class="form-control port-name-select">
                                <option value="">Select a Port</option>
                                <option value="Airport">Airport</option>
                                <option value="Seaport">Seaport</option>
                                <option value="LandPort">Land Border Crossing</option>
                                <option value="Railway">Railway</option>
                                <option value="BusStand">Bus Stand</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                            <input type="text" name="exit_latitude[]" class="form-control" placeholder="Enter Latitude">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                            <input type="text" name="exit_longitude[]" class="form-control" placeholder="Enter Longitude">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                            <input type="text" name="exit_distance[]" class="form-control" placeholder="Enter Distance">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger delete-exit">Delete</button>
                </div>
            `;
            exitAdditionalFieldsContainer.appendChild(newExitContainer);

            // Handle "Others" Field Visibility
            const portNameSelect = newExitContainer.querySelector('.port-name-select');
            const othersInputContainer = newExitContainer.querySelector('.others-input-container');
            portNameSelect.addEventListener('change', function () {
                othersInputContainer.style.display = this.value === 'Others' ? 'block' : 'none';
            });

            // Handle Checkbox Toggle
            const newCheckbox = newExitContainer.querySelector('.exit-checkbox');
            const inputFields = newExitContainer.querySelector('.exit-input-fields');
            newCheckbox.addEventListener('change', function () {
                inputFields.style.display = this.checked ? 'block' : 'none';
            });

            // Handle Delete Button
            const deleteButton = newExitContainer.querySelector('.delete-exit');
            deleteButton.addEventListener('click', function () {
                newExitContainer.remove();
            });
        };

        exitAddMoreButton.addEventListener('click', addExitField);
    });
</script>

<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function () {
        $('#date_range').daterangepicker({
            opens: 'right', // Opens to the right of the input
            autoApply: true, // Automatically apply the selected range
            locale: {
                format: 'MM/DD/YYYY', // Format of the dates
                separator: ' - ', // Separator between start and end dates
                applyLabel: "Apply",
                cancelLabel: "Clear"
            }
        });
        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>
<script>
    // Toggle visibility for Others fields
    document.getElementById('others').addEventListener('change', function() {
        const othersFieldsContainer = document.getElementById('others_fields_container');
        othersFieldsContainer.style.display = this.checked ? 'block' : 'none';
    });

    // Show/hide "Specify Port Name" field based on "Other" selection in Port Name dropdown
    document.getElementById('others_port_name').addEventListener('change', function() {
        const othersInputContainer = document.querySelector('.others-input-container');
        othersInputContainer.style.display = this.value === 'Other' ? 'block' : 'none';
    });

    // Add More functionality for Others section
    document.getElementById('others-locations-add-more').addEventListener('click', function() {
        const container = document.getElementById('others_locations-additional-fields');
        const newFields = `
            <div class="row">
                <div class="mb-3 col-md-3">
                    <label for="others_port_name" class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <select name="others_port_name[]" class="form-control port-name-select">
                        <option value="">Select a Port</option>
                        <option value="Airport">Airport</option>
                        <option value="Seaport">Seaport</option>
                        <option value="LandPort">Land Border Crossing</option>
                        <option value="Railway">Railway</option>
                        <option value="BusStand">Bus Stand</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3 col-md-3">
                    <label for="others_latitude" class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="others_latitude[]" class="form-control" placeholder="Enter Latitude">
                </div>

                <div class="mb-3 col-md-3">
                    <label for="others_longitude" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="others_longitude[]" class="form-control" placeholder="Enter Longitude">
                </div>

                <div class="mb-3 col-md-3">
                    <label for="others_distance" class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="others_distance[]" class="form-control" placeholder="Enter Distance">
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newFields);
    });
</script>

<script>
    const facilityElement = document.getElementById("selectFacility");
    const facilityImageElement = document.getElementById("facilityImage");
    facilityElement.addEventListener('change', function(e) {
        if (e.target.value != 0) {
            facilityImageElement.style.display = "block";  // Show the file input if facility is selected
        } else {
            facilityImageElement.style.display = "none";  // Hide if no facility is selected
        }
    });
    document.getElementById('add-facility').addEventListener('click', () => {
        const container = document.getElementById('facilities-container');
        const facilityCount = container.querySelectorAll('.facility-group').length;
        const newGroup = document.createElement('div');
        newGroup.classList.add('facility-group', 'mb-3', 'd-flex', 'flex-column');
        newGroup.innerHTML = `
            <div class="d-flex flex-column mb-2">
                <select class="form-control" name="facilities[]">
                    <option value="0">Select facility</option>
                    @foreach ($facilities as $facility)
                        <option value="{{$facility->id}}">{{ $facility->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-column mb-2">
                <input type="file" name="facility_images[${facilityCount}][]" multiple class="form-control">
            </div>
            <button type="button" class="btn btn-danger btn-sm remove-facility ms-2 mt-2">Remove</button>
        `;
        container.appendChild(newGroup);
        newGroup.querySelector('.remove-facility').addEventListener('click', (e) => {
            e.target.closest('.facility-group').remove();  // Remove the facility group when clicked
            disableSelectedOptions();  // Re-enable the disabled options after removal
        });
        disableSelectedOptions();
    });
    document.querySelectorAll('.remove-facility').forEach(button => {
        button.addEventListener('click', (e) => {
            e.target.closest('.facility-group').remove();  // Remove the facility group when clicked
            disableSelectedOptions();  // Re-enable the disabled options after removal
        });
    });
    function disableSelectedOptions() {
        const allFacilitySelects = document.querySelectorAll('select[name="facilities[]"]');
        const selectedValues = Array.from(allFacilitySelects).map(select => select.value);
        allFacilitySelects.forEach(function(select) {
            const options = select.querySelectorAll('option');
            options.forEach(function(option) {
                option.disabled = false;
            });
        });
        selectedValues.forEach(function(value) {
            if (value != '0') {  
                allFacilitySelects.forEach(function(select) {
                    const options = select.querySelectorAll('option');
                    options.forEach(function(option) {
                        if (option.value == value) {
                            option.disabled = true;  // Disable the selected option
                        }
                    });
                });
            }
        });
    }
    disableSelectedOptions();
</script>


@endsection