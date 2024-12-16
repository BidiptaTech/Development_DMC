@extends('layouts.layout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/2.1.8/dataTables.bootstrap5.min.css" integrity="sha512-9d9bjYZUo25k3MPAMpx+OUyvGQcbJe8qGOUJilgowXEPc0lNCVoe+zHZX8HszzkDJEUynZeF648jP9JLX1Pi7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<style>
        .fc-day-past {
            background-color: #f0f0f0;
            color: #ccc;
        }

        .event-blackout {
            background-color: #f8d7da !important;
            color: #842029 !important;
        }

        .event-fair {
            background-color: #fff3cd !important;
            color: #856404 !important;
        }

        .event-season {
            background-color: #d1e7dd !important;
            color: #0f5132 !important;
        }

        .price-container {
            font-weight: bold;
            color: #000;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .event-name {
            font-size: 0.8em;
            color: #333;
            margin-top: 2px;
        }
    </style>
@section('content')
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-body p-1">
                        <h2 class="text-center my-4">Yearly Calendar</h2>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        // Convert the PHP array to a JavaScript object
        const rateDates = @json($rate_dates); // This contains the rate data
        const prices = {};
        const blackoutDates = {};
        const fairDates = {};
        const seasonDates = {};

        // Populate prices and event types based on rate data
        rateDates.forEach(rate => {
            const startDate = new Date(rate.start_date);
            const endDate = new Date(rate.end_date);
            
            // Ensure to compare dates by stripping the time part
            const dateStr = date => date.toISOString().split('T')[0]; 
            
            // Iterate over the date range
            while (startDate <= endDate) {
                const dateKey = dateStr(startDate); // Get formatted date as key
                
                // Handle BlackoutDates
                if (rate.event_type === 'Blackout Date') {
                    blackoutDates[dateKey] = rate.event;
                    // blackoutDates[dateKey] = rate.price;
                } 
                // Handle FairDates
                else if (rate.event_type === 'Fair Date') {
                    fairDates[dateKey] = rate.event;
                    // blackoutDates[dateKey] = rate.price;
                } 
                // Handle Season (with weekday and weekend prices)
                else if (rate.event_type === 'Season') {
                    if (isWeekend(startDate)) {
                        prices[dateKey] = rate.weekend_price;  // Apply weekend price
                    } else {
                        prices[dateKey] = rate.weekday_price;  // Apply weekday price
                    }
                    seasonDates[dateKey] = rate.event;
                }
                
                // Move to the next date
                startDate.setDate(startDate.getDate() + 1);
            }
        });

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'en',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth',
            },
            validRange: {
                start: '2024-01-01',
                end: '2025-12-31',
            },
            dayCellDidMount: function (info) {
                const cell = info.el;
                const dateStr = info.date.toISOString().split('T')[0]; 

                let price = prices[dateStr] || null;
                let eventName = null;
                let eventClass = '';

                if (blackoutDates[dateStr]) {
                    eventName = blackoutDates[dateStr];
                    eventClass = 'event-blackout';
                } else if (fairDates[dateStr]) {
                    eventName = fairDates[dateStr];
                    eventClass = 'event-fair';
                } else if (seasonDates[dateStr]) {
                    eventName = seasonDates[dateStr];
                    eventClass = 'event-season';
                }

                // Apply event-specific class
                if (eventClass) {
                    cell.classList.add(eventClass);
                }

                // Display the event name if available
                if (eventName) {
                    const eventNameElement = document.createElement('div');
                    eventNameElement.className = 'event-name';
                    eventNameElement.textContent = eventName;
                    cell.appendChild(eventNameElement);
                }

                // Display the price if available
                if (price) {
                    const priceElement = document.createElement('div');
                    priceElement.className = 'price-container';
                    priceElement.textContent = `₹${price}`;
                    cell.appendChild(priceElement);
                }

                // Highlight past dates
                const today = new Date();
                today.setHours(0, 0, 0, 0); 
                if (info.date < today) {
                    cell.classList.add('fc-day-past');
                }
            },
            height: 'auto',
            aspectRatio: 1.5,
        });

        calendar.render();

        // Helper function to check if a date is a weekend (Saturday/Sunday)
        function isWeekend(date) {
            const day = date.getDay();
            return day === 0 || day === 6; // 0 is Sunday, 6 is Saturday
        }
    });
</script>


@endsection