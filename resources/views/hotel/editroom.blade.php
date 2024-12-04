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
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white; margin-top: 10px !important;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Room Details</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <x-alert />
                    <div class="card-body p-4">
                    <form id="hotelForm" method="POST" action="{{ route('room.update') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Hidden Hotel ID -->
                    <input type="hidden" class="form-control" name="id" value="{{ $room->id }}">
                    <div class="row">
                        <!-- Room Type -->
                        <div class="col-md-3 mb-3">
                            <label for="room_type" class="form-label"><strong>Room Type</strong>
                                <span style="color: red; font-weight: bold;">*</span>
                            </label>
                            <select name="room_type" id="room_type" class="form-control" required>
                                @foreach($roomtypes as $roomtype)
                                    <option value="{{ $roomtype->id }}" {{ $room->room_type_id == $roomtype->id ? 'selected' : '' }}>
                                        {{ $roomtype->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Number of Rooms -->
                        <div class="col-md-3 mb-3">
                           <label for="no_of_room" class="form-label"><strong>No of Room</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="no_of_room" placeholder="Enter Number of Rooms" value="{{ $room->no_of_room }}">
                           @error('no_of_room')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="bed_type" class="form-label"><strong>Bed Type</strong><span class="text-danger">*</span></label>
                           <select name="bed_type" id="bed_type" class="form-control" required>
                              <option value="">Select One</option>
                              <option value="1">King Size</option>
                              <option value="0">Queen Size</option>
                           </select>
                           @error('bed_type')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="weekday_price" class="form-label"><strong>Week Day Price</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="weekday_price" placeholder="Enter Number of Rooms" value="{{ $room->weekday_price }}">
                           @error('weekday_price')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="weekend_price" class="form-label"><strong>Week End Price</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="weekend_price" placeholder="Enter Number of Rooms" value="{{ $room->weekend_price }}">
                           @error('weekend_price')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Max Capacity -->
                        <div class="col-md-3 mb-3">
                           <label for="occupancy" class="form-label"><strong>Maximum Occupancy</strong><span class="text-danger">*</span></label>
                           <input type="number" id="occupancy" class="form-control" name="max_capacity" placeholder="Enter Occupancy" min="1" max="10" value="{{ $room->max_capacity }}">
                           @error('max_capacity')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="adult" class="form-label"><strong>Adults</strong><span class="text-danger">*</span></label>
                           <select id="adult" class="form-control" name="adult_count" disabled>
                            @if($room->adult > 0)
                              <option value="">{{ $room->adult }}</option>
                            @else
                              <option value="">Select Adults</option>
                            @endif
                           </select>
                           @error('adult_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                           <label for="child" class="form-label"><strong>Children</strong><span class="text-danger">*</span></label>
                           <select id="child" class="form-control" name="child_count" disabled>
                              <option value="">Select Children</option>
                           </select>
                           @error('child_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="extra_bed" class="form-label"><strong>Extra Bed Available</strong><span class="text-danger">*</span></label>
                            <select name="extra_bed" id="extra_bed" class="form-control" required>
                                <option value="">Select One</option>
                                <option value="1" {{ old('extra_bed', $room->extra_bed) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('extra_bed', $room->extra_bed) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('extra_bed')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3 extra-bed-price" style="display: {{ $room->extra_bed == 1 ? 'block' : 'none' }};">
                            <label for="extra_bed_price" class="form-label"><strong>Price</strong><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="extra_bed_price" id="extra_bed_price" value="{{ old('extra_bed_price', $room->extra_bed_price) }}" placeholder="Enter Price">
                            @error('extra_bed_price')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="child_cot" class="form-label"><strong>Child Cot Available</strong><span class="text-danger">*</span></label>
                            <select name="child_cot" id="child_cot" class="form-control" required>
                                <option value="">Select One</option>
                                <option value="1" {{ old('child_cot', $room->child_cot) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('child_cot', $room->child_cot) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('child_cot')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3 child-cot-price" style="display: {{ $room->child_cot == 1 ? 'block' : 'none' }};">
                            <label for="child_cot_price" class="form-label"><strong>Price</strong><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="child_cot_price" id="child_cot_price" value="{{ old('child_cot_price', $room->child_cot_price) }}" placeholder="Enter Price">
                            @error('child_cot_price')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="charge" class="form-label"><b>Fair And Backout Price</b></label>
                        <hr>
                        <div id="hotelRatesContainer">
                            @if($room->rates != null)  <!-- Check if there are any rates available -->
                                @foreach($room->rates as $rate)  <!-- Loop through the rates associated with the room -->
                                    <div class="hotel-rate-form">
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="event" class="form-label"><strong>Event Name</strong></label>
                                                <input type="text" class="form-control" name="event[]" value="{{ old('event[]', $rate->event) }}" placeholder="Enter Event Name">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="event_type" class="form-label"><strong>Event Type</strong></label>
                                                <select class="form-control" name="event_type[]">
                                                    <option value="">Select Event Type</option>
                                                    <option value="Fair Date" {{ old('event_type[]', $rate->event_type) == 'Fair Date' ? 'selected' : '' }}>Fair Date</option>
                                                    <option value="Blackout Date" {{ old('event_type[]', $rate->event_type) == 'Blackout Date' ? 'selected' : '' }}>Blackout Date</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="price" class="form-label"><strong>Price</strong></label>
                                                <input type="number" class="form-control" name="price[]" value="{{ old('price[]', $rate->price) }}" placeholder="Enter Price">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="start_date" class="form-label"><strong>Start Date</strong></label>
                                                <input type="date" class="form-control" name="start_date[]" value="{{ old('start_date[]', $rate->start_date) }}">
                                            </div>
                                            <!-- End Date -->
                                            <div class="col-md-3 mb-3">
                                                <label for="end_date" class="form-label"><strong>End Date</strong></label>
                                                <input type="date" class="form-control" name="end_date[]" value="{{ old('end_date[]', $rate->end_date) }}">
                                            </div>
                                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-rate">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No rates available. Please add new rates.</p>  <!-- Message to show if no rates are available -->
                            @endif
                        </div>

                        <div class="mb-3">
                            <button type="button" id="addRateButton" class="btn btn-primary">Add More</button>
                        </div>

                        <!-- Status -->
                        <div class="form-check form-switch">
                            <label for="hotel_status" class="form-label"><strong>Status</strong></label>
                            <input type="hidden" name="hotel_status" value="0">
                            <input class="form-check-input" name="hotel_status" 
                                @if($room->status == 1) checked @endif 
                                type="checkbox" id="hotel_status" value="1">
                            <label class="form-check-label"></label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                        </div>
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
    document.addEventListener("DOMContentLoaded", function () {
        const occupancyInput = document.getElementById("occupancy");
        const adultDropdown = document.getElementById("adult");
        const childDropdown = document.getElementById("child");

        // Function to update adult dropdown options
        function updateAdultOptions() {
            const occupancy = parseInt(occupancyInput.value) || 0;

            adultDropdown.innerHTML = `<option value="">Select Adults</option>`; // Reset options

            if (occupancy > 0) {
                for (let i = 1; i <= occupancy; i++) {
                    adultDropdown.innerHTML += `<option value="${i}">${i}</option>`;
                }
                adultDropdown.disabled = false;
                updateChildOptions(); // Update child options based on the new adult selection
            } else {
                adultDropdown.disabled = true;
                childDropdown.disabled = true;
            }
        }

        // Function to update child dropdown options
        function updateChildOptions() {
            const occupancy = parseInt(occupancyInput.value) || 0;
            const adults = parseInt(adultDropdown.value) || 0;
            const maxChildren = occupancy - adults;

            childDropdown.innerHTML = `<option value="">Select Children</option>`; // Reset options

            if (maxChildren > 0) {
                for (let i = 0; i <= maxChildren; i++) {
                    childDropdown.innerHTML += `<option value="${i}">${i}</option>`;
                }
                childDropdown.disabled = false;
            } else {
                childDropdown.disabled = true;
            }
        }

        // Add event listeners
        occupancyInput.addEventListener("input", updateAdultOptions);
        adultDropdown.addEventListener("change", updateChildOptions);
    });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
      // Handle Extra Bed Price
      const extraBedSelect = document.getElementById('extra_bed');
      const extraBedPrice = document.querySelector('.extra-bed-price');
      extraBedSelect.addEventListener('change', function () {
         if (this.value === '1') {
            extraBedPrice.style.display = 'block';
         } else {
            extraBedPrice.style.display = 'none';
         }
      });

      // Handle Child Cot Price
      const childCotSelect = document.getElementById('child_cot');
      const childCotPrice = document.querySelector('.child-cot-price');
      childCotSelect.addEventListener('change', function () {
         if (this.value === '1') {
            childCotPrice.style.display = 'block';
         } else {
            childCotPrice.style.display = 'none';
         }
      });
   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
      const hotelRatesContainer = document.getElementById('hotelRatesContainer');
      const addRateButton = document.getElementById('addRateButton');

      // Add More functionality
      addRateButton.addEventListener('click', function () {
         const newRateForm = document.createElement('div');
         newRateForm.classList.add('hotel-rate-form');
         newRateForm.innerHTML = `
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label for="event" class="form-label"><strong>Event Name</strong></label>
                  <input type="text" class="form-control" name="event[]" placeholder="Enter Event Name">
               </div>
               <div class="col-md-3 mb-3">
                  <label for="event_type" class="form-label"><strong>Event Type</strong></label>
                  <select class="form-control" name="event_type[]">
                     <option value="">Select Event Type</option>
                     <option value="Fair Date">Fair Date</option>
                     <option value="Blackout Date">Blackout Date</option>
                  </select>
               </div>
               <div class="col-md-3 mb-3">
                  <label for="price" class="form-label"><strong>Price</strong></label>
                  <input type="number" class="form-control" name="price[]" placeholder="Enter Price">
               </div>
               <div class="col-md-3 mb-3">
                  <label for="start_date" class="form-label"><strong>Start Date</strong></label>
                  <input type="date" class="form-control" name="start_date[]">
               </div>
               <div class="col-md-3 mb-3">
                  <label for="end_date" class="form-label"><strong>End Date</strong></label>
                  <input type="date" class="form-control" name="end_date[]">
               </div>
               <div class="col-md-3 mb-3 d-flex align-items-end">
                  <button type="button" class="btn btn-danger remove-rate">Delete</button>
               </div>
            </div>
         `;
         hotelRatesContainer.appendChild(newRateForm);
      });

      // Delete functionality
      hotelRatesContainer.addEventListener('click', function (event) {
         if (event.target.classList.contains('remove-rate')) {
            const rateForm = event.target.closest('.hotel-rate-form');
            if (rateForm) {
               hotelRatesContainer.removeChild(rateForm);
            }
         }
      });
   });
</script>
@endsection