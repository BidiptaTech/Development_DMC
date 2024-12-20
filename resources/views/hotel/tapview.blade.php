<ul class="nav nav-pills mb-4 mt-4 d-flex justify-content-center" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-hotel-tab" data-bs-toggle="pill" href="{{ route('hotels.create') }}" 
            role="tab" aria-controls="pills-hotel" aria-selected="true">
            Hotel Details
        </a>

    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="{{ route('hotels.contact'), $id }}" 
            role="tab" aria-controls="pills-contact" aria-selected="false">
            Contact Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-room-tab" data-bs-toggle="pill" href="#pills-room" 
            role="tab" aria-controls="pills-room" aria-selected="false">
            Room Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-season-tab" data-bs-toggle="pill" href="#pills-season" 
            role="tab" aria-controls="pills-season" aria-selected="false">
            Season Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-event-tab" data-bs-toggle="pill" href="#pills-event" 
            role="tab" aria-controls="pills-event" aria-selected="false">
            Event Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-calendar-tab" data-bs-toggle="pill" href="#pills-calendar" 
            role="tab" aria-controls="pills-calendar" aria-selected="false">
            Calendar
        </a>
    </li>
</ul>