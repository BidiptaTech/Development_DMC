@extends('layouts.layout')

@section('title', 'Facility')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/ekko-lightbox/dist/ekko-lightbox.css" rel="stylesheet">

    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="page-content">
        <div class="page-container">
            <div class="card page-title-box rounded-0">
                <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row gap-2">
                    <div class="flex-grow-1">
                        <h4 class="font-18 fw-semibold mb-0">Facilities</h4>
                    </div>
                    <!-- Add Facility Button -->
                    <div class="mt-3 mt-sm-0">
                        <a href="{{ route('facility.create') }}" class="btn btn-blue">Add New Facility</a>
                    </div>
                </div>
            </div>
            <x-alert />
            <div class="container mt-4">
                <div class="row">
                    @foreach($facilities as $facility)
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <!-- Card -->
                        <div class="card position-relative facility-card" 
                            style="border: 1px solid #e0e0e0; border-radius: 10px; @if($facility->is_chargeable == 1) background-color: #ffa366;@else background-color: #f8f9fa; @endif height: 60px;"
                            data-bs-toggle="modal"data-bs-target="#facilityModal-{{ $facility->id }}">

                            <!-- Action Buttons -->
                            <div class="position-absolute" style="top: -8px; right: -8px; display: flex; gap: 5px;">
                                <a href="{{ route('facility.edit', $facility->id) }}" 
                                    class="btn btn-outline-primary btn-sm" 
                                    title="Edit"
                                    style="border-radius: 50%; width: 20px; height: 20px; display: flex; justify-content: center; align-items: center; font-size: 10px; border: 1px solid #007bff;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button 
                                    class="btn btn-danger btn-sm" 
                                    title="Delete"
                                    onclick="setDeleteForm('{{ route('facility.destroy', $facility->id) }}')"
                                    style="border-radius: 50%; width: 20px; height: 20px; display: flex; justify-content: center; align-items: center; font-size: 10px; border: 1px solid #dc3545;">
                                    &times;
                                </button>
                            </div>

                            <!-- Facility Icon and Name -->
                            <div class="card-body d-flex justify-content-between align-items-center text-center" style="padding: 5px;">
                                <div class="d-flex justify-content-center align-items-center" style="flex-grow: 1;">
                                    <img src="{{ $facility->icon }}" alt="Facility Icon" style="height: 30px; object-fit: cover; border-radius: 5px;">
                                </div>
                                <h6 class="card-title text-dark" style="font-size: 10px; font-weight: bold; margin: 0; flex-grow: 2;">
                                    {{ $facility->name }}
                                </h6>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Each Facility -->
                    <div class="modal fade" id="facilityModal-{{ $facility->id }}" tabindex="-1" aria-labelledby="facilityModalLabel-{{ $facility->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="facilityModalLabel-{{ $facility->id }}">
                                        Details for {{ $facility->name }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <!-- Facility Icon -->
                                        <img src="{{ $facility->icon }}" alt="Facility Icon" style="height: 60px; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
                                        <!-- Facility Name -->
                                        <h5>{{ $facility->name }}</h5>
                                            <span><b>Category </b> : {{ $facility->categories->name }}</span> <br>
                                            @if($facility->is_chargeable == 1)
                                            <span><b>Comment</b> : {{ $facility->chargable_comment ?? 'No comment available' }}</span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
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
            <!-- End of Modal -->
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $(document).ready(function() {
            var table = $('#example2').DataTable({
                order: [[4, 'desc']], // Adjust column index based on where `created_at` would logically be
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        });

        function setDeleteForm(action) {
            document.getElementById('deleteForm').action = action;
        }
    </script>
@endsection
