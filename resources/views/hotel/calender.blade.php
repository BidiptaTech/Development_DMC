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
    const prices = {
        '2024-12-19': 100,
        '2025-01-10': 120,
        '2025-02-24': 90,
        '2024-12-31': 150,
        '2024-12-25': 300,
    };

    const blackoutDates = {
        '2024-12-25': 'Christmas Blackout',
        '2024-12-31': 'New Year Blackout',
    };

    const fairDates = {
        '2025-01-10': 'Winter Fair',
        '2025-02-24': 'Spring Fair',
    };

    const seasonDates = {
        '2024-12-10': 'Winter Season',
        '2024-12-19': 'Holiday Season',
    };

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
            // Convert the date to YYYY-MM-DD format for IST
            const istDate = new Date(info.date.getTime() + 5.5 * 60 * 60 * 1000); // Add 5.5 hours to adjust to IST
            const dateStr = istDate.toISOString().split('T')[0];
            const cell = info.el;

            // Default values for price and event
            let price = prices[dateStr] || null;
            let eventName = null;
            let eventClass = '';

            // Priority logic: blackoutDates > fairDates > seasonDates > base price
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

            // Display the price
            if (price) {
                const priceElement = document.createElement('div');
                priceElement.className = 'price-container';
                priceElement.textContent = `₹${price}`;
                cell.appendChild(priceElement);
            }

            // Highlight past dates
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset time to midnight in local time
            if (info.date < today) {
                cell.classList.add('fc-day-past');
            }
        },
        height: 'auto',
        aspectRatio: 1.5,
    });

    calendar.render();
});

    </script>

    @endsection