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

                     <div class="row container">
                        <!-- Room Type -->
                        <div class="col-md-3 mb-3" id="base_room_type" style="display: none;">
                           <label for="room_type" class="form-label"><strong>Base Room Type</strong><span class="text-danger">*</span></label>
                           <input type="text" name="base_room_type" class="form-control" placeholder="Enter Base Room Type"></input>
                           @error('room_type')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Number of Rooms -->
                        <div class="col-md-3 mb-3">
                           <label for="no_of_room" class="form-label"><strong>Total No of Rooms</strong><span class="text-danger">*</span></label>
                           <input type="number" class="form-control" name="total_no_of_room" placeholder="Enter Number of Rooms" id="total_rooms">
                           @error('total_no_of_room')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
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

                       <!-- dimension -->
                        <div class="mb-3 col-md-3" id="dimension">
                           <label for="weekend_price" class="form-label"><strong>Dimension</strong></label>
                           <input type="text" name="dimension" class="form-control" placeholder="length x breadth">
                        </div>

                        <!-- Breakfast -->
                        <div class="mb-3 col-md-3">
                           <label for="breakfast" class="form-label"><strong>Breakfast</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="breakfast" id="breakfast" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       <div class="row" id="breakfast-options" style="display: none;">
                           <div class="mb-3 col-md-3">
                               <label for="breakfast_type" class="form-label"><strong>Breakfast Type</strong></label>
                               <select name="breakfast_type" id="breakfast_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3">
                               <label for="breakfast_price" class="form-label"><strong>Breakfast Price</strong></label>
                               <input type="number" name="breakfast_price" id="breakfast_price" class="form-control" placeholder="Enter price">
                           </div>
                       </div>

                       <!-- Lunch -->
                       <div class="mb-3 col-md-3">
                           <label for="lunch" class="form-label"><strong>Lunch</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="lunch" id="lunch" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       <div class="row" id="lunch-options" style="display: none;">
                           <div class="mb-3 col-md-3">
                               <label for="lunch_type" class="form-label"><strong>Lunch Type</strong></label>
                               <select name="lunch_type" id="lunch_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3">
                               <label for="lunch_price" class="form-label"><strong>Lunch Price</strong></label>
                               <input type="number" name="lunch_price" id="lunch_price" class="form-control" placeholder="Enter price">
                           </div>
                       </div>

                       <!-- Dinner -->
                       <div class="mb-3 col-md-3">
                           <label for="dinner" class="form-label"><strong>Dinner</strong><span style="color: red; font-weight: bold;">*</span></label>
                           <select name="dinner" id="dinner" class="form-control" required>
                               <option value="">Select an option</option>
                               <option value="1">Available</option>
                               <option value="0">Not Available</option>
                           </select>
                       </div>

                       <div class="row" id="dinner-options" style="display: none;">
                           <div class="mb-3 col-md-3">
                               <label for="dinner_type" class="form-label"><strong>Dinner Type</strong></label>
                               <select name="dinner_type" id="dinner_type" class="form-control">
                                   <option value="">Select a type</option>
                                   <option value="0">Buffet</option>
                                   <option value="1">Set Buffet</option>
                               </select>
                           </div>
                           <div class="mb-3 col-md-3">
                               <label for="dinner_price" class="form-label"><strong>Dinner Price</strong></label>
                               <input type="number" name="dinner_price" id="dinner_price" class="form-control" placeholder="Enter price">
                           </div>
                       </div>

                       <div class="mb-3 col-md-4">
                           <label for="images" class="form-label"><strong>Additional Images</strong></label>
                           <div id="drop-area" class="form-control" style="padding: 20px; border: 2px dashed #007bff; text-align: center;">
                              Drag & Drop your files here or click to upload.
                              <input type="file" id="images" name="images[]" multiple style="display: none;">
                           </div>
                           <div id="preview-container" class="mt-3 d-flex flex-wrap gap-2" style="max-width: 100%; overflow-x: auto; white-space: nowrap;"></div>
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

                        <!-- Bed types -->
                        <div>
                           <input type="checkbox" id="king-bed" class="bed-type-checkbox" name="bed_type[]" value="King_bed">
                           <label for="king-bed">King Bed</label>
                           <hr>
                       </div>
                       <div name="king_bed" class="insert_king_bed_fields bed-fields" id="king-bed-fields"></div>
                       
                       <div>
                           <input type="checkbox" id="queen-bed" class="bed-type-checkbox" name="bed_type[]" value="Queen_bed">
                           <label for="queen-bed">Queen Bed</label>
                           <hr>
                       </div>
                       <div name="queen_bed" class="insert_queen_bed_fields bed-fields" id="queen-bed-fields"></div>
                       
                       <div>
                           <input type="checkbox" id="twin-bed" class="bed-type-checkbox" name="bed_type[]" value="Twin_bed">
                           <label for="twin-bed">Twin Bed</label>
                           <hr>
                       </div>
                       <div name="twin_bed" class="insert_twin_bed_fields bed-fields" id="twin-bed-fields"></div>
                        
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

                        <a href="{{ route('hotels.rates', $hotel->id) }}" class="btn btn-primary px-4">Next</a>
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
                        <th>No of Rooms</th>
                        <th>Weekday Price</th>
                        <th>Weekend Price</th>
                        <th>Varient Price</th>
                        <th>Extra Bed</th>
                        
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($rooms as $room)
                     <tr>
                        <td>"{{$room->room_type}}"</td>
                        <td>{{ $room->no_of_room }}</td>
                        <td>{{ $room->weekday_price }}</td>
                        <td>{{ $room->weekend_price }}</td>
                        <td>{{ $room->varient_price }}</td>
                        <td>
                           @if($room->extra_bed === 1)
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
                  <input type="text" class="form-control" name="event" placeholder="Enter Event Name">
               </div>
               <div class="col-md-3 mb-3">
                  <label for="event_type" class="form-label"><strong>Event Type</strong></label>
                  <select class="form-control" name="event_type">
                     <option value="">Select Event Type</option>
                     <option value="Fair Date">Fair Date</option>
                     <option value="Blackout Date">Blackout Date</option>
                  </select>
               </div>
               <div class="col-md-3 mb-3">
                  <label for="price" class="form-label"><strong>Price</strong></label>
                  <input type="number" class="form-control" name="price" placeholder="Enter Price">
               </div>
               <div class="col-md-3 mb-3">
                  <label for="start_date" class="form-label"><strong>Start Date</strong></label>
                  <input type="date" class="form-control" name="start_date">
               </div>
               <div class="col-md-3 mb-3">
                  <label for="end_date" class="form-label"><strong>End Date</strong></label>
                  <input type="date" class="form-control" name="end_date">
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

       if(select){
         select.addEventListener('change', function () {
           if (this.value === '1') {
               // Show options if "Available" is selected
               if (optionsContainer.children.length === 0) {
                   // Append the options dynamically using insertAdjacentHTML
                   const optionContent = `
                       <div class="mb-3 col-md-3">
                           <label for="${meal}_type" class="form-label"><strong>${meal.charAt(0).toUpperCase() + meal.slice(1)} Type</strong></label>
                           <select name="${meal}_type" id="${meal}_type" class="form-control">
                               <option value="">Select a type</option>
                               <option value="0">Buffet</option>
                               <option value="1">Set Buffet</option>
                           </select>
                       </div>
                       <div class="mb-3 col-md-3">
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

       select.addEventListener('change', function () {
           if (this.value === '1') {
               // Show options if "Available" is selected
               if (optionsContainer.children.length === 0) {
                   // Append the options dynamically using insertAdjacentHTML
                   const optionContent = `
                       <div class="mb-3 col-md-3">
                           <label for="${meal}_type" class="form-label"><strong>${meal.charAt(0).toUpperCase() + meal.slice(1)} Type</strong></label>
                           <select name="${meal}_type" id="${meal}_type" class="form-control">
                               <option value="">Select a type</option>
                               <option value="0">Buffet</option>
                               <option value="1">Set Buffet</option>
                           </select>
                       </div>
                       <div class="mb-3 col-md-3">
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

   const totalRooms = document.getElementById('total_rooms');
      let total_no_of_room = 0;
      let count = 0;
      let rooms_no = 0;
      let kingbeds = 0;
      let queenbeds = 0;
      let twinbeds = 0;
      let king_rooms_no = 0;
      let queen_rooms_no = 0;
      let twin_rooms_no = 0;



      
   
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

      totalRooms.addEventListener('input', function() {
         const kingBedInput = document.getElementById('king-bed');
         const queenBedInput = document.getElementById('queen-bed');
         const twinBedInput = document.getElementById('twin-bed');
         count = totalRooms.value;
         king_rooms_no = 0;
         queen_rooms_no = 0;
         twin_rooms_no = 0;
         if (kingBedInput && kingBedInput.checked) {
            kingBed('king-bed');
         }
         if (queenBedInput && queenBedInput.checked) {
            queenBed('queen-bed');
         }
         if (twinBedInput && twinBedInput.checked) {
            twinBed('twin-bed');
         }
      });

      let track = 0;
      let counter = 0;
      let checkboxCounter = 0
      let delCounter = 0;

      //** Start of dynamic Room Counts */


      function clearValue(bedType){
         if(bedType == 'king-bed'){
            king_rooms_no = 0;
         }
         else if(bedType == 'queen-bed'){

            queen_rooms_no = 0;
         }
         else if(bedType == 'twin-bed'){
            twin_rooms_no = 0;
         }
      }

      function kingBed(bedType){
         const currentBed = document.getElementById(`${bedType}-no-rooms`);
         currentBed.innerHTML = `<option value="">Select a value</option>`;
         if(queen_rooms_no==0 && twin_rooms_no ==0){
               king_rooms_no = count;
         }
            
            else if(queen_rooms_no != 0 && twin_rooms_no != 0){
               king_rooms_no = count - (queen_rooms_no + twin_rooms_no);
            }
            else if(queen_rooms_no != 0 && twin_rooms_no == 0){
               king_rooms_no = count-queen_rooms_no;
            }
            else if(queen_rooms_no == 0 && twin_rooms_no != 0){
               king_rooms_no = count-twin_rooms_no;
            }
            
            
            for (let i = 0; i <= king_rooms_no; i++) {
               const option = document.createElement('option');
               option.value = i;
               option.innerHTML = i;
               currentBed.appendChild(option);
            }
            console.log('Checkbox was checked.');

         currentBed.addEventListener('change', function () {
            const selectedValue = currentBed.value;
            const totalRooms = parseInt(total_no_of_room, 10) || 0;
            const selectValue = parseInt(selectedValue, 10) || 0;
            king_rooms_no = selectValue;

            console.log(`Selected value: ${count} --- ${king_rooms_no}`);

            const queenBedElement = document.getElementById('queen-bed-no-rooms');
            const twinBedElement = document.getElementById('twin-bed-no-rooms');
            queen_rooms_no = 0;
            twin_rooms_no = 0;

            if(queenBedElement){
               
               console.log("queen bed exist");
               queenBed('queen-bed')
            }
            if(twinBedElement){
               
               twinBed('twin-bed')
            }
            
         });
         
      }

      function queenBed(bedType){
         const currentBed = document.getElementById(`${bedType}-no-rooms`);
            currentBed.innerHTML = `<option value="">Select a value</option>`;

            if(twin_rooms_no==0 && king_rooms_no ==0){
               queen_rooms_no = count;
            }
            
            else if(king_rooms_no != 0 && twin_rooms_no != 0){
               queen_rooms_no = count - (king_rooms_no + twin_rooms_no);
            }
            else if(king_rooms_no != 0 && twin_rooms_no == 0){
               queen_rooms_no = count - king_rooms_no;
            }
            else if(king_rooms_no == 0 && twin_rooms_no != 0){
               queen_rooms_no = count - twin_rooms_no;
            }
            
            
            for (let i = 0; i <= queen_rooms_no; i++) {
               const option = document.createElement('option');
               option.value = i;
               option.innerHTML = i;
               currentBed.appendChild(option);
            }
            console.log('Checkbox was checked.');

         currentBed.addEventListener('change', function () {
            const selectedValue = currentBed.value;
            const totalRooms = parseInt(total_no_of_room, 10) || 0;
            const selectValue = parseInt(selectedValue, 10) || 0;
            queen_rooms_no = selectValue;
            console.log(`Selected value: ${count}`);
            // You can perform any action with the selected value here
            const bedElement = document.getElementById('twin-bed-no-rooms');
            if(bedElement){
               twin_rooms_no = 0;
               console.log("twin bed exist");
               twinBed('twin-bed')
            }
         });
         
      }

      function twinBed(bedType){
         const currentBed = document.getElementById(`${bedType}-no-rooms`);
         currentBed.innerHTML = `<option value="">Select a value</option>`; 
            
            if(queen_rooms_no==0 && king_rooms_no ==0){
               twin_rooms_no = count;
            }
            
            else if(queen_rooms_no != 0 && king_rooms_no != 0){
               twin_rooms_no = count - (queen_rooms_no + king_rooms_no);
            }
            else if(queen_rooms_no != 0 && king_rooms_no == 0){
               twin_rooms_no = count-queen_rooms_no;
            }
            else if(queen_rooms_no == 0 && king_rooms_no != 0){
               twin_rooms_no = count-king_rooms_no;
            }
            
            
            for (let i = 0; i <= twin_rooms_no; i++) {
               const option = document.createElement('option');
               option.value = i;
               option.innerHTML = i;
               currentBed.appendChild(option);
            }
            console.log('Checkbox was checked.');

         currentBed.addEventListener('change', function () {
            const selectedValue = currentBed.value;
            const totalRooms = parseInt(total_no_of_room, 10) || 0;
            const selectValue = parseInt(selectedValue, 10) || 0;
            twin_rooms_no = selectValue;
            console.log(`Selected value: ${count}`);
            // You can perform any action with the selected value here
         });
      }

      const updateRoomCounts = () => {
         const remainingRooms = totalRoomCount - (king_rooms_no + queen_rooms_no + twin_rooms_no);
         return Math.max(remainingRooms, 0);
  };
      

      /***End of dynamic room counts  ***/


      // Function to add checkbox fields dynamically
         const addFields = (bedType, containerId) => {
            counter=counter+1;
            console.log("Bed type from add fields = ", bedType);
         
            const container = document.getElementById(containerId);
            container.innerHTML = `
               <div class="row">
                   
                   <div class="mb-3 col-md-3">
                       <label for="${bedType}-no-rooms" class="form-label"><strong>No. of Rooms</strong><span class="text-danger">*</span></label>
                       <select type="number" name="no_of_rooms[]" id="${bedType}-no-rooms" class="form-control" placeholder="Enter number of rooms">
                           <option> Select a value </option>
                       </select>
                        @error('${bedType}_adult_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                   </div>
                    <div class="mb-3 col-md-3">
                        <label for="${bedType}-max-occupancy" class="form-label"><strong>Maximum Occupancy</strong><span class="text-danger">*</span></label>
                        <input type="number" name="max_occupancy[]" id="${bedType}-occupancy" class="form-control" placeholder="Enter maximum occupancy">
                    </div>
                    <div class="col-md-3 mb-3">
                           <label for="${bedType}-adult" class="form-label"><strong>Adults</strong><span class="text-danger">*</span></label>
                           <select id="${bedType}-adult" class="form-control" name="adult_count[]" disabled>
                              <option value="">Select Adults</option>
                           </select>
                           @error('${bedType}_adult_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                           <label for=""${bedType}-child" class="form-label"><strong>Children</strong><span class="text-danger">*</span></label>
                           <select id="${bedType}-child" class="form-control" name="child_count[]" disabled>
                              <option value="">Select Children</option>
                           </select>
                           @error('${bedType}_child_count')
                           <div class="text-danger mt-1">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                           <label for="${bedType}-extra-bed" class="form-label"><strong>Extra Bed</strong><span class="text-danger">*</span></label>
                           <select name="extra_bed[]" id="${bedType}-extra-bed" class="form-control"
                              onchange="togglePriceField('${bedType}-extra-bed', '${bedType}-extra-bed-price')">
                              <option value="">Select One</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                        </div>
                        <div class="col-md-3 mb-3 ${bedType}-extra-bed-price" style="display: none;">
                            <label for="${bedType}-extra-bed-price" class="form-label"><strong>Extra Bed Price</strong><span class="text-danger">*</span></label>
                            <input type="number" name="extra_bed_price[]" id="${bedType}-extra-bed-price" class="form-control" placeholder="Enter Price">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="${bedType}-baby-cot" class="form-label"><strong>Baby Cot</strong><span class="text-danger">*</span></label>
                            <select name="baby_cot[]" id="${bedType}-baby-cot" class="form-control"
                              onchange="togglePriceField('${bedType}-baby-cot', '${bedType}-baby-cot-price')">
                                 <option value="">Select One</option>
                                 <option value="1">Yes</option>
                                 <option value="0">No</option>
                              </select>
                        </div>
                        <div class="col-md-3 mb-3 ${bedType}-baby-cot-price" style="display: none;">
                            <label for="${bedType}-baby-cot-price" class="form-label"><strong>Baby Cot Price</strong><span class="text-danger">*</span></label>
                            <input type="number" name="baby_cot_price[]" id="${bedType}-baby-cot-price" class="form-control" placeholder="Enter Price">
                        </div>
                        <hr>
                     </div>`;

                // Attach event listeners for Extra Bed and Baby Cot
                  const extraBedSelect = document.getElementById(`${bedType}-extra-bed`);
                  const extraBedPriceField = document.querySelector(`.${bedType}-extra-bed-price`);
                  const babyCotSelect = document.getElementById(`${bedType}-baby-cot`);
                  const babyCotPriceField = document.querySelector(`.${bedType}-baby-cot-price`);
               attachOccupancyListeners(`${bedType}-occupancy`, `${bedType}-adult`, `${bedType}-child`);
               track++;
         };

       // Event listeners for checkboxes
         const handleCheckboxChange = (e) => {
           const bedType = e.target.name;
           const container = e.target.id;

           const fieldsContainerId = `${container}-fields`;
           console.log("bed = ", fieldsContainerId);

           if (e.target.checked) {
               addFields(container, fieldsContainerId);

               if(container === 'king-bed'){
                  const kingBedType = document.getElementById('king-bed-no-rooms');
                     
                     kingBed(container);
               }

               else if(container === 'queen-bed'){
                  const queenBedType = document.getElementById('queen-bed-no-rooms');
                     queenBed(container);                  
               }

               else if(container === 'twin-bed'){
                  const twinBedType = document.getElementById('twin-bed-no-rooms');
                     twinBed(container);
               }

           } 
           else {
               document.getElementById(fieldsContainerId).innerHTML = ''; // Clear fields if unchecked
               clearValue(container);
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
   // $(document).on('change', '#add_more_checkboxes select[name$="[]"]', function () {
   //  const meal = $(this).attr('name').replace('[]', '');
   //  const optionsId1 = `${meal}-type-options`;
   //  const optionsId2 = `${meal}-price-options`;
   //  const optionsContainer1 = $(this).closest('.existing-fields').find(`#${optionsId1}`);
   //  const optionsContainer2 = $(this).closest('.existing-fields').find(`#${optionsId2}`);
   //  if (this.value === '1') {
   //      optionsContainer1.show();
   //      optionsContainer2.show();
   //  } else {
   //      optionsContainer1.hide().find('input, select').val('');
   //      optionsContainer2.hide().find('input, select').val('');
   //  }
   // });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get hotel data from server-rendered Blade variable
        const room = @json($rooms);
        console.log("Hello from rooms = ", room);

        if (Array.isArray(room) && room.length > 0) {
            // Hide the specified base divs
            document.getElementById('base_room_type').style.display = "none";
            document.getElementById('base_weekday_price').style.display = "none";
            document.getElementById('base_weekend_price').style.display = "none";

            // Create new divs without "base" prefix
            const container = document.querySelector('.container');

            const newRoomTypeDiv = document.createElement('div');
            newRoomTypeDiv.className = 'col-md-3 mb-3';
            newRoomTypeDiv.id = 'room_type_wrapper';
            newRoomTypeDiv.innerHTML = `
                <label for="room_type" class="form-label"><strong>Room Type</strong><span class="text-danger">*</span></label>
                <input name="room_type" id="room_type_input" class="form-control" placeholder="Enter Room Type" required>
            `;

            const varientPrice = document.createElement('div');
            varientPrice.className = 'col-md-3 mb-3';
            varientPrice.id = 'varient_price';
            varientPrice.innerHTML = `
                <label for="varient_price" class="form-label"><strong>Variant Price</strong><span class="text-danger">*</span></label>
                <input name="varient_price" id="varient_price_input" class="form-control" placeholder="Enter Variance Price" required>
            `;

            const newWeekdayPriceDiv = document.createElement('div');
            newWeekdayPriceDiv.className = 'mb-3 col-md-3';
            newWeekdayPriceDiv.id = 'weekday_price';
            newWeekdayPriceDiv.innerHTML = `
                <label for="weekday_price" class="form-label"><strong>Weekday Price</strong></label>
                <input type="number" name="weekday_price" id="weekday_price_input" class="form-control" placeholder="Enter Weekday Price" readonly>
            `;

            const newWeekendPriceDiv = document.createElement('div');
            newWeekendPriceDiv.className = 'mb-3 col-md-3';
            newWeekendPriceDiv.id = 'weekend_price';
            newWeekendPriceDiv.innerHTML = `
                <label for="weekend_price" class="form-label"><strong>Weekend Price</strong></label>
                <input type="number" name="weekend_price" id="weekend_price_input" class="form-control" placeholder="Enter Weekend Price" readonly>
            `;

            // Insert the new divs at the top of the container
            container.prepend(newWeekendPriceDiv);
            container.prepend(newWeekdayPriceDiv);
            container.prepend(varientPrice);
            container.prepend(newRoomTypeDiv);

            // Populate initial values for weekday and weekend prices
            const weekdayPriceInput = document.getElementById('weekday_price_input');
            const weekendPriceInput = document.getElementById('weekend_price_input');
            const varientPriceInput = document.getElementById('varient_price_input');

            // Assuming only one room object is used for data population
            weekdayPriceInput.value = room[0]?.weekday_price || 0;
            weekendPriceInput.value = room[0]?.weekend_price || 0;

            // Update prices dynamically based on variance price
            varientPriceInput.addEventListener('input', function () {
                const varientValue = parseFloat(varientPriceInput.value) || 0; // Default to 0 if input is invalid
                weekdayPriceInput.value = (parseFloat(room[0]?.weekday_price || 0) + varientValue).toFixed(2);
                weekendPriceInput.value = (parseFloat(room[0]?.weekend_price || 0) + varientValue).toFixed(2);
            });
        } else {
            // Show base divs if no room data is available
            document.getElementById('base_room_type').style.display = "block";
            document.getElementById('base_weekday_price').style.display = "block";
            document.getElementById('base_weekend_price').style.display = "block";
        }
    });
</script>
<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('images');
    const previewContainer = document.getElementById('preview-container');
    let fileCounter = 0; // Track total uploaded files
    const MAX_VISIBLE_IMAGES = 3; // Show up to 3 images

    // Open file picker on click
    dropArea.addEventListener('click', () => fileInput.click());

    // Handle drag events
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = '#e3f2fd';
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.style.backgroundColor = 'white';
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = 'white';
        handleFiles(e.dataTransfer.files);
    });

    // Handle file input change
    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    // Process and display files
    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    fileCounter++;
                    addImagePreview(e.target.result);
                };
                reader.readAsDataURL(file);
            } else {
                alert(`${file.name} is not a valid image file.`);
            }
        });
    }

    // Add image preview with limited visibility and a "more" badge
    function addImagePreview(imageSrc) {
        const imageWrapper = document.createElement('div');
        imageWrapper.style.position = 'relative';
        imageWrapper.style.width = '70px';
        imageWrapper.style.height = '70px';
        imageWrapper.style.margin = '5px';
        imageWrapper.style.overflow = 'hidden';
        imageWrapper.style.borderRadius = '5px';
        imageWrapper.style.display = fileCounter > MAX_VISIBLE_IMAGES ? 'none' : 'inline-block';

        const img = document.createElement('img');
        img.src = imageSrc;
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';

        const deleteButton = document.createElement('button');
        deleteButton.textContent = '×';
        deleteButton.style.position = 'absolute';
        deleteButton.style.top = '2px';
        deleteButton.style.right = '2px';
        deleteButton.style.background = 'rgba(255, 0, 0, 0.8)';
        deleteButton.style.color = 'white';
        deleteButton.style.border = 'none';
        deleteButton.style.borderRadius = '50%';
        deleteButton.style.cursor = 'pointer';
        deleteButton.style.width = '20px';
        deleteButton.style.height = '20px';
        deleteButton.style.fontSize = '12px';
        deleteButton.style.lineHeight = '16px';
        deleteButton.addEventListener('click', () => {
            previewContainer.removeChild(imageWrapper);
            fileCounter--;
            updateMoreBadge();
        });

        imageWrapper.appendChild(img);
        imageWrapper.appendChild(deleteButton);
        previewContainer.appendChild(imageWrapper);

        updateMoreBadge();
    }

    // Create and update "+X more" badge
    function updateMoreBadge() {
        // Remove any existing badge
        const existingBadge = document.getElementById('more-badge');
        if (existingBadge) existingBadge.remove();

        if (fileCounter > MAX_VISIBLE_IMAGES) {
            const moreBadge = document.createElement('div');
            moreBadge.id = 'more-badge';
            moreBadge.textContent = `+${fileCounter - MAX_VISIBLE_IMAGES} more`;
            moreBadge.style.margin = '5px';
            moreBadge.style.padding = '5px 10px';
            moreBadge.style.backgroundColor = '#007bff';
            moreBadge.style.color = 'white';
            moreBadge.style.borderRadius = '5px';
            moreBadge.style.cursor = 'pointer';
            moreBadge.style.fontSize = '12px';
            moreBadge.style.textAlign = 'center';
            moreBadge.addEventListener('click', () => {
                // Show all hidden images
                const hiddenImages = previewContainer.querySelectorAll('div[style*="display: none"]');
                hiddenImages.forEach(img => img.style.display = 'inline-block');
                moreBadge.remove(); // Remove badge after revealing all
            });
            previewContainer.appendChild(moreBadge);
        }
    }
</script>

@endsection
