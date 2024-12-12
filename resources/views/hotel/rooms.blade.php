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
                           <label for="base_room_type" class="form-label"><strong>Base Room Type</strong><span class="text-danger">*</span></label>
                           <input name="base_room_type" id="base_room_type" class="form-control" placeholder="Enter Base Room Type" required></input>
                           @error('base_room_type')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Number of Rooms -->
                        <div class="col-md-3 mb-3">
                           <label for="base_no_of_room" class="form-label"><strong>No of Rooms</strong><span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="base_no_of_room" placeholder="Enter Number of Rooms" required>
                           @error('base_no_of_room')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="mb-3 col-md-3">
                           <label for="base-weekday-price" class="form-label"><strong>Base Weekday Price</strong></label>
                           <input type="number" name="base-weekday-price" id="base-weekday-price" class="form-control" placeholder="Enter Base weekday price" required>
                       </div>
                       <div class="mb-3 col-md-3">
                           <label for="base-weekend-price" class="form-label"><strong>Base Weekend Price</strong></label>
                           <input type="number" name="base-weekend-price" id="base-weekend-price" class="form-control" placeholder="Enter Base weekend price" required>
                       </div>

                        <!-- Breakfast -->
                        <div class="mb-3 col-md-3">
                           <label for="breakfast" class="form-label"><strong>Breakfast</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="breakfast[]" id="breakfast" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       <div class="row" id="breakfast-options" style="display: none;">
                           <div class="mb-3 col-md-3">
                               <label for="breakfast_type" class="form-label"><strong>Breakfast Type</strong></label>
                               <select name="breakfast_type[]" id="breakfast_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3">
                               <label for="breakfast_price" class="form-label"><strong>Breakfast Price</strong></label>
                               <input type="number" name="breakfast_price[]" id="breakfast_price" class="form-control" placeholder="Enter price">
                           </div>
                       </div>

                       <!-- Lunch -->
                       <div class="mb-3 col-md-3">
                           <label for="lunch" class="form-label"><strong>Lunch</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="lunch[]" id="lunch" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       <div class="row"  id="lunch-options" style="display: none;">
                           <div class="mb-3 col-md-3">
                               <label for="lunch_type" class="form-label"><strong>Lunch Type</strong></label>
                               <select name="lunch_type[]" id="lunch_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3">
                               <label for="lunch_price" class="form-label"><strong>Lunch Price</strong></label>
                               <input type="number" name="lunch_price[]" id="lunch_price" class="form-control" placeholder="Enter price">
                           </div>
                       </div>

                       <!-- Dinner -->
                       <div class="mb-3 col-md-3">
                           <label for="dinner" class="form-label"><strong>Dinner</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="dinner[]" id="dinner" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       <div class="row" id="dinner-options" style="display: none;">
                           <div class="mb-3 col-md-3">
                               <label for="dinner_type" class="form-label"><strong>Dinner Type</strong></label>
                               <select name="dinner_type[]" id="dinner_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3">
                               <label for="dinner_price" class="form-label"><strong>Dinner Price</strong></label>
                               <input type="number" name="dinner_price[]" id="dinner_price" class="form-control" placeholder="Enter price">
                           </div>
                       </div>
                        <div class="form-check form-switch">
                           <label for="breakfast_included" class="form-label"><strong>Breakfast included</strong></label>
                           <span style="color: red; font-weight: bold;">*</span>
                           <input class="mb-4 form-check-input" name="breakfast_included" type="checkbox" id="breakfast_included" value="1">
                           <label class="form-check-label"></label>
                           @error('brakfast_included')
                              <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <input type="text" class="form-control" name="addCounter" id="addCounter">
                        <input type="text" class="form-control" name="deleteCounter" id="deleteCounter">


                        <!-- Bed types -->
                        <div>
                           <input type="checkbox" id="king-bed" class="bed-type-checkbox" data-type="king-bed">
                           <label for="king-bed">King Bed</label>
                           <hr>
                       </div>
                       <div class="insert_king_bed_fields bed-fields" id="king-bed-fields"></div>
                       
                       <div>
                           <input type="checkbox" id="queen-bed" class="bed-type-checkbox" data-type="queen-bed">
                           <label for="queen-bed">Queen Bed</label>
                           <hr>
                       </div>
                       <div class="insert_queen_bed_fields bed-fields" id="queen-bed-fields"></div>
                       
                       <div>
                           <input type="checkbox" id="twin-bed" class="bed-type-checkbox" data-type="twin-bed">
                           <label for="twin-bed">Twin Bed</label>
                           <hr>
                       </div>
                       <div class="insert_twin_bed_fields bed-fields" id="twin-bed-fields"></div>

                       <div id="add_more_checkboxes"></div><!-- Insert new room types here -->

                       <!-- Add more rooms type -->
                       <div class="mb-3">
                        <button type="button" id="add_more_checkbox" class="btn btn-primary">Add More</button>
                     </div>

                       
                        
                     </div>

                     <label for="charge" class="form-label"><b>Fair And Blackout Price</b><span class="text-danger">*</span></label>
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
   document.addEventListener('DOMContentLoaded', function () {
      // Handle Extra Bed Price
      const extraBedSelect = document.getElementById('extra_bed');
      const extraBedPrice = document.querySelector('.extra-bed-price');
         if(extraBedSelect){
            extraBedSelect.addEventListener('change', function () {
            if (this.value === '1') {
               extraBedPrice.style.display = 'block';
            } else {
               extraBedPrice.style.display = 'none';
            }
         });
      }
      

      // Handle Child Cot Price
      const childCotSelect = document.getElementById('child_cot');
      const childCotPrice = document.querySelector('.child-cot-price');

      if(childCotSelect){
         childCotSelect.addEventListener('change', function () {
            if (this.value === '1') {
               childCotPrice.style.display = 'block';
            } else {
               childCotPrice.style.display = 'none';
            }
         });
      }
      
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

<!-- Food availabity -->
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
   toggleOptions('booking_available', '12_hours_booking_price');
</script>

<!-- Add checkbox contents -->

<script>
   
   const baseWeekdayPrice = document.getElementById('base-weekday-price');
   const baseWeekendPrice = document.getElementById('base-weekend-price');

   //Function to toggle visibility of price fields
   const togglePriceField = (dropdownId, priceFieldClass) => {
      const dropdown = document.getElementById(dropdownId);
      const priceField = document.querySelector(`.${priceFieldClass}`);
    
      if (dropdown && priceField) {
         priceField.style.display = dropdown.value === "1" ? "block" : "none";
      }
   };


   document.addEventListener('DOMContentLoaded', () => {
       
      let track = 0;
      let counter = 0;
      let checkboxCounter = 0
      let delCounter = 0;
         // Function to add checkbox fields dynamically
         const addFields = (bedType, containerId) => {
            counter=counter+1;
         
            const container = document.getElementById(containerId);
            container.innerHTML = `
               <div class="row">
                   
                   <div class="mb-3 col-md-3">
                       <label for="${bedType}-no-rooms" class="form-label"><strong>No. of Rooms</strong></label>
                       <input type="number" name="${bedType}[${track}][no_rooms]" id="${bedType}-no-rooms${counter}" class="form-control" placeholder="Enter number of rooms">
                   </div>
                    <div class="mb-3 col-md-3">
                        <label for="${bedType}-max-occupancy" class="form-label"><strong>Maximum Occupancy</strong></label>
                        <input type="number" name="${bedType}[${track}][max_occupancy]" id="${bedType}-occupancy${counter}" class="form-control" placeholder="Enter maximum occupancy">
                    </div>
                    <div class="col-md-3 mb-3">
                           <label for="adult" class="form-label"><strong>Adults</strong><span class="text-danger">*</span></label>
                           <select id="${bedType}-adult${counter}" class="form-control" name="${bedType}[${track}][adult_count]" disabled>
                              <option value="">Select Adults</option>
                           </select>
                           @error('adult_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                           <label for="child" class="form-label"><strong>Children</strong><span class="text-danger">*</span></label>
                           <select id="${bedType}-child${counter}" class="form-control" name="${bedType}[${track}][child_count]" disabled>
                              <option value="">Select Children</option>
                           </select>
                           @error('child_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="${bedType}-extra-bed" class="form-label"><strong>Extra Bed</strong><span class="text-danger">*</span></label>
                           <select name="${bedType}[${track}][extra_bed]" id="${bedType}-extra-bed${counter}" class="form-control"
                              onchange="togglePriceField('${bedType}-extra-bed${counter}', '${bedType}-extra-bed-price${counter}')">
                              <option value="">Select One</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                        </div>
                        <div class="col-md-3 mb-3 ${bedType}-extra-bed-price${counter}" style="display: none;">
                            <label for="${bedType}-extra-bed-price" class="form-label"><strong>Extra Bed Price</strong><span class="text-danger">*</span></label>
                            <input type="number" name="${bedType}[${track}][extra_bed_price]" id="${bedType}-extra-bed-price${counter}" class="form-control" placeholder="Enter Price">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="${bedType}-baby-cot" class="form-label"><strong>Baby Cot</strong><span class="text-danger">*</span></label>
                            <select name="${bedType}[${track}][baby_cot]" id="${bedType}-baby-cot${counter}" class="form-control"
                              onchange="togglePriceField('${bedType}-baby-cot${counter}', '${bedType}-baby-cot-price${counter}')">
                                 <option value="">Select One</option>
                                 <option value="1">Yes</option>
                                 <option value="0">No</option>
                              </select>
                        </div>
                        <div class="col-md-3 mb-3 ${bedType}-baby-cot-price${counter}" style="display: none;">
                            <label for="${bedType}-baby-cot-price" class="form-label"><strong>Baby Cot Price</strong><span class="text-danger">*</span></label>
                            <input type="number" name="${bedType}[${track}][baby_cot_price]" id="${bedType}-baby-cot-price${counter}" class="form-control" placeholder="Enter Price">
                        </div>
                        <hr>

                     </div>`;

                // Attach event listeners for Extra Bed and Baby Cot
                  const extraBedSelect = document.getElementById(`${bedType}-extra-bed${counter}`);
                  const extraBedPriceField = document.querySelector(`.${bedType}-extra-bed-price${counter}`);
                  const babyCotSelect = document.getElementById(`${bedType}-baby-cot${counter}`);
                  const babyCotPriceField = document.querySelector(`.${bedType}-baby-cot-price${counter}`);
               attachOccupancyListeners(`${bedType}-occupancy${counter}`, `${bedType}-adult${counter}`, `${bedType}-child${counter}`);
               track++;
         };

       // Event listeners for checkboxes
         const handleCheckboxChange = (e) => {
           const bedType = e.target.name;
           const container = e.target.dataset.type;
           console.log("bed = ", bedType)
           const fieldsContainerId = `${container}-fields`;
           if (e.target.checked) {
            
               addFields(bedType, fieldsContainerId);
           } else {
               document.getElementById(fieldsContainerId).innerHTML = ''; // Clear fields if unchecked
           }
       };

       // Attach initial event listeners to existing checkboxes
       const checkboxes = document.querySelectorAll('.bed-type-checkbox');
       checkboxes.forEach((checkbox) => {
           checkbox.addEventListener('change', handleCheckboxChange);
       });


        // Function to attach listeners to dynamically added fields
         const attachOccupancyListeners = (occupancyId, adultId, childId) => {
           const occupancyInput = document.getElementById(occupancyId);
           const adultDropdown = document.getElementById(adultId);
           const childDropdown = document.getElementById(childId);

           const updateAdultOptions = () => {
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
           };

           const updateChildOptions = () => {
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
           };

           // Add event listeners
           occupancyInput.addEventListener("input", updateAdultOptions);
           adultDropdown.addEventListener("change", updateChildOptions);
       };

       //handle dynamically created

       $('#add_more_checkbox').click(function() {
         checkboxCounter++;
         var checkboxesHTML = `
            <div class="dashed-border" id="appended-fields-${checkboxCounter}">
            <div class="row existing-fields">
               <div class="col-md-3 mb-3">
                  <label for="room_type" class="form-label"><strong>Room Type</strong><span class="text-danger">*</span></label>
                  <input name="room_type[]" id="room_type${checkboxCounter}" class="form-control" placeholder="Enter Room Type" required></input>
                  @error('room_type')
                     <div class="text-danger mt-1">{{ $message }}</div>
                  @enderror
               </div>
        
               <div class="col-md-3 mb-3">
                  <label for="no_of_rooms" class="form-label"><strong>No of Rooms</strong><span class="text-danger">*</span></label>
                  <input type="text" id="no_of_rooms${checkboxCounter}" class="form-control" name="no_of_rooms[]" placeholder="Enter Number of Rooms">
                  @error('no_of_rooms')
                     <div class="text-danger mt-1">{{ $message }}</div>
                  @enderror
               </div>

               <div class="col-md-3 mb-3">
                  <label for="varient_price" class="form-label"><strong>Varient Price</strong><span class="text-danger">*</span></label>
                  <input type="text" id="varient_price${checkboxCounter}" class="form-control varient-price" name="varient_price[]" placeholder="Enter Varient Price...">
                  @error('varient_price')
                     <div class="text-danger mt-1">{{ $message }}</div>
                  @enderror
               </div>
               <div class="mb-3 col-md-3">
                  <label for="base-weekday-price" class="form-label"><strong>Weekday Price</strong></label>
                  <input type="number" name="weekday-price[]" id="weekday-price${checkboxCounter}" class="form-control" placeholder="Enter weekday price" readonly>
               </div>
               <div class="mb-3 col-md-3">
                  <label for="weekend-price" class="form-label"><strong>Weekend Price</strong></label>
                  <input type="number" name="weekend-price[]" id="weekend-price${checkboxCounter}" class="form-control" placeholder="Enter weekend price" readonly>
               </div>
            

                     
                        <div class="mb-3 col-md-3">
                           <label for="breakfast" class="form-label"><strong>Breakfast</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="breakfast[]" id="breakfast" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       
                           <div class="mb-3 col-md-3" id="breakfast-type-options" style="display: none;">
                               <label for="breakfast_type" class="form-label"><strong>Breakfast Type</strong></label>
                               <select name="breakfast_type[]" id="breakfast_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3" id="breakfast-price-options" style="display: none;">
                               <label for="breakfast_price" class="form-label"><strong>Breakfast Price</strong></label>
                               <input type="number" name="breakfast_price[]" id="breakfast_price" class="form-control" placeholder="Enter price">
                           </div>
                       

                       
                       <div class="mb-3 col-md-3">
                           <label for="lunch" class="form-label"><strong>Lunch</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="lunch[]" id="lunch" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       
                           <div class="mb-3 col-md-3" id="lunch-type-options" style="display: none;">
                               <label for="lunch_type" class="form-label"><strong>Lunch Type</strong></label>
                               <select name="lunch_type[]" id="lunch_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3" id="lunch-price-options" style="display: none;">
                               <label for="lunch_price" class="form-label"><strong>Lunch Price</strong></label>
                               <input type="number" name="lunch_price[]" id="lunch_price" class="form-control" placeholder="Enter price">
                           </div>
                       

                       
                       <div class="mb-3 col-md-3">
                           <label for="dinner" class="form-label"><strong>Dinner</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="dinner[]" id="dinner" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       
                           <div class="mb-3 col-md-3" id="dinner-type-options" style="display: none;">
                               <label for="dinner_type" class="form-label"><strong>Dinner Type</strong></label>
                               <select name="dinner_type[]" id="dinner_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3" id="dinner-price-options" style="display: none;">
                               <label for="dinner_price" class="form-label"><strong>Dinner Price</strong></label>
                               <input type="number" name="dinner_price[]" id="dinner_price" class="form-control" placeholder="Enter price">
                           </div>
                       
            </div>
            <div class="form-check form-switch">
                        <label for="breakfast_included" class="form-label"><strong>Breakfast included</strong></label>
                        <span style="color: red; font-weight: bold;">*</span>
                        <input class="mb-4 form-check-input" name="breakfast_included[]" type="checkbox" id="breakfast_included" value="1">
                        <label class="form-check-label"></label>
                        @error('brakfast_included')
                           <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                     </div>

            <div>
                <input name="added-king-bed" type="checkbox" id="added-king-bed${checkboxCounter}" class="bed-type-checkbox" data-type="added-king-bed${checkboxCounter}">
                <label for="added-king-bed">King Bed</label>
                <hr>
            </div>
            <div class="insert_king_bed_fields bed-fields" id="added-king-bed${checkboxCounter}-fields"></div>
            
            <div>
                <input name="added-queen-bed" type="checkbox" id="added-queen-bed${checkboxCounter}" class="bed-type-checkbox" data-type="added-queen-bed${checkboxCounter}">
                <label for="added-queen-bed">Queen Bed</label>
                <hr>
            </div>
            <div class="insert_queen_bed_fields bed-fields" id="added-queen-bed${checkboxCounter}-fields"></div>
            
            <div>
                <input name="added-twin-bed" type="checkbox" id="added-twin-bed${checkboxCounter}" class="bed-type-checkbox" data-type="added-twin-bed${checkboxCounter}">
                <label for="added-twin-bed">Twin Bed</label>
                <hr>
            </div>
            <div class="insert_twin_bed_fields bed-fields" id="added-twin-bed${checkboxCounter}-fields"></div>
            <div class="col-12 text-end mb-2">
                <button type="button" class="btn btn-danger remove-button" data-target="#appended-fields-${checkboxCounter}">
                    Delete Fields
                </button>
            </div>
         </div>
        `;

        document.getElementById('add_more_checkboxes').insertAdjacentHTML('beforeend', checkboxesHTML);
         // Attach event listener to the delete button
         document.querySelector(`#appended-fields-${checkboxCounter} .remove-button`).addEventListener('click',   function () {
            delCounter++;
            const deleteCounterElement = document.getElementById('deleteCounter');
            deleteCounterElement.value = delCounter;
            const target = this.getAttribute('data-target');
            document.querySelector(target).remove();
         });

        // Attach listener to the newly added checkbox
        

        document.getElementById(`added-king-bed${checkboxCounter}`).addEventListener('change', handleCheckboxChange);
        document.getElementById(`added-queen-bed${checkboxCounter}`).addEventListener('change', handleCheckboxChange);
        document.getElementById(`added-twin-bed${checkboxCounter}`).addEventListener('change', handleCheckboxChange);

        const addCounterElement = document.getElementById('addCounter');
        addCounterElement.value = checkboxCounter;
        
    
    });

    $('#add_more_checkboxes').on('input', '.varient-price', function (event) {
        const varientPriceInput = event.target; // Get the input element
        const varientPriceValue = parseFloat(varientPriceInput.value) || 0; // Parse the value or set to 0

        // Find related fields using their IDs
        const sectionId = varientPriceInput.id.replace('varient_price', '');

        const weekdayPriceInput = $(`#weekday-price${sectionId}`);
        const weekendPriceInput = $(`#weekend-price${sectionId}`);

        const base_weekday_price = parseFloat(baseWeekdayPrice.value) || 0;
        const base_weekend_price = parseFloat(baseWeekendPrice.value) || 0;

        //calculate weekday and weekend prices
        const finalWeekdayPrice = varientPriceValue+base_weekday_price;
        const finalWeekendPrice = varientPriceValue+base_weekend_price;


        // Populate the related fields
        weekdayPriceInput.val(finalWeekdayPrice.toFixed(2));
        weekendPriceInput.val(finalWeekendPrice.toFixed(2));
    });


    // Handle Extra Bed Price
    const extraBedSelect = document.getElementById('extra_bed');
      const extraBedPrice = document.querySelector('.extra-bed-price');
         if(extraBedSelect){
            extraBedSelect.addEventListener('change', function () {
            if (this.value === '1') {
               extraBedPrice.style.display = 'block';
            } else {
               extraBedPrice.style.display = 'none';
            }
         });
      }
      

      // Handle Child Cot Price
      const childCotSelect = document.getElementById('child_cot');
      const childCotPrice = document.querySelector('.child-cot-price');

      if(childCotSelect){
         childCotSelect.addEventListener('change', function () {
            if (this.value === '1') {
               childCotPrice.style.display = 'block';
            } else {
               childCotPrice.style.display = 'none';
            }
         });
      }

      if(extraBedPriceField !=null){
            extraBedSelect.addEventListener('change', () => {
               extraBedPriceField.style.display = extraBedSelect.value === "1" ? "block" : "none";
            });
      }
               
      if(babyCotPriceField){
         babyCotSelect.addEventListener('change', () => {
            babyCotPriceField.style.display = babyCotSelect.value === "1" ? "block" : "none";
         });
      }
               
   });

   //Handle dynamically added food fields
   $(document).on('change', '#add_more_checkboxes select[name$="[]"]', function () {
    const meal = $(this).attr('name').replace('[]', '');
    const optionsId1 = `${meal}-type-options`;
    const optionsId2 = `${meal}-price-options`;
    const optionsContainer1 = $(this).closest('.existing-fields').find(`#${optionsId1}`);
    const optionsContainer2 = $(this).closest('.existing-fields').find(`#${optionsId2}`);
    if (this.value === '1') {
        optionsContainer1.show();
        optionsContainer2.show();
    } else {
        optionsContainer1.hide().find('input, select').val('');
        optionsContainer2.hide().find('input, select').val('');
    }
   });

</script>

<!-- Add more checkbox groups -->

@endsection

<style>
   .dashed-border {
    border: 2px dashed #ccc;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px; /* or more */
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.15);
}

</style>