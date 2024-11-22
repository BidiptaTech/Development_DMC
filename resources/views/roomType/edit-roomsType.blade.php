@extends('layouts.layout')
@section('content')

@php
    $selectedHotel = $hotel->id ?? null; // Previously saved hotel_id
    $selectedHotelName = $hotel->name ?? null; // Previously saved hotel name
@endphp
<!-- Start of the form -->
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Room Type</h5>
                            <!-- Back Button -->
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                        
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('roomType.update', $roomType->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            @method('PUT')
                            <div class="mb-3">
                                <label for="hotelName" class="form-label"><strong>Hotel Name</strong></label>
                                <select  id="hotelName" name="hotel_id" class="form-control" required>
                                    <option value="">Search for a hotel...</option>
                                    @if ($selectedHotel && $selectedHotelName)
                                        <option value="{{ $selectedHotel }}" selected>{{ $selectedHotelName }}</option>
                                    @endif
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Room Type Name</strong></label>
                                <input value="{{$roomType->name}}" type="text" id="roomType" name="roomType" placeholder="Enter Room Type Name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="breakfast" class="form-label"><strong>Breakfast</strong></label>
                                <select name="breakfast" id="breakfast" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="1" {{ $roomType->breakfast == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ $roomType->breakfast === 0 ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lunch" class="form-label"><strong>Lunch</strong></label>
                                <select name="lunch" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="1" {{ $roomType->lunch == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ $roomType->lunch === 0 ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="dinner" class="form-label"><strong>Dinner</strong></label>
                                <select name="dinner" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="1" {{ $roomType->dinner == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ $roomType->dinner === 0 ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="extra_bed" class="form-label"><strong>Extra Bed</strong></label>
                                <select name="extra_bed" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="1" {{ $roomType->extra_bed == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ $roomType->extra_bed === 0 ? 'selected' : '' }}>Not Available</option>
                                </select>
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
                                            id="facility_{{$facility}}" 
                                            value="{{$facility}}"
                                            @if(in_array($facility, old('facilities', json_decode($roomType->facilities, true) ?? [])))
                                                checked
                                            @endif
                                        >
                                        <label class="form-check-label" for="facility_{{$facility}}">
                                            {{$facility}}
                                        </label>
                                    </div>
                                    @empty
                                        No facility found for this hotel.&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('hotels.edit', ['hotel' => $hotel->id]) }}">Add Hotel Facility</a>
                                    @endforelse
                                    
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label"><strong>Description</strong></label>
                                <input value="{{$roomType->description}}" type="text" id="description" name="description" placeholder="Enter Room Description" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="room_status" class="form-label"><strong>Status</strong></label>
                                <select id="room_status" name="room_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="1" {{ $roomType->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $roomType->status == 0 ? 'selected' : '' }}>Not Active</option>
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
        let selectedHotelId = "{{ $selectedHotel }}";
    let selectedHotelName = "{{ $selectedHotelName }}";
    if (selectedHotelId && selectedHotelName) {
        let option = new Option(selectedHotelName, selectedHotelId, true, true);
        $('#hotelName').append(option).trigger('change');
    }
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
                                            id="facility_${facility}" 
                                            value="${facility}"
                                        >
                                        <label class="form-check-label" for="facility_${facility}">
                                            ${facility}
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

@endsection
