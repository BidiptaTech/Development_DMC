@extends('layouts.layout')
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
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

                                <!-- Hotel Unique Id -->
                                <div class="mb-3 col-md-4">
                                    <label for="input35" class="form-label"><strong>Hotel Unique Id</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="input35" name="unique_id" placeholder="Enter Unique Id" required>
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
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                    <label for="state" class="form-label"><strong>State</strong>
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
                                    <label for="pincode" class="form-label"><strong>Zip Code</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Enter Zip Code" required>
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

                                <!-- Breakfast -->
                                <div class="mb-3 col-md-4">
                                    <label for="breakfast" class="form-label"><strong>Breakfast</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <select name="breakfast" id="breakfast" class="form-control" required>
                                        <option value="">Select an option</option>
                                        <option value="1">Available</option>
                                        <option value="0">Not Available</option>
                                    </select>
                                </div>

                                <div class="row" id="breakfast-options" style="display: none;">
                                    <div class="mb-3 col-md-4">
                                        <label for="breakfast_type" class="form-label"><strong>Breakfast Type</strong></label>
                                        <select name="breakfast_type" id="breakfast_type" class="form-control">
                                            <option value="">Select a type</option>
                                            <option value="0">Buffet</option>
                                            <option value="1">Set Buffet</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="breakfast_price" class="form-label"><strong>Breakfast Price</strong></label>
                                        <input type="number" name="breakfast_price" id="breakfast_price" class="form-control" placeholder="Enter price">
                                    </div>
                                </div>

                                <!-- Lunch -->
                                <div class="mb-3 col-md-4">
                                    <label for="lunch" class="form-label"><strong>Lunch</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <select name="lunch" id="lunch" class="form-control" required>
                                        <option value="">Select an option</option>
                                        <option value="1">Available</option>
                                        <option value="0">Not Available</option>
                                    </select>
                                </div>

                                <div class="row"  id="lunch-options" style="display: none;">
                                    <div class="mb-3 col-md-4">
                                        <label for="lunch_price" class="form-label"><strong>Lunch Price</strong></label>
                                        <input type="number" name="lunch_price" id="lunch_price" class="form-control" placeholder="Enter price">
                                    </div>
                                </div>

                                <!-- Dinner -->
                                <div class="mb-3 col-md-4">
                                    <label for="dinner" class="form-label"><strong>Dinner</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <select name="dinner" id="dinner" class="form-control" required>
                                        <option value="">Select an option</option>
                                        <option value="1">Available</option>
                                        <option value="0">Not Available</option>
                                    </select>
                                </div>

                                <div class="row" id="dinner-options" style="display: none;">
                                    <div class="mb-3 col-md-4">
                                        <label for="dinner_price" class="form-label"><strong>Dinner Price</strong></label>
                                        <input type="number" name="dinner_price" id="dinner_price" class="form-control" placeholder="Enter price">
                                    </div>
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

                                <div class="mb-3 col-md-4">
                                    <label for="booking_available" class="form-label"><strong>12 Hours Booking Available</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <select name="booking_available" id="booking_available" class="form-control" required>
                                        <option value="">Select an option</option>
                                        <option value="1">Available</option>
                                        <option value="0">Not Available</option>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 col-md-6">
                                    <label for="description" class="form-label"><strong>Description</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter Description" required></textarea>
                                    @error('description')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Policies -->
                                <div class="mb-3 col-md-6">
                                    <label for="policies" class="form-label"><strong>Policies</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <textarea class="form-control" id="policies" name="policies" rows="4" placeholder="Enter Policies"></textarea>
                                    @error('policies')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Facilities -->
                                <div class="mb-3 col-md-12">
                                    <label for="facilities" class="form-label"><strong>Facilities</strong><span style="color: red; font-weight: bold;">*</span></label>
                                    <div class="row">
                                        @foreach ($facilities as $facility)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="facilities[]" value="{{ $facility->id }}">
                                                <label class="form-check-label">{{ $facility->name }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('facilities')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
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

                            <div class="row" id="conference-options" style="display: none;">
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
                            </div>

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
    // Function to append options for a given meal
    function toggleOptions(meal, optionsId) {
        const select = document.getElementById(meal);
        const optionsContainer = document.getElementById(optionsId);

        select.addEventListener('change', function () {
            if (this.value === '1') {
                // Show options if "Available" is selected
                if (optionsContainer.children.length === 0) {
                    // Append the options dynamically using insertAdjacentHTML
                    const optionContent = `
                        <div class="mb-3 col-md-4">
                            <label for="${meal}_type" class="form-label"><strong>${meal.charAt(0).toUpperCase() + meal.slice(1)} Type</strong></label>
                            <select name="${meal}_type" id="${meal}_type" class="form-control">
                                <option value="">Select a type</option>
                                <option value="0">Buffet</option>
                                <option value="1">Set Buffet</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="${meal}_price" class="form-label"><strong>${meal.charAt(0).toUpperCase() + meal.slice(1)} Price</strong></label>
                            <input type="number" name="${meal}_price" id="${meal}_price" class="form-control" placeholder="Enter price">
                        </div>
                    `;
                    optionsContainer.insertAdjacentHTML('beforeend', optionContent); // Append the content
                }
                optionsContainer.style.display = 'contents'; // Show options
            } else {
                // Hide options if "Not Available" is selected
                optionsContainer.style.display = 'none';
                optionsContainer.innerHTML = ''; // Clear the options
            }
        });
    }

    // Initialize for breakfast, lunch, and dinner
    toggleOptions('breakfast', 'breakfast-options');
    toggleOptions('lunch', 'lunch-options');
    toggleOptions('dinner', 'dinner-options');
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

@endsection