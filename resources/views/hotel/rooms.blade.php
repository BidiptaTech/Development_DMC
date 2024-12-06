@extends('layouts.layout')
@section('title', 'Hotels')
@section('css')
<link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="page-content">
   <div class="page-container">
      <!-- Add Room Details -->
      <div class="row justify-content-center">
         <div class="col-lg-11 col-md-10 col-sm-12">
            <div class="card">
               <div class="card-header text-white" style="background-color: #8e44ad;">
                  <div class="d-flex justify-content-between align-items-center">
                     <h5 class="mb-0">Add Room Details</h5>
                     <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                        <i class="mdi mdi-arrow-left"></i> Back
                     </a>
                  </div>
               </div>
               <x-alert />
               <div class="card-body">
                  <form id="hotelForm" method="POST" action="{{ route('storeroom') }}" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" class="form-control" name="id" value="{{ $hotel->id }}">

                     <div class="row">
                        <!-- Room Type -->
                        <div class="col-md-3 mb-3">
                           <label for="room_type" class="form-label"><strong>Room Type</strong><span class="text-danger">*</span></label>
                           <select name="room_type" id="room_type" class="form-control" required>
                              <option value="">Select One</option>
                              @foreach($roomtypes as $roomtype)
                              <option value="{{ $roomtype->id }}">{{ $roomtype->name }}</option>
                              @endforeach
                           </select>
                           @error('room_type')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Number of Rooms -->
                        <div class="col-md-3 mb-3">
                           <label for="no_of_room" class="form-label"><strong>No of Room</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="no_of_room" placeholder="Enter Number of Rooms">
                           @error('no_of_room')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="bed_type" class="form-label"><strong>Bed Type</strong><span class="text-danger">*</span></label>
                           <select name="bed_type" id="bed_type" class="form-control" required>
                              <option value="">Select One</option>
                              @foreach($beds as $bed)
                              <option value="{{ $bed->bedId }}"> {{ $bed->bed_type }} </option>
                              @endforeach
                           </select>
                           @error('bed_type')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="weekday_price" class="form-label"><strong>Week Day Price</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="weekday_price" placeholder="Enter Number of Rooms">
                           @error('weekday_price')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="weekend_price" class="form-label"><strong>Week End Price</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="weekend_price" placeholder="Enter Number of Rooms">
                           @error('weekend_price')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Occupancy -->
                        <div class="col-md-3 mb-3">
                           <label for="occupancy" class="form-label"><strong>Maximum Occupancy</strong><span class="text-danger">*</span></label>
                           <input type="number" id="occupancy" class="form-control" name="max_capacity" placeholder="Enter Occupancy" min="1" max="10">
                           @error('max_capacity')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>
                     
                        <div class="col-md-3 mb-3">
                           <label for="adult" class="form-label"><strong>Adults</strong><span class="text-danger">*</span></label>
                           <select id="adult" class="form-control" name="adult_count" disabled>
                              <option value="">Select Adults</option>
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
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                           @error('extra_bed')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3 extra-bed-price" style="display: none;">
                           <label for="extra_bed_price" class="form-label"><strong>Price</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="extra_bed_price" id="extra_bed_price" placeholder="Enter Price">
                           @error('extra_bed_price')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="child_cot" class="form-label"><strong>Child Cot Available</strong><span class="text-danger">*</span></label>
                           <select name="child_cot" id="child_cot" class="form-control" required>
                              <option value="">Select One</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                           @error('child_cot')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3 child-cot-price" style="display: none;">
                           <label for="child_cot_price" class="form-label"><strong>Price</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="child_cot_price" id="child_cot_price" placeholder="Enter Price">
                           @error('child_cot_price')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>
                        
                     </div>

                     <label for="charge" class="form-label"><b>Fair And Backout Price</b><span class="text-danger">*</span></label>
                     <hr>
                     <div id="hotelRatesContainer">
                        <div class="hotel-rate-form">
                           <div class="row">
                              <div class="col-md-3 mb-3">
                                 <label for="event" class="form-label"><strong>Event Name</strong><span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" name="event[]" placeholder="Enter Event Name" required>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="event_type" class="form-label"><strong>Event Type</strong><span class="text-danger">*</span></label>
                                 <select class="form-control" name="event_type[]" required>
                                    <option value="">Select Event Type</option>
                                    <option value="Fair Date">Fair Date</option>
                                    <option value="Blackout Date">Blackout Date</option>
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="price" class="form-label"><strong>Price</strong></label><span class="text-danger">*</span>
                                 <input type="number" class="form-control" name="price[]" placeholder="Enter Price" required>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="start_date" class="form-label"><strong>Start Date</strong><span class="text-danger">*</span></label>
                                 <input type="date" class="form-control" name="start_date[]" required>
                              </div>

                              <!-- End Date -->
                              <div class="col-md-3 mb-3">
                                 <label for="end_date" class="form-label"><strong>End Date</strong><span class="text-danger">*</span></label>
                                 <input type="date" class="form-control" name="end_date[]" required>
                              </div>
                              <div class="col-md-3 mb-3 d-flex align-items-end">
                                 <button type="button" class="btn btn-danger remove-rate">Delete</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="mb-3">
                        <button type="button" id="addRateButton" class="btn btn-primary">Add More</button>
                     </div>

                     <div class="form-check form-switch">
                        <label for="hotel_status" class="form-label"><strong>Status</strong></label>
                        <span style="color: red; font-weight: bold;">*</span>
                        <input class="form-check-input" name="hotel_status" type="checkbox" id="hotel_status" value="1">
                        <label class="form-check-label"></label>
                        @error('hotel_status')
                           <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                     </div>

                     <!-- Submit Buttons -->
                     <div class="d-flex gap-3">
                        <a href="{{ route('contactdetails.edit', $hotel->id) }}" class="btn btn-secondary px-4">Previous</a>
                        <button type="submit" class="btn btn-primary px-4">Save and Add More Rooms</button>
                        <a href="{{ route('hotels.index') }}" class="btn btn-success px-4">Save and Finish</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- Room List -->
      <div class="card">
         <div class="card-header text-white bg-primary style="background-color: #e2b7f1;>
            <h5 class="mb-0">Rooms of {{ $hotel->name }}</h5>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="example2" class="table table-striped table-bordered">
                  <thead class="table-dark">
                     <tr>
                        <th>Room Type</th>
                        <th>Occupancy</th>
                        <th>Weekday Price</th>
                        <th>Weekend Price</th>
                        <th>Extra Bed</th>
                        <th>Child Cot</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($rooms as $room)
                     <tr>
                        <td>"Delux Room"</td>
                        <td>{{ $room->max_capacity }}</td>
                        <td>{{ $room->weekday_price }}</td>
                        <td>{{ $room->weekend_price }}</td>
                        <td>
                           @if($room->extra_bed === 1)
                              <span class="badge bg-success">Available</span>
                           @else
                              <span class="badge bg-danger">Not Available</span>
                           @endif
                        </td>
                        <td>
                           @if($room->child_cot === 1)
                              <span class="badge bg-success">Available</span>
                           @else
                              <span class="badge bg-danger">Not Available</span>
                           @endif
                        </td>

                        <td>
                           <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                           <form method="POST" action="{{ route('rooms.destroy', $room->id) }}" class="d-inline-block">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                           </form>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts') 
<!-- DataTable Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        $('#example2').DataTable().buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

    function setDeleteForm(action) {
        document.getElementById('deleteForm').action = action;
    }
</script>
<script>
   function setDeleteForm(action) {
           const test = document.getElementById('deleteForm').action = action;
           console.log(test)
       }
   
   function toggleChargeField() {
       const chargeable = document.getElementById("cancellation_type").value;
       const chargeField = document.getElementById("cancellation_charge_field");
   
       if (chargeable === "1") {
           chargeField.style.display = "block";
       } else {
           chargeField.style.display = "none";
       }
   }
   window.onload = function() {
       toggleChargeField();
   };
</script>
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