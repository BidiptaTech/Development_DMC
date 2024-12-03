@extends('layouts.layout')
@section('title', 'Hotels')
@section('css')
<link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
@section('content')
<!--  create hotel rooms -->
<div class="page-content">
   <div class="page-container">
      <div class="row justify-content-center">
         <div class="col-lg-11 col-md-10 col-sm-12">
            <div class="card">
               <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white; margin-top: 10px !important;">
                  <div class="d-flex justify-content-between align-items-center">
                     <h5 class="mb-0">Add Room Details</h5>
                     <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                     <i class="mdi mdi-arrow-left"></i> Back
                     </a>
                  </div>
               </div>
               <x-alert />
               <div class="card-body p-4">
                  <form id="hotelForm" method="POST" action="{{ route('storeroom') }}" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" class="form-control" name="id" value="{{ $hotel->id }}">
                     <div class="row">
                     <div class="col-md-4 mb-3">
                        <label for="room_type" class="form-label"><strong>Room Type</strong>
                           <span style="color: red; font-weight: bold;">*</span>
                        </label>
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
                     <div class="col-md-4 mb-3">
                        <label for="input35" class="form-label"><strong>No of Room</strong></label>
                        <span style="color: red; font-weight: bold;">*</span>
                        <input type="text" class="form-control" name="room_number" placeholder="Enter Number of Room ">
                        @error('room_number')
                           <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                     </div>
                        <!-- Occupancy Input -->
                        <div class="col-md-4 mb-3">
                           <label for="input35" class="form-label"><strong>Occupancy</strong></label>
                           <span style="color: red; font-weight: bold;">*</span>
                           <input type="number" id="occupancy" class="form-control" name="max_capacity" 
                                    placeholder="Enter Occupancy" min="1" max="10">
                           @error('max_capacity')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Adult Dropdown -->
                        <div class="col-md-4 mb-3">
                           <label for="adult" class="form-label"><strong>Adults</strong></label>
                           <span style="color: red; font-weight: bold;">*</span>
                           <select id="adult" class="form-control" name="adult_count" disabled>
                                 <option value="">Select Adults</option>
                           </select>
                           @error('adult_count')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Child Dropdown -->
                        <div class="col-md-4 mb-3">
                           <label for="child" class="form-label"><strong>Children</strong></label>
                           <span style="color: red; font-weight: bold;">*</span>
                           <select id="child" class="form-control" name="child_count" disabled>
                                 <option value="">Select Children</option>
                           </select>
                           @error('child_count')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>
                     <div class="col-md-4 mb-3">
                        <label for="status" class="form-label"><strong>Check availability</strong>
                           <span style="color: red; font-weight: bold;">*</span>
                        </label>
                        <select name="available" class="form-control" required>
                           <option value="">Select One</option>
                           <option value="0">Booked</option>
                           <option value="1">Available</option>
                           <option value="2">Cleaning</option>
                        </select>
                        @error('available')
                           <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="cancellation_type" class="form-label"><strong>Cancellation Type</strong>
                           <span style="color: red; font-weight: bold;">*</span>
                        </label>
                        <select name="cancellation_type" id="cancellation_type" class="form-control" required onchange="toggleChargeField()">
                           <option value="">Select One</option>
                           <option value="1">Chargeable</option>
                           <option value="0">Free</option>
                        </select>
                        @error('cancellation_type')
                           <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="mb-3" id="cancellation_charge_field" style="display: none;">
                        <label for="charge" class="form-label"><strong>Cancellation Charge</strong></label>
                        <span style="color: red; font-weight: bold;">*</span>
                        <input type="number" class="form-control" name="charge" id="charge" placeholder="Enter Cancellation Charge">
                        @error('charge')
                           <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                     </div>
                     <!-- hotels rate -->
                     <label for="charge" class="form-label"><b>Room Price</b></label>
                     <hr>
                     <div id="hotelRatesContainer">
                           <!-- Original set of hotel rate fields -->
                           <div class="hotel-rate-form">
                              
                              <div class="row">
                                 <!-- Event Name -->
                                 <div class="col-md-4 mb-3">
                                    <label for="event" class="form-label"><strong>Event Name</strong></label>
                                    <input type="text" class="form-control" name="event[]" placeholder="Enter Event Name">
                                 </div>

                                 <!-- Event Type Dropdown -->
                                 <div class="col-md-4 mb-3">
                                    <label for="event_type" class="form-label"><strong>Event Type</strong></label>
                                    <select class="form-control" name="event_type[]">
                                       <option value="">Select Event Type</option>
                                       <option value="Fair Date">Fair Date</option>
                                       <option value="Blackout Date">Blackout Date</option>
                                    </select>
                                 </div>

                                 <!-- Price -->
                                 <div class="col-md-4 mb-3">
                                    <label for="price" class="form-label"><strong>Price</strong></label>
                                    <input type="number" class="form-control" name="price[]" placeholder="Enter Price">
                                 </div>

                                 <!-- Start Date -->
                                 <div class="col-md-4 mb-3">
                                    <label for="start_date" class="form-label"><strong>Start Date</strong></label>
                                    <input type="date" class="form-control" name="start_date[]">
                                 </div>

                                 <!-- End Date -->
                                 <div class="col-md-4 mb-3">
                                    <label for="end_date" class="form-label"><strong>End Date</strong></label>
                                    <input type="date" class="form-control" name="end_date[]">
                                 </div>
                              </div>
                           </div>
                        </div>

                        <!-- Add New Button -->
                        <div class="text-end mb-3">
                           <button type="button" class="btn btn-primary" id="addNewRate">Add New</button>
                        </div>
                        <!-- end of hotels rate -->
                     <div class="form-check form-switch">
                        <label for="hotel_status" class="form-label"><strong>Status</strong></label>
                        <span style="color: red; font-weight: bold;">*</span>
                        <input class="form-check-input" name="hotel_status" type="checkbox" id="hotel_status" value="1">
                        <label class="form-check-label"></label>
                        @error('hotel_status')
                           <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                     </div>

                     <!-- Submit and Previous Buttons -->
                     <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('contactdetails.edit', $hotel->id) }}" class="btn btn-secondary px-4" id="previousButton">Previous</a>
                        <button type="submit" class="btn btn-primary px-4">Save and Add more rooms</button>
                        <a href="{{ route('hotels.index') }}" class="btn btn-success px-4">Save and Finish</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--  view hotel rooms -->
<div class="page-content">
   <div class="page-container">
      <div class="card page-title-box rounded-0">
         <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row gap-2">
            <div class="flex-grow-1">
               <h4 class="font-18 fw-semibold mb-0">Rooms of {{ $hotel->name }}</h4>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-body">
            <div class="table-responsive">
               <table id="example2" class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>Room number</th>
                        <th>Availability</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($rooms as $room)
                     <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>
                           @switch($room->is_available)
                           @case(0)
                           {{ 'booked' }}
                           @break
                           @case(1)
                           {{ 'available' }}
                           @break
                           @default
                           {{ 'cleaning' }}
                           @endswitch
                        </td>
                        <td>{{ $room->max_capacity }}</td>
                        <td>{{ $room->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                           <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm" style="width: 36px; height: 36px; padding: 0;">
                              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                                 <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
                              </svg>
                           </a>
                           <!-- Delete Button -->
                           <button type="button" class="btn btn-danger btn-sm" style="width: 36px; height: 36px; padding: 0;" data-toggle="modal" data-target="#deleteModal" onclick="setDeleteForm('{{ route('rooms.destroy', $room->id) }}')">
                              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                                 <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                              </svg>
                           </button>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- Delete Confirmation Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
               </div>
               <div class="modal-body">
                  Are you sure you want to delete?
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <form id="deleteForm" action="" method="POST" style="display:inline">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- end modal -->
</div>
<!-- end view room -->
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

<script>document.getElementById('addNewRate').addEventListener('click', function () {
    // Get the container where forms will be appended
    const container = document.getElementById('hotelRatesContainer');

    // Clone the first form
    const firstForm = container.querySelector('.hotel-rate-form');
    const newForm = firstForm.cloneNode(true);

    // Reset input values in the cloned form
    const inputs = newForm.querySelectorAll('input, select');
    inputs.forEach(input => {
        if (input.tagName === 'INPUT') {
            input.value = '';
        } else if (input.tagName === 'SELECT') {
            input.selectedIndex = 0;
        }
    });

    // Append the cloned form to the container
    container.appendChild(newForm);
});
</script>
@endsection