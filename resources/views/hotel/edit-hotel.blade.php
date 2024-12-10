@extends('layouts.layout')
@section('title', 'Edit Hotel')
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Hotel</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="hotelForm" method="POST" action="{{ route('hotels.update', $hotel->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Hotel Name -->
                                <div class="mb-3 col-md-4">
                                    <label for="input35" class="form-label"><strong>Hotel Name</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="input35" name="name" value="{{ old('name', $hotel->name) }}" placeholder="Enter Hotel Name" required>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="input35" class="form-label"><strong>Hotel Unique Id</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="input35" name="unique_id" value="{{ old('name', $hotel->hotel_unique_id) }}" placeholder="Enter Hotel Name" disabled>
                                    @error('unique_id')
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
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_type', $hotel->cat_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_type')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="phone" class="form-label"><strong>Phone</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $hotel->phone) }}" placeholder="Enter Phone" required>
                                    @error('phone')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="email" class="form-label"><strong>Email</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $hotel->email) }}" placeholder="Enter Email" required>
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="mb-3 col-md-4">
                                    <label for="address" class="form-label"><strong>Address</strong>
                                    <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $hotel->address) }}" placeholder="Enter Address" required>
                                    @error('address')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="mb-3 col-md-4">
                                    <label for="city" class="form-label"><strong>City</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $hotel->city) }}" placeholder="Enter City" required>
                                    @error('city')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div class="mb-3 col-md-4">
                                    <label for="state" class="form-label"><strong>State/Provision</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $hotel->state) }}" placeholder="Enter State" required>
                                    @error('state')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div class="mb-3 col-md-4">
                                    <label for="country" class="form-label"><strong>Country</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $hotel->country) }}" placeholder="Enter Country" required>
                                    @error('country')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Zip code -->
                                <div class="mb-3 col-md-4">
                                    <label for="pincode" class="form-label"><strong>Postal Code</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="pincode" name="pincode" value="{{ old('zipcode', $hotel->zipcode) }}" placeholder="Enter Zip Code" required>
                                    @error('pincode')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Latitude and Longitude -->
                                <div class="mb-3 col-md-4">
                                    <label for="latitude" class="form-label"><strong>Latitude</strong>
                                    <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $hotel->latitude) }}" placeholder="Enter Latitude" required>
                                    @error('latitude')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="longitude" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $hotel->longitude) }}" placeholder="Enter Longitude" required>
                                    @error('longitude')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Main Image -->
                                <div class="mb-3 col-md-4">
                                    <label for="main_image" class="form-label"><strong>Banner Image</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="file" class="form-control" id="main_image" name="main_image">
                                    @if($hotel->main_image)
                                        <img src="{{ $hotel->main_image }}" alt="Hotel Image" style="width: 100px; height: auto; margin-top: 10px;">
                                    @endif
                                </div>

                                <!-- Check in and Check out time -->
                                <div class="mb-3 col-md-4">
                                    <label for="check_in_time" class="form-label"><strong>Check in Time</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="time" class="form-control" id="check_in_time" name="check_in_time" value="{{ old('check_in_time', $hotel->check_in_time) }}">
                                    @error('check_in_time')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="check_out_time" class="form-label"><strong>Check out Time</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="time" class="form-control" id="check_out_time" name="check_out_time" value="{{ old('check_out_time', $hotel->check_out_time) }}">
                                    @error('check_out_time')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="infant_age_limit" class="form-label"><strong>Infant Upper Age Limit</strong></label>
                                    <input type="number" class="form-control" id="infant_age_limit" name="infant_age_limit" value="{{ old('infant_age_limit', $hotel->infant_age_limit) }}" placeholder="Enter Infant Age Limit">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="child_age_limit" class="form-label"><strong>Child Upper Age Limit</strong></label>
                                    <input type="number" class="form-control" id="child_age_limit" name="child_age_limit" value="{{ old('child_age_limit', $hotel->child_age_limit) }}" placeholder="Enter Child Age Limit">
                                </div>
                                
                                <div class="mb-3 col-md-4">
                                    <label for="weekend_days" class="form-label"><strong>Weekend Days</strong></label>
                                    <select name="weekend_days[]" id="weekend_days" class="form-control" multiple required>
                                        @php
                                            $selectedDays = json_decode(old('weekend_days', $hotel->weekend_days ?? '[]'), true);
                                        @endphp

                                        <option value="Saturday" {{ in_array('Saturday', $selectedDays) ? 'selected' : '' }}>Saturday</option>
                                        <option value="Sunday" {{ in_array('Sunday', $selectedDays) ? 'selected' : '' }}>Sunday</option>
                                        <option value="Friday" {{ in_array('Friday', $selectedDays) ? 'selected' : '' }}>Friday</option>
                                        <option value="Thursday" {{ in_array('Thursday', $selectedDays) ? 'selected' : '' }}>Thursday</option>
                                        <option value="Wednesday" {{ in_array('Wednesday', $selectedDays) ? 'selected' : '' }}>Wednesday</option>
                                        <option value="Tuesday" {{ in_array('Tuesday', $selectedDays) ? 'selected' : '' }}>Tuesday</option>
                                        <option value="Monday" {{ in_array('Monday', $selectedDays) ? 'selected' : '' }}>Monday</option>
                                    </select>
                                    <small class="form-text text-muted">Select the weekend days (use Ctrl or Cmd to select multiple days).</small>
                                </div>

                                <!-- Hotel Owner Company Name -->
                                <div class="mb-3 col-md-4">
                                    <label for="hotel_owner_company_name" class="form-label"><strong>Hotel Owner Company Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="text" class="form-control" id="hotel_owner_company_name" name="hotel_owner_company_name" value="{{ old('hotel_owner_company_name', $hotel->hotel_owner_company_name) }}" placeholder="Enter Hotel Owner Company Name">
                                    @error('hotel_owner_company_name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="management_comp_name" class="form-label"><strong>Management Company Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <input value="{{ old('hotel_owner_company_name', $hotel->hotel_owner_company_name) }}" type="text" class="form-control" id="management_comp_name" name="management_comp_name" placeholder="Enter Management Company Name" required>
                                    @error('management_comp_name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Additional Images -->
                                <div class="mb-3 col-md-4">
                                    <label for="images" class="form-label"><strong>Additional Images</strong></label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>

                                    <!-- Display existing images -->
                                    <div class="mt-3">
                                        <div class="image-slider-container" style="position: relative; overflow: hidden;">
                                            <div class="image-slider d-flex" style="transition: transform 0.5s ease;">
                                                @if(!empty($hotel->images))
                                                    @foreach(json_decode($hotel->images, true) as $image)
                                                        <div class="col-md-4 mb-3" style="flex-shrink: 0; width: 33.33%;"> <!-- 3 images per row -->
                                                            <a href="{{ $image }}" target="_blank" data-lightbox="hotel-images" data-title="Hotel Image">
                                                                <img src="{{ $image }}" alt="Hotel Image" class="img-thumbnail" style="width: 100%; height: auto;">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No images uploaded yet.</p>
                                                @endif
                                            </div>
                                            <button class="slider-arrow left" onclick="moveSlide(-1)" type="button" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background-color: rgba(0, 0, 0, 0.5); color: white; border: none; padding: 10px 15px; font-size: 18px; cursor: pointer; border-radius: 50%;">&lt;</button>
                                            <button class="slider-arrow right" onclick="moveSlide(1)" type="button" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background-color: rgba(0, 0, 0, 0.5); color: white; border: none; padding: 10px 15px; font-size: 18px; cursor: pointer; border-radius: 50%;">&gt;</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- 12 hours booking available -->
                                <div class="mb-3 col-md-4">
                                    <label for="date_range" class="form-label"><strong>Day Use Range</strong></label>
                                    <div class="input-group">
                                        <input type="text" id="date_range" name="date_range" class="form-control" 
                                            value="{{ old('date_range', $hotel->{'12_hour_book'} ?? '') }}" 
                                            placeholder="Select date range">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 col-md-4">
                                    <label for="description" class="form-label"><strong>Description</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter Description" required>{{ old('description', $hotel->description) }}</textarea>
                                </div>
                                <!-- Policies -->
                                <div class="mb-3 col-md-4">
                                    <label for="policies" class="form-label"><strong>Policies</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <textarea class="form-control" id="policies" name="policies" rows="4" placeholder="Enter Policies" required>{{ old('description', $hotel->description) }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="facilities" class="form-label"><strong>Select Facilities</strong></label>
                                <div id="facilities-container" class="d-flex flex-wrap">
                                    <!-- Facilities will be appended here dynamically -->
                                    @forelse ($facilities as $facility)
                                    <div class="form-check form-check-inline me-3">
                                        <input 
                                            class="form-check-input"
                                            type="checkbox" 
                                            name="facilities[]" 
                                            id="facility_{{$facility->id}}" 
                                            value="{{$facility->id}}"
                                            @if(in_array($facility->id, old('facilities', json_decode($hotel->facilities, true) ?? [])))
                                                checked
                                            @endif
                                        >
                                        <label class="form-check-label" for="facility_{{$facility->id}}">
                                            {{$facility->name}}
                                        </label>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>

                             <!-- key locations -->
                             <b>Port of Entry & Port of Exit</b>
                            <hr>

                            <!-- Port of Entry Section -->
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="port_of_entry" name="enable_port_of_entry" class="form-check-input" 
                                            {{ old('enable_port_of_entry', $enable_port_of_entry ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="port_of_entry"><strong>Enable Port of Entry</strong></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Port of Entry Fields Container -->
                            <div id="entry_fields_container" style="{{ old('enable_port_of_entry', $entry_data ? true : false) ? '' : 'display: none;' }}">
                                @foreach($entry_data as $index => $entry)
                                <div class="row" id="entry_fields_{{ $index }}">
                                    <!-- Port Name Select Box -->
                                    <div class="mb-3 col-md-3">
                                        <label for="port_name_{{ $index }}" class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <select id="port_name_{{ $index }}" name="port_name[]" class="form-control">
                                            <option value="">Select a Port</option>
                                            <option value="Airport" {{ old('port_name.' . $index, $entry['port_name'] ?? '') == 'Airport' ? 'selected' : '' }}>Airport</option>
                                            <option value="Seaport" {{ old('port_name.' . $index, $entry['port_name'] ?? '') == 'Seaport' ? 'selected' : '' }}>Seaport</option>
                                            <option value="Land Port" {{ old('port_name.' . $index, $entry['port_name'] ?? '') == 'Land Port' ? 'selected' : '' }}>Land Port</option>
                                        </select>
                                    </div>
                                    <!-- Latitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="latitude_{{ $index }}" class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="latitude[]" class="form-control" placeholder="Enter Latitude" value="{{ old('latitude.' . $index, $entry['latitude'] ?? '') }}">
                                    </div>
                                    <!-- Longitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="longitude_{{ $index }}" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="longitude[]" class="form-control" placeholder="Enter Longitude" value="{{ old('longitude.' . $index, $entry['longitude'] ?? '') }}">
                                    </div>
                                    <!-- Distance Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="distance_{{ $index }}" class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="distance[]" class="form-control" placeholder="Enter Distance" value="{{ old('distance.' . $index, $entry['distance'] ?? '') }}">
                                    </div>
                                    <!-- Delete Button -->
                                    <div class="mb-3 col-md-1">
                                        <button type="button" class="btn btn-danger remove-entry-field" style="margin-top: 30px;">Delete</button>
                                    </div>
                                </div>
                                @endforeach
                                <div id="entry_key_locations">
                                    <div id="entry_locations-additional-fields"></div>
                                    <div class="mb-3 col-md-3">
                                        <button type="button" id="entry-locations-add-more" class="btn btn-primary">Add More</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Port of Entry Section -->
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="port_of_exit" name="enable_port_of_exit" class="form-check-input" 
                                            {{ old('enable_port_of_exit', $enable_port_of_exit ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="port_of_exit"><strong>Enable Port of Exit</strong></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Port of Exit Fields Container -->
                            <div id="exit_fields_container" style="{{ old('enable_port_of_exit', $exit_data ? true : false) ? '' : 'display: none;' }}">
                                @foreach($exit_data as $index => $exit)
                                <div class="row" id="exit_fields_{{ $index }}">
                                    <!-- Port Name Select Box -->
                                    <div class="mb-3 col-md-3">
                                        <label for="exit_port_name_{{ $index }}" class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <select id="exit_port_name_{{ $index }}" name="exit_port_name[]" class="form-control">
                                            <option value="">Select a Port</option>
                                            <option value="Airport" {{ old('exit_port_name.' . $index, $exit['port_name'] ?? '') == 'Airport' ? 'selected' : '' }}>Airport</option>
                                            <option value="Seaport" {{ old('exit_port_name.' . $index, $exit['port_name'] ?? '') == 'Seaport' ? 'selected' : '' }}>Seaport</option>
                                            <option value="Land Port" {{ old('exit_port_name.' . $index, $exit['port_name'] ?? '') == 'Land Port' ? 'selected' : '' }}>Land Port</option>
                                        </select>
                                    </div>
                                    <!-- Latitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="exit_latitude_{{ $index }}" class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="exit_latitude[]" class="form-control" placeholder="Enter Latitude" value="{{ old('exit_latitude.' . $index, $exit['latitude'] ?? '') }}">
                                    </div>
                                    <!-- Longitude Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="exit_longitude_{{ $index }}" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="exit_longitude[]" class="form-control" placeholder="Enter Longitude" value="{{ old('exit_longitude.' . $index, $exit['longitude'] ?? '') }}">
                                    </div>
                                    <!-- Distance Field -->
                                    <div class="mb-3 col-md-3">
                                        <label for="exit_distance_{{ $index }}" class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                                        <input type="text" name="exit_distance[]" class="form-control" placeholder="Enter Distance" value="{{ old('exit_distance.' . $index, $exit['distance'] ?? '') }}">
                                    </div>
                                    <!-- Delete Button -->
                                    <div class="mb-3 col-md-1">
                                        <button type="button" class="btn btn-danger remove-exit-field" style="margin-top: 30px;">Delete</button>
                                    </div>
                                </div>
                                @endforeach
                                <div id="exit_key_locations">
                                    <div id="exit_locations-additional-fields"></div>
                                    <div class="mb-3 col-md-3">
                                        <button type="button" id="exit-locations-add-more" class="btn btn-primary">Add More</button>
                                    </div>
                                </div>
                            </div>
                             
                            <!-- conference -->
                            <b>Conference Room Availability</b>
                            <hr>
                            <div class="mb-3 col-md-4">
                                <label for="conference" class="form-label"><strong>Conference Room</strong><span style="color: red; font-weight: bold;">*</span></label>
                                <select name="conference" id="conference" class="form-control" required onchange="toggleConferenceOptions()">
                                    <option value="">Select an option</option>
                                    <option {{ $hotel->conference_room == 0 ? 'selected' : '' }} value="0">Not Available</option>
                                    <option {{ $hotel->conference_room == 1 ? 'selected' : '' }} value="1">Available</option>
                                </select>
                            </div>
                            <!-- <div class="row">
                                <div id="conference-options" style="{{ $hotel->conference_room == 1 ? 'display: block;' : 'display: none;' }}">

                                    @if($hotel->conference_data){
                                    @foreach (json_decode($hotel->conference_data, true) as $index => $conference)
                                        <div class="conference-field mb-3 col-md-12" id="conference-field-{{ $index }}">
                                            <div class="row">
                                                <div class="mb-3 col-md-4">
                                                    <label for="conference_head" class="form-label"><strong>Head</strong></label>
                                                    <input type="text" class="form-control" name="conference_head[]" placeholder="Enter Head" value="{{ old('conference_head', $conference['head'] ?? '') }}">
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="conference_duration" class="form-label"><strong>Duration</strong></label>
                                                    <input type="text" class="form-control" name="conference_duration[]" placeholder="Enter Duration" value="{{ old('conference_duration', $conference['duration'] ?? '') }}">
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="conference_price" class="form-label"><strong>Price</strong></label>
                                                    <input type="number" class="form-control" name="conference_price[]" placeholder="Enter Price" value="{{ old('conference_price', $conference['price'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-danger" onclick="removeConferenceField({{ $index }})">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @endif

                                    <div id="conference-additional-fields"></div>
                                    <div class="mb-3 col-md-4">
                                        <button type="button" id="conference-add-more" class="btn btn-primary" onclick="addConferenceField()">Add More</button>
                                    </div>
                                </div>
                            </div> -->

                            <b>Cancellation Details</b>
                            <hr>
                            <!-- Cancellation Type Selection -->
                            <div class="mb-3 col-md-4">
                                <label for="cancellation_type" class="form-label"><strong>Cancellation Type</strong><span style="color: red; font-weight: bold;">*</span></label>
                                <select name="cancellation_type" id="cancellation_type" class="form-control" required onchange="toggleCancellationOptions()">
                                    <option value="">Select an option</option>
                                    <option {{ $hotel->cancellation_type == 0 ? 'selected' : '' }} value="0">Free</option>
                                    <option {{ $hotel->cancellation_type == 1 ? 'selected' : '' }} value="1">Chargeable</option>
                                </select>
                            </div>

                            <div class="row">
                                <div id="cancellation-options" style="{{ $hotel->cancellation_type == 1 ? 'display: block;' : 'display: none;' }}">
                                    @if ($hotel->cancellation_data)
                                    @foreach (json_decode($hotel->cancellation_data, true) as $index => $cancellation)
                                        <div class="cancellation-field mb-3 col-md-12" id="cancellation-field-{{ $index }}">
                                            <div class="row">
                                                <div class="mb-3 col-md-4">
                                                    <label for="cancellation_duration" class="form-label"><strong>Duration</strong></label>
                                                    <input type="text" class="form-control" name="cancellation_duration[]" placeholder="Enter Duration" value="{{ old('cancellation_duration', $cancellation['duration'] ?? '') }}">
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="cancellation_price" class="form-label"><strong>Price</strong></label>
                                                    <input type="number" class="form-control" name="cancellation_price[]" placeholder="Enter Price" value="{{ old('cancellation_price', $cancellation['price'] ?? '') }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-danger" onclick="removeCancellationField({{ $index }})">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @endif

                                    <!-- Additional fields container -->
                                    <div id="cancellation-additional-fields"></div>

                                    <!-- Button to add more cancellation fields -->
                                    <div class="mb-3 col-md-4">
                                        <button type="button" id="cancellation-add-more" class="btn btn-primary" onclick="addCancellationField()">Add More</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="form-check form-switch">
                                <label for="hotel_status" class="form-label"><strong>Status</strong></label>
                                <input type="hidden" name="hotel_status" value="0">
                                <input class="form-check-input" name="hotel_status" 
                                    @if($category->status == 1) checked @endif 
                                    type="checkbox" id="hotel_status" value="1">
                                <label class="form-check-label"></label>
                            </div>


                            <!-- Submit and Reset Buttons -->
                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Update and Next</button>
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
            placeholder: 'Search for a hotel...', // Adds the placeholder
            ajax: {
                url: '{{ route("hotels.search") }}', // Backend route for fetching hotel data
                type: 'GET',
                dataType: 'json',
                delay: 20, // Debounce to reduce server load
                data: function (params) {
                    return {
                        query: params.term // Send the user's input as 'query'
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (hotel) {
                            return {
                                id: hotel.id, // Value submitted with the form
                                text: `${hotel.name} - ${hotel.city || 'No Location'}` // Text displayed
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 1 // Allow search from 1 character
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#hotelName').on('change', function () {
            
            let hotelId = $(this).val(); // Get the selected hotel's ID
            let facilitiesContainer = $('#facilities-container');
            let noFacilitiesMsg = $('#no-facilities-msg');

            // Clear previous facilities
            facilitiesContainer.empty();
            noFacilitiesMsg.show();

            if (hotelId) {
                // Make AJAX call to fetch facilities
                
                $.ajax({
                    url: `/hotels/${hotelId}/facilities`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data.success && data.facilities.length > 0) {
                            noFacilitiesMsg.hide();
                            // Append facilities checkboxes
                            data.facilities.forEach(function (facility) {
                                let checkbox = `
                                    <div class="form-check form-check-inline me-3">
                                        <input 
                                            class="form-check-input"
                                            type="checkbox" 
                                            name="facilities[]" 
                                            id="facility_${facility.id}" 
                                            value="${facility.id}"
                                        >
                                        <label class="form-check-label" for="facility_${facility.id}">
                                            ${facility.name}
                                        </label>
                                    </div>
                                `;
                                facilitiesContainer.append(checkbox);
                            });
                        } else {
                            noFacilitiesMsg.text('No facilities found for this hotel.').show();
                        }
                    },
                    error: function () {
                        noFacilitiesMsg.text('Error fetching facilities. Please try again.').show();
                    }
                });
            }
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
    // Toggle conference options visibility based on the selection
    function toggleConferenceOptions() {
        var conferenceSelect = document.getElementById('conference');
        var conferenceOptions = document.getElementById('conference-options');

        if (conferenceSelect.value == '1') {
            conferenceOptions.style.display = 'block';
        } else {
            conferenceOptions.style.display = 'none';
        }
    }

    // Initialize conference options visibility on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleConferenceOptions();
    });

    // Function to add new conference fields

    @if(!empty($hotel->conference_data) && is_array(json_decode($hotel->conference_data, true)))
    let conferenceIndex = {{ count(json_decode($hotel->conference_data, true)) }};
    function addConferenceField() {
        var newField = document.createElement('div');
        newField.classList.add('conference-field');
        newField.classList.add('mb-3');
        newField.classList.add('col-md-12');
        newField.id = 'conference-field-' + conferenceIndex;

        newField.innerHTML = `
            <div class="row">
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
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger" onclick="removeConferenceField(${conferenceIndex})">Delete</button>
                </div>
            </div>
        `;
        
        // Append the new conference field to the container
        document.getElementById('conference-additional-fields').appendChild(newField);
        conferenceIndex++;
        }
    @else
        let conferenceIndex = 0;
    @endif
    // Function to remove a conference field
    function removeConferenceField(index) {
        var field = document.getElementById('conference-field-' + index);
        field.remove();
    }
</script>

<script>
    // Toggle cancellation options visibility based on the cancellation type
    function toggleCancellationOptions() {
        var cancellationSelect = document.getElementById('cancellation_type');
        var cancellationOptions = document.getElementById('cancellation-options');

        if (cancellationSelect.value == '1') {
            cancellationOptions.style.display = 'contents';
        } else {
            cancellationOptions.style.display = 'none';
        }
    }

    // Initialize cancellation options visibility on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleCancellationOptions();
    });

    // Function to add new cancellation fields
    @if(!empty($hotel->cancellation_data) && is_array(json_decode($hotel->cancellation_data, true)))
    let cancellationIndex = {{ count(json_decode($hotel->cancellation_data, true)) }};
    function addCancellationField() {
        var newField = document.createElement('div');
        newField.classList.add('cancellation-field');
        newField.classList.add('mb-3');
        newField.classList.add('col-md-12');
        newField.id = 'cancellation-field-' + cancellationIndex;

        newField.innerHTML = `
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="cancellation_duration" class="form-label"><strong>Duration</strong></label>
                    <input type="text" class="form-control" name="cancellation_duration[]" placeholder="Enter Duration">
                </div>
                <div class="mb-3 col-md-4">
                    <label for="cancellation_price" class="form-label"><strong>Price</strong></label>
                    <input type="number" class="form-control" name="cancellation_price[]" placeholder="Enter Price">
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger" onclick="removeCancellationField(${cancellationIndex})">Delete</button>
                </div>
            </div>
        `;
        
        // Append the new cancellation field to the container
        document.getElementById('cancellation-additional-fields').appendChild(newField);
        cancellationIndex++;
    }
    @else
        let cancellationIndex = 0;
    @endif

    // Function to remove a cancellation field
    function removeCancellationField(index) {
        var field = document.getElementById('cancellation-field-' + index);
        field.remove();
    }


        // Key Locations
        $('#locations-add-more').on('click', function () {
        const newLocationFields = `
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="location" class="form-label"><strong>Location Name</strong></label>
                    <input type="text" class="form-control" name="location[]" placeholder="Enter Location">
                </div>
                <div class="col-md-4">
                    <label for="conference_duration" class="form-label"><strong>Distance</strong></label>
                    <input type="text" class="form-control" name="distance[]" placeholder="Enter Distance">
                </div>
            </div>
        `;
        $('#locations-additional-fields').append(newLocationFields);
    });
</script>

<script>
    let currentIndex = 0;
    function moveSlide(direction) {
        const images = document.querySelector('.image-slider');
        const totalImages = document.querySelectorAll('.image-slider .col-md-4').length;
        const imagesToShow = 3; 
        currentIndex += direction;
        if (currentIndex < 0) {
            currentIndex = Math.ceil(totalImages / imagesToShow) - 1;
        } else if (currentIndex >= Math.ceil(totalImages / imagesToShow)) {
            currentIndex = 0;
        }
        const offset = -(currentIndex * (imagesToShow * 100 / totalImages)) + "%";
        images.style.transform = `translateX(${offset})`;
    }

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
    document.addEventListener('DOMContentLoaded', function () {
        const portOfEntryCheckbox = document.getElementById('port_of_entry');
        const entryFieldsContainer = document.getElementById('entry_fields_container');
        const entryAddMoreButton = document.getElementById('entry-locations-add-more');
        const entryAdditionalFieldsContainer = document.getElementById('entry_locations-additional-fields');

        const portOfExitCheckbox = document.getElementById('port_of_exit');
        const exitFieldsContainer = document.getElementById('exit_fields_container');
        const exitAddMoreButton = document.getElementById('exit-locations-add-more');
        const exitAdditionalFieldsContainer = document.getElementById('exit_locations-additional-fields');

        // Toggle Entry Fields
        portOfEntryCheckbox.addEventListener('change', function () {
            entryFieldsContainer.style.display = this.checked ? 'block' : 'none';
            if (!this.checked) {
                entryAdditionalFieldsContainer.innerHTML = ''; // Clear fields when unchecked
            }
        });

        // Toggle Exit Fields
        portOfExitCheckbox.addEventListener('change', function () {
            exitFieldsContainer.style.display = this.checked ? 'block' : 'none';
            if (!this.checked) {
                exitAdditionalFieldsContainer.innerHTML = ''; // Clear fields when unchecked
            }
        });

        // Add More Button for Port of Entry
        entryAddMoreButton.addEventListener('click', function () {
            const newEntryRow = document.createElement('div');
            newEntryRow.classList.add('row', 'mt-3');
            newEntryRow.innerHTML = `
                <div class="mb-3 col-md-3">
                    <label for="port_name" class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <select name="port_name[]" class="form-control">
                        <option value="">Select a Port</option>
                        <option value="Airport">Airport</option>
                        <option value="Seaport">Seaport</option>
                        <option value="Land Port">Land Port</option>
                    </select>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="latitude" class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="latitude[]" class="form-control" placeholder="Enter Latitude">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="longitude" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="longitude[]" class="form-control" placeholder="Enter Longitude">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="distance" class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="distance[]" class="form-control" placeholder="Enter Distance">
                </div>
                <div class="mb-3 col-md-3">
                    <button type="button" class="btn btn-danger delete-row">Delete</button>
                </div>
            `;
            entryAdditionalFieldsContainer.appendChild(newEntryRow);

            // Delete Row Event for Entry
            newEntryRow.querySelector('.delete-row').addEventListener('click', function () {
                newEntryRow.remove();
            });
        });

        // Add More Button for Port of Exit
        exitAddMoreButton.addEventListener('click', function () {
            const newExitRow = document.createElement('div');
            newExitRow.classList.add('row', 'mt-3');
            newExitRow.innerHTML = `
                <div class="mb-3 col-md-3">
                    <label for="exit_port_name" class="form-label"><strong>Port Name</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <select name="exit_port_name[]" class="form-control">
                        <option value="">Select a Port</option>
                        <option value="Airport">Airport</option>
                        <option value="Seaport">Seaport</option>
                        <option value="Land Port">Land Port</option>
                    </select>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="exit_latitude" class="form-label"><strong>Latitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="exit_latitude[]" class="form-control" placeholder="Enter Latitude">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="exit_longitude" class="form-label"><strong>Longitude</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="exit_longitude[]" class="form-control" placeholder="Enter Longitude">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="exit_distance" class="form-label"><strong>Distance</strong><span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" name="exit_distance[]" class="form-control" placeholder="Enter Distance">
                </div>
                <div class="mb-3 col-md-3">
                    <button type="button" class="btn btn-danger delete-row">Delete</button>
                </div>
            `;
            exitAdditionalFieldsContainer.appendChild(newExitRow);

            // Delete Row Event for Exit
            newExitRow.querySelector('.delete-row').addEventListener('click', function () {
                newExitRow.remove();
            });
        });
    });
</script>
@endsection