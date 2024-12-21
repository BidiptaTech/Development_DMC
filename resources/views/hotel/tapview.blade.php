<ul class="nav nav-pills mb-4 mt-4 d-flex justify-content-center" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Request::routeIs('hotels.edit') ? 'active' : '' }}" 
        id="pills-hotel-tab" href="{{ route('hotels.edit', $hotel->hotel_unique_id) }}" role="tab">
            Hotel Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Request::routeIs('hotels.contact') ? 'active' : '' }}" 
        id="pills-contact-tab" href="{{ route('hotels.contact', $hotel->hotel_unique_id) }}" role="tab">
            Contact Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Request::routeIs('hotels.room') ? 'active' : '' }}" 
        id="pills-room-tab" href="{{ route('hotels.room', $hotel->hotel_unique_id) }}" role="tab">
            Room Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Request::routeIs('hotels.season') ? 'active' : '' }}" 
        id="pills-season-tab" href="{{ route('hotels.season', $hotel->hotel_unique_id) }}" role="tab">
            Season Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Request::routeIs('hotels.event') ? 'active' : '' }}" 
        id="pills-event-tab" href="{{ route('hotels.rates',$hotel->hotel_unique_id) }}" role="tab">
            Event Details
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Request::routeIs('hotels.calendar') ? 'active' : '' }}" 
        id="pills-calendar-tab" href="{{ route('hotels.calendar',$hotel->hotel_unique_id) }}" role="tab">
            Calendar
        </a>
    </li>
</ul>