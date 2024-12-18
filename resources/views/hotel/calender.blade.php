@extends('layouts.layout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/2.1.8/dataTables.bootstrap5.min.css" integrity="sha512-9d9bjYZUo25k3MPAMpx+OUyvGQcbJe8qGOUJilgowXEPc0lNCVoe+zHZX8HszzkDJEUynZeF648jP9JLX1Pi7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<style>
    /* Blackout dates: Red with white text */
    .event-blackout {
        background-color: rgba(255, 0, 0, 0.7); /* Darker red */
        color: #8B0000; /* Dark red text */
    }

    /* Fair dates: Orange with black text */
    .event-fair {
        background-color: rgba(255, 165, 0, 0.7); /* Darker orange */
        color: #FF8C00; /* Dark orange text */
    }

    /* Season dates: Green with black text */
    .event-season {
        background-color: rgba(34, 139, 34, 0.7); /* Darker green */
        color: #228B22; /* Dark green text */
    }

    /* Weekends: Lighter Yellow with black text */
    .fc-day-sun,
    .fc-day-sat {
        background-color: rgba(255, 215, 0, 0.3); /* Lighter yellow */
        color: #FFD700; /* Gold text */
    }

    /* Base dates with price */
    .price-container {
        font-size: 14px;
        font-weight: bold;
        margin-top: 5px;
        text-align: center;
    }

    /* Event names */
    .event-name {
        font-size: 14px;
        font-weight: bold;
        color: #333; /* Dark color for better readability */
        text-align: center;
        margin-top: 3px;
    }

    /* Styling for past dates */
    .fc-day-past {
        background-color: rgba(169, 169, 169, 0.3); /* Light gray */
        color: #696969; /* Dim gray text */
    }

    /* Color legend styling */
    .color-legend {
        display: flex;
        justify-content: space-around;
        margin-bottom: 15px;
    }
    .color-box {
        width: 30px;
        height: 30px;
        display: inline-block;
    }
    .color-text {
        margin-left: 10px;
        line-height: 30px;
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

                        <!-- Color Legend -->
                        <div class="color-legend">
                            <div>
                                <div class="color-box" style="background-color: rgba(255, 0, 0, 0.7);"></div>
                                <span class="color-text">Blackout Date</span>
                            </div>
                            <div>
                                <div class="color-box" style="background-color: rgba(255, 165, 0, 0.7);"></div>
                                <span class="color-text">Fair Date</span>
                            </div>
                            <div>
                                <div class="color-box" style="background-color: rgba(34, 139, 34, 0.7);"></div>
                                <span class="color-text">Season Date</span>
                            </div>
                            <div>
                                <div class="color-box" style="background-color: rgba(255, 215, 0, 0.3);"></div>
                                <span class="color-text">Weekend</span>
                            </div>
                        </div>

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
    const rateDates = @json($rate_dates); 
    const weekendDays = @json($weekend_days); 
    const weekdayBasePrice = @json($weekday_base_price); 
    const weekendBasePrice = @json($weekend_base_price); 

    function adjustDateToTimezone(dateStr, country) {
        const date = new Date(dateStr); 
        let adjustedDate;
        if (country === 'INDIA') {
            adjustedDate = new Date(date.setHours(date.getHours() + 5, date.getMinutes() + 30)); 
        } else if (country === 'SINGAPORE') {
            adjustedDate = new Date(date.setHours(date.getHours() + 8));
        } else {
            adjustedDate = date;
        }

        return adjustedDate.toISOString().split('T')[0]; 
    }

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
            let price = null;
            let eventName = null;
            let eventClass = '';
            const dateStr = adjustDateToTimezone(info.date.toISOString().split('T')[0], 'INDIA'); // Adjust to India timezone

            const day = info.date.getDay(); // 0 = Sunday, 6 = Saturday
            const isWeekend = weekendDays.includes(day);
            if (rateDates[dateStr]) {
                const rate = rateDates[dateStr];
                price = rate.price;
                eventName = rate.event;

                if (rate.event_type === 'Blackout Date') {
                    eventClass = 'event-blackout';
                } else if (rate.event_type === 'Fair Date') {
                    eventClass = 'event-fair';
                } else if (rate.event_type === 'Season') {
                    eventClass = 'event-season';
                }
            } else {
                price = isWeekend ? weekendBasePrice : weekdayBasePrice;
            }

            // Apply event color if event exists; otherwise, apply weekend color if it's a weekend
            if (eventClass) {
                cell.classList.add(eventClass);
            } else if (isWeekend) {
                // Apply lighter weekend color if there's no event
                cell.classList.add('fc-day-sun', 'fc-day-sat');
            }

            // Display event name and price in larger font and centered
            if (eventName) {
                const eventNameElement = document.createElement('div');
                eventNameElement.className = 'event-name';
                eventNameElement.textContent = eventName;
                cell.appendChild(eventNameElement);
            }
            if (price) {
                const priceElement = document.createElement('div');
                priceElement.className = 'price-container';
                priceElement.textContent = `₹${price}`;
                cell.appendChild(priceElement);
            }
        },
        height: 'auto',
        aspectRatio: 1.5,
        // Show 30 days at a time
        views: {
            dayGridMonth: {
                visibleRange: function (currentDate) {
                    const startDate = currentDate;
                    const endDate = new Date(currentDate);
                    endDate.setDate(startDate.getDate() + 29); // 30-day view
                    return { start: startDate, end: endDate };
                }
            }
        }
    });

    calendar.render();
    });
</script>
@endsection
