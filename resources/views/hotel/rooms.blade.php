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
                     <div class="mb-3">
                        <label for="input35" class="form-label"><strong>Room Number</strong></label>
                        <input type="text" class="form-control" name="room_number" placeholder="Enter Room Number">
                     </div>
                     <div class="mb-3">
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
                     <div class="mb-3">
                        <label for="input35" class="form-label"><strong>Max capacity</strong></label>
                        <input type="number" class="form-control" name="max_capacity" placeholder="Enter Hotel Number">
                     </div>
                     <div class="mb-3">
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
                     <div class="mb-3">
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
                        <input type="number" class="form-control" name="charge" id="charge" placeholder="Enter Cancellation Charge">
                     </div>

                     <div class="form-check form-switch">
                        <label for="hotel_status" class="form-label"><strong>Status</strong></label>
                        <input type="hidden" name="hotel_status" value="0">
                        <input class="form-check-input" name="hotel_status" type="checkbox" id="hotel_status" value="1">
                        <label class="form-check-label"></label>
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
@endsection