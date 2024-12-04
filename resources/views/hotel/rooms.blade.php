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
                        <div class="col-md-4 mb-3">
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
                        <div class="col-md-4 mb-3">
                           <label for="no_of_room" class="form-label"><strong>No of Room</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="no_of_room" placeholder="Enter Number of Rooms">
                           @error('no_of_room')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                           <label for="weekday_price" class="form-label"><strong>Week Day Price</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="weekday_price" placeholder="Enter Number of Rooms">
                           @error('weekday_price')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                           <label for="weekend_price" class="form-label"><strong>Week End Price</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="weekend_price" placeholder="Enter Number of Rooms">
                           @error('weekend_price')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Occupancy -->
                        <div class="col-md-4 mb-3">
                           <label for="occupancy" class="form-label"><strong>Maximum Occupancy</strong><span class="text-danger">*</span></label>
                           <input type="number" id="occupancy" class="form-control" name="max_capacity" placeholder="Enter Occupancy" min="1" max="10">
                           @error('max_capacity')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>
                     
                        <div class="col-md-4 mb-3">
                           <label for="adult" class="form-label"><strong>Adults</strong><span class="text-danger">*</span></label>
                           <select id="adult" class="form-control" name="adult_count" disabled>
                              <option value="">Select Adults</option>
                           </select>
                           @error('adult_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                           <label for="child" class="form-label"><strong>Children</strong><span class="text-danger">*</span></label>
                           <select id="child" class="form-control" name="child_count" disabled>
                              <option value="">Select Children</option>
                           </select>
                           @error('child_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>

                     <!-- Room Price Section -->
                     <label for="charge" class="form-label"><b>Fair And Backout Price</b></label>
                     <hr>
                     <div id="hotelRatesContainer">
                        <div class="hotel-rate-form">
                           <div class="row">
                              <div class="col-md-4 mb-3">
                                 <label for="event" class="form-label"><strong>Event Name</strong></label>
                                 <input type="text" class="form-control" name="event[]" placeholder="Enter Event Name">
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label for="event_type" class="form-label"><strong>Event Type</strong></label>
                                 <select class="form-control" name="event_type[]">
                                    <option value="">Select Event Type</option>
                                    <option value="Fair Date">Fair Date</option>
                                    <option value="Blackout Date">Blackout Date</option>
                                 </select>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label for="price" class="form-label"><strong>Price</strong></label>
                                 <input type="number" class="form-control" name="price[]" placeholder="Enter Price">
                              </div>
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
         <div class="card-header text-white bg-primary">
            <h5 class="mb-0">Rooms of {{ $hotel->name }}</h5>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="example2" class="table table-striped table-bordered">
                  <thead class="table-dark">
                     <tr>
                        <th>Room Number</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($rooms as $room)
                     <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->max_capacity }}</td>
                        <td>{{ $room->status ? 'Active' : 'Inactive' }}</td>
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