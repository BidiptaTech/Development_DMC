@extends('layouts.layout')

@section('title', 'Room Type')

@section('css')
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="page-content">
    <div class="page-container">
        
        <div class="card page-title-box rounded-0">
            <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row gap-2">
                <div class="flex-grow-1">
                    <h4 class="font-18 fw-semibold mb-0">Room Type</h4>
                </div>
                <!-- Add Role Button Row -->
                <div class="mt-3 mt-sm-0">
                    <a href="{{ route('roomType.create') }}" class="btn btn-blue">Add New Room Type</a>
                </div>
            </div>
        </div>
        <x-alert />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Breakfast</th>
                                <th>Lunch</th>
                                <th>Dinner</th>
                                <th>Extra Bed</th>
                                <th>Facilities</th>
                                
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $roomType)
                                <tr>
                                    <td>{{ $roomType->name }}</td>
                                    <!-- Breakfast Toggle -->
                                    <td>
                                        <button class="btn btn-link toggle-icon" data-id="{{ $roomType->id }}" data-field="breakfast" data-value="{{ $roomType->breakfast }}">
                                            @if ($roomType->breakfast == 1)
                                                <i class="fas fa-toggle-on text-success" style="font-size: 24px;"></i>
                                            @else
                                                <i class="fas fa-toggle-off text-danger" style="font-size: 24px;"></i>
                                            @endif
                                        </button>
                                    </td>
                                    <!-- Lunch Toggle -->
                                    <td>
                                        <button class="btn btn-link toggle-icon" data-id="{{ $roomType->id }}" data-field="lunch" data-value="{{ $roomType->lunch }}">
                                            @if ($roomType->lunch == 1)
                                                <i class="fas fa-toggle-on text-success" style="font-size: 24px;"></i>
                                            @else
                                                <i class="fas fa-toggle-off text-danger" style="font-size: 24px;"></i>
                                            @endif
                                        </button>
                                    </td>
                                    <!-- Dinner Toggle -->
                                    <td>
                                        <button class="btn btn-link toggle-icon" data-id="{{ $roomType->id }}" data-field="dinner" data-value="{{ $roomType->dinner }}">
                                            @if ($roomType->dinner == 1)
                                                <i class="fas fa-toggle-on text-success" style="font-size: 24px;"></i>
                                            @else
                                                <i class="fas fa-toggle-off text-danger" style="font-size: 24px;"></i>
                                            @endif
                                        </button>
                                    </td>
                                    <!-- Extra Bed Toggle -->
                                    <td>
                                        <button class="btn btn-link toggle-icon" data-id="{{ $roomType->id }}" data-field="extra_bed" data-value="{{ $roomType->extra_bed }}">
                                            @if ($roomType->extra_bed == 1)
                                                <i class="fas fa-toggle-on text-success" style="font-size: 24px;"></i>
                                            @else
                                                <i class="fas fa-toggle-off text-danger" style="font-size: 24px;"></i>
                                            @endif
                                        </button>
                                    </td>
                                    <td>
                                        @php
                                            $facilities = json_decode($roomType->facilities, true); // Decode the JSON to an array
                                        @endphp
                                    
                                        @if (!empty($facilities))
                                            {{ implode(', ', $facilities) }} <!-- Join the facilities with a comma -->
                                        @else
                                            No Facility
                                        @endif
                                    </td>
                                   
                                    <td>{{$roomType->description}}</td>
                                    
                                    <td class="d-flex justify-content-start align-items-center" style="gap: 8px;">
                                        <!-- Edit Button -->
                                        <a href="{{ route('roomType.edit', $roomType->id) }}" 
                                        class="btn btn-blue btn-sm d-flex align-items-center justify-content-center rounded-circle" 
                                        style="width: 28px; height: 28px; padding: 0;">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#ffffff">
                                                <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button" 
                                                class="btn btn-danger btn-sm d-flex align-items-center justify-content-center rounded-circle" 
                                                style="width: 28px; height: 28px; padding: 0;" 
                                                data-toggle="modal" 
                                                data-target="#deleteModal" 
                                                onclick="setDeleteForm('{{ route('roomType.destroy', $roomType->id) }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#ffffff">
                                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                            </svg>
                                        </button>
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

<!-- Hotel Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form id="deleteForm" action="" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    
    <!-- data table -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <!-- data table -->
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print'],
            });

            table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>

    <!-- Delete modal open -->
    <script>
        function setDeleteForm(action) {
            document.getElementById('deleteForm').action = action;
        }
    </script>

    <!-- Toggle button Script -->
    <script>
    $(document).ready(function () {
        // Handle toggle click
        $('.toggle-icon').on('click', function () {
            const button = $(this);
            const id = button.data('id');
            const field = button.data('field');
            const currentValue = button.data('value');
    
            // Toggle the value (1 to 0 or 0 to 1)
            const newValue = currentValue == 1 ? 0 : 1;
    
            // Send AJAX request to update the field
            $.ajax({
                url: '{{ route("roomType.toggle") }}', // Replace with the actual toggle route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    field: field,
                    value: newValue,
                },
                success: function (response) {
                    if (response.success) {
                        // Update the icon based on the new value
                        if (newValue == 1) {
                            button.html('<i class="fas fa-toggle-on text-success" style="font-size: 24px;"></i>');
                        } else {
                            button.html('<i class="fas fa-toggle-off text-danger" style="font-size: 24px;"></i>');
                        }
    
                        // Update the button's data-value attribute
                        button.data('value', newValue);
                    } else {
                        alert('Failed to update. Please try again.');
                    }
                },
                error: function () {
                    alert('An error occurred. Please try again.');
                },
            });
        });
    });
</script>
    
@endsection
