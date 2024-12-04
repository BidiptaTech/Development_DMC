@extends('layouts.layout')

@section('title', 'Edit Hotel')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
@endsection

@section('content')
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
                                    <input type="text" class="form-control" id="input35" name="unique_id" value="{{ old('name', $hotel->hotel_unique_id) }}" placeholder="Enter Hotel Name" required>
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
                                    <label for="state" class="form-label"><strong>State</strong>
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
                                    <label for="pincode" class="form-label"><strong>Zip Code</strong>
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
                                    <label for="breakfast" class="form-label"><strong>Breakfast</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <select name="breakfast" id="breakfast" class="form-control" required onchange="toggleBreakfastOptions()">
                                        <option value="">Select an option</option>
                                        <option value="1" {{ old('breakfast', $hotel->includes_breakfast) == 1 ? 'selected' : '' }}>Available</option>
                                        <option value="0" {{ old('breakfast', $hotel->includes_breakfast) == 0 ? 'selected' : '' }}>Not Available</option>
                                    </select>
                                </div>

                                <div class="row" id="breakfast-options" style="{{ old('breakfast', $hotel->breakfast) == 1 ? 'display: block;' : 'display: none;' }}">
                                    <div class="mb-3 col-md-4">
                                        <label for="breakfast_type" class="form-label"><strong>Breakfast Type</strong></label>
                                        <select name="breakfast_type" id="breakfast_type" class="form-control">
                                            <option value="">Select a type</option>
                                            <option value="0" {{ old('breakfast_type', $hotel->breakfast_type) == 0 ? 'selected' : '' }}>Buffet</option>
                                            <option value="1" {{ old('breakfast_type', $hotel->breakfast_type) == 1 ? 'selected' : '' }}>Set Buffet</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="breakfast_price" class="form-label"><strong>Breakfast Price</strong></label>
                                        <input type="number" name="breakfast_price" id="breakfast_price" class="form-control" placeholder="Enter price" value="{{ old('breakfast_price', $hotel->breakfast_price) }}">
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="lunch" class="form-label"><strong>Lunch</strong></label>
                                    <select name="lunch" class="form-control" required>
                                        <option value="">Select an option</option>
                                        <option value="1" {{ $hotel->lunch == 1 ? 'selected' : '' }}>Available</option>
                                        <option value="0" {{ $hotel->lunch === 0 ? 'selected' : '' }}>Not Available</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="dinner" class="form-label"><strong>Dinner</strong></label>
                                    <select name="dinner" class="form-control" required>
                                        <option value="">Select an option</option>
                                        <option value="1" {{ $hotel->dinner == 1 ? 'selected' : '' }}>Available</option>
                                        <option value="0" {{ $hotel->dinner === 0 ? 'selected' : '' }}>Not Available</option>
                                    </select>
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
                                        <option value="Saturday" {{ in_array('Saturday', explode(',', old('weekend_days', $hotel->weekend_days ?? ''))) ? 'selected' : '' }}>Saturday</option>
                                        <option value="Sunday" {{ in_array('Sunday', explode(',', old('weekend_days', $hotel->weekend_days ?? ''))) ? 'selected' : '' }}>Sunday</option>
                                        <option value="Friday" {{ in_array('Friday', explode(',', old('weekend_days', $hotel->weekend_days ?? ''))) ? 'selected' : '' }}>Friday</option>
                                        <option value="Thursday" {{ in_array('Thursday', explode(',', old('weekend_days', $hotel->weekend_days ?? ''))) ? 'selected' : '' }}>Thursday</option>
                                        <option value="Wednesday" {{ in_array('Wednesday', explode(',', old('weekend_days', $hotel->weekend_days ?? ''))) ? 'selected' : '' }}>Wednesday</option>
                                        <option value="Tuesday" {{ in_array('Tuesday', explode(',', old('weekend_days', $hotel->weekend_days ?? ''))) ? 'selected' : '' }}>Tuesday</option>
                                        <option value="Monday" {{ in_array('Monday', explode(',', old('weekend_days', $hotel->weekend_days ?? ''))) ? 'selected' : '' }}>Monday</option>
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

                                <!-- Additional Images -->
                                <div class="mb-3 col-md-4">
                                    <label for="images" class="form-label"><strong>Additional Images</strong></label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 col-md-6">
                                    <label for="description" class="form-label"><strong>Description</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="4" value="{{ old('description', $hotel->description) }}" placeholder="Enter Description" required></textarea>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="policies" class="form-label"><strong>Policies</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <textarea class="form-control" id="policies" name="policies" rows="4" value="{{ old('policies', $hotel->policies) }}" placeholder="Enter Policies" required></textarea>
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
                            </div>
                            <!-- Facilities Selection (loaded dynamically) -->
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

<!-- Script For Fetching Hotels  -->
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

<!-- Script For Fetching Facilities  -->
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
    // This function will show/hide the breakfast options based on the selection
    function toggleBreakfastOptions() {
        var breakfastSelect = document.getElementById('breakfast');
        var breakfastOptions = document.getElementById('breakfast-options');
        
        if (breakfastSelect.value == '1') {
            breakfastOptions.style.display = 'contents';
        } else {
            breakfastOptions.style.display = 'none';
        }
    }

    // Call the function on page load to set the correct state
    document.addEventListener('DOMContentLoaded', function() {
        toggleBreakfastOptions();
    });
</script>

@endsection