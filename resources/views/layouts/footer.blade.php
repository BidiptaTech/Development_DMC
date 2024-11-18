        <footer class="footer bg-light py-3 mt-4">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Left Column -->
                    <div class="col-md-6 text-center text-md-start">
                        <span>
                            <script>document.write(new Date().getFullYear())</script> 
                            © Adminox - By <strong class="text-uppercase">Coderthemes</strong>
                        </span>
                    </div>
                    <!-- Right Column -->
                    <div class="col-md-6 text-center text-md-end">
                        <a href="#" class="text-decoration-none me-3">About</a>
                        <a href="#" class="text-decoration-none me-3">Support</a>
                        <a href="#" class="text-decoration-none">Contact Us</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/vendor/fullcalendar/index.global.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/apps-calendar.js') }}"></script>
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
                    url: `/api/hotels/${hotelId}/facilities`,
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
                                            id="facility_${facility.id}" 
                                            value="${facility.id}"
                                        >
                                        <label class="form-check-label" for="facility_${facility.id}">
                                            ${facility.name}
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

