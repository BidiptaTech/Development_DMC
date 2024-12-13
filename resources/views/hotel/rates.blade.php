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
                     <input type="hidden" class="form-control" name="id" value="{{ $hotel->id }}">

                     <label for="charge" class="form-label"><b>Fair And Blackout Price</b><span class="text-danger">*</span></label>
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
                                    <option value="Blackout Date">Season</option>
                                 </select>
                              </div>
                              
                              <!-- Price -->
                              <div class="col-md-3 mb-3" style="display: none;">
                                 <label for="price" class="form-label"><strong>Price</strong></label><span class="text-danger">*</span>
                                 <input type="number" class="form-control" name="price" placeholder="Enter Price" required>
                              </div>

                               <!-- Weekday -->
                              <div class="mb-3 col-md-3" id="base_weekday_price" style="display: none;">
                                 <label for="weekday_price" class="form-label"><strong>Base Weekday Price</strong></label>
                                 <input type="number" name="base_weekday_price" class="form-control" placeholder="Enter Base weekday price">
                              </div>

                              <!-- Weekend Price -->
                              <div class="mb-3 col-md-3" id="base_weekend_price" style="display: none;">
                                    <label for="weekend_price" class="form-label"><strong>Base Weekend Price</strong></label>
                                    <input type="number" name="base_weekend_price" class="form-control" placeholder="Enter Base weekend price">
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
                        <button type="submit" class="btn btn-primary px-4">Save and Add More Rooms</button>
                        <a href="{{ route('hotels.index') }}" class="btn btn-success px-4">Save and Next</a>
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
                        <th>Price</th>
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

                        <td>
                           <a href="{{ route('rooms.edit', $rate->rate_id) }}" class="btn btn-warning btn-sm">Edit</a>
                           <form method="POST" action="{{ route('rooms.destroy', $rate->rate_id) }}" class="d-inline-block">
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

<script>

</script>

@endsection
