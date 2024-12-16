@extends('layouts.layout')
@section('title', 'Hotels')
@section('css')
<link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="page-content">
   <div class="page-container">
      <!-- Add Pricing Details -->
      <div class="row justify-content-center">
         <div class="col-lg-11 col-md-10 col-sm-12">
            <div class="card">
               <div class="card-header text-white" style="background-color: #8e44ad;">
                  <div class="d-flex justify-content-between align-items-center">
                     <h5 class="mb-0">Add Pricing Details</h5>
                     <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                        <i class="mdi mdi-arrow-left"></i> Back
                     </a>
                  </div>
               </div>
               <x-alert />
               <div class="card-body">
                  <form id="hotelForm" method="POST" action="{{ route('storerates') }}" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" class="form-control" name="id" value="{{ $hotel->hotel_unique_id }}">

                    
                     <hr>
                     <div id="hotelRatesContainer">
                        <div class="hotel-rate-form">
                           <div class="row">
                              <!-- Event Name -->
                              <div class="col-md-3 mb-3">
                                 <label for="event" class="form-label"><strong>Event Name</strong><span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" name="event" placeholder="Enter Event Name" required>
                              </div>
                              <!-- Event Type -->
                              <div class="col-md-3 mb-3">
                                 <label for="event_type" class="form-label"><strong>Event Type</strong><span class="text-danger">*</span></label>
                                 <select class="form-control" name="event_type" required>
                                    <option value="">Select Event Type</option>
                                    <option value="Fair Date">Fair Date</option>
                                    <option value="Blackout Date">Blackout Date</option>
                                    <option value="Season">Season</option>
                                 </select>
                              </div>
                              
                              <!-- Price -->
                              <div class="col-md-3 mb-3" id="price">
                                 <label for="price" class="form-label"><strong>Price</strong></label><span class="text-danger">*</span>
                                 <input type="number" class="form-control" name="price" placeholder="Enter Price">
                              </div>

                               <!-- Weekday -->
                              <div class="mb-3 col-md-3" id="base_weekday_price" style="display: none;">
                                 <label for="weekday_price" class="form-label"><strong>Base Weekday Price</strong></label>
                                 <input type="number" name="weekday_price" class="form-control" placeholder="Enter Base weekday price">
                              </div>

                              <!-- Weekend Price -->
                              <div class="mb-3 col-md-3" id="base_weekend_price" style="display: none;">
                                    <label for="weekend_price" class="form-label"><strong>Base Weekend Price</strong></label>
                                    <input type="number" name="weekend_price" class="form-control" placeholder="Enter Base weekend price">
                              </div>

                              <!-- Start Date -->
                              <div class="col-md-3 mb-3">
                                 <label for="start_date" class="form-label"><strong>Start Date</strong><span class="text-danger">*</span></label>
                                 <input type="date" class="form-control" name="start_date" required>
                              </div>

                              <!-- End Date -->
                              <div class="col-md-3 mb-3">
                                 <label for="end_date" class="form-label"><strong>End Date</strong><span class="text-danger">*</span></label>
                                 <input type="date" class="form-control" name="end_date" required>
                              </div>
                              <div class="col-md-3 mb-3 d-flex align-items-end">
                                 <button type="button" class="btn btn-danger remove-rate">Delete</button>
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
                        <a href="{{ route('hotels.room', $hotel->id) }}" class="btn btn-secondary px-4">Previous</a>
                        <button type="submit" class="btn btn-primary px-4">Save and Add More Events</button>
                        <a href="{{ route('hotels.calender', $hotel->hotel_unique_id) }}" class="btn btn-success px-4">Next</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- Rates List -->
      <div class="card">
         <div class="card-header text-white bg-primary style="background-color: #e2b7f1;>
            <h5 class="mb-0">Rooms of {{ $hotel->name }}</h5>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="example2" class="table table-striped table-bordered">
                  <thead class="table-dark">
                     <tr>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Event Name</th>
                        <th>Event Type</th>
                        <th>Price/Surcharge</th>
                        <th>Weekday Price</th>
                        <th>Weekend Price</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($rates as $rate)
                     <tr>
                        <td>{{ $rate->start_date }}</td>
                        <td>{{ $rate->end_date }}</td>
                        <td>{{ $rate->event }}</td>
                        <td>{{ $rate->event_type }}</td>
                        <td>{{ $rate->price }}</td>
                        <td>{{ $rate->weekday_price }}</td>
                        <td>{{ $rate->weekend_price }}</td>

                        <td>
                           <a href="{{ route('rates.edit', ['id' => $rate->rate_id, 'hotel_id' => $hotel->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                           
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
            "order": [[0, "asc"]],
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
    document.addEventListener('DOMContentLoaded', function () {
        // Select the event type dropdown
        const eventTypeDropdown = document.querySelector('select[name="event_type"]');
        const priceField = document.getElementById('price');
        const weekdayPriceField = document.getElementById('base_weekday_price');
        const weekendPriceField = document.getElementById('base_weekend_price');

        // Function to toggle field visibility
        function toggleFields() {
            const selectedEventType = eventTypeDropdown.value;
            
            if (selectedEventType === "Season") {
                // Show weekday and weekend price
                weekdayPriceField.style.display = "block";
                weekendPriceField.style.display = "block";

                // Hide the price input field
                priceField.style.display = "none";
            } else {
                // Show price input field
                priceField.style.display = "block";

                // Hide weekday and weekend price
                weekdayPriceField.style.display = "none";
                weekendPriceField.style.display = "none";
            }
        }

        // Add event listener to the dropdown
         eventTypeDropdown.onchange = function() {
            toggleFields(); // Call toggleFields on change
         };

    });
</script>


@endsection
