@extends('layouts.layout')

@section('title', 'Hotels')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
@endsection

@section('content')
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white; margin-top: 10px !important;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Room Details</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <x-alert />
                    <div class="card-body p-4">
                    <form id="hotelForm" method="POST" action="{{ route('room.update') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Hotel ID -->
                        <input type="hidden" class="form-control" name="id" value="{{ $room->id }}">

                        <!-- Room Number -->
                        <div class="mb-3">
                            <label for="input35" class="form-label"><strong>Room Number</strong></label>
                            <input type="text" class="form-control" name="room_number" placeholder="Enter Room Number" value="{{ $room->room_number }}">
                        </div>

                        <!-- Room Type -->
                        <div class="mb-3">
                            <label for="room_type" class="form-label"><strong>Room Type</strong>
                                <span style="color: red; font-weight: bold;">*</span>
                            </label>
                            <select name="room_type" id="room_type" class="form-control" required>
                                @foreach($roomtypes as $roomtype)
                                    <option value="{{ $roomtype->id }}" {{ $room->room_type_id == $roomtype->id ? 'selected' : '' }}>
                                        {{ $roomtype->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Max Capacity -->
                        <div class="mb-3">
                            <label for="input35" class="form-label"><strong>Max Capacity</strong>
                                
                            </label>
                            <input type="number" class="form-control" name="max_capacity" placeholder="Enter Max Capacity" value="{{ $room->max_capacity }}">
                        </div>

                        <!-- Availability -->
                        <div class="mb-3">
                            <label for="status" class="form-label"><strong>Check Availability</strong>
                                <span style="color: red; font-weight: bold;">*</span>
                            </label>
                            <select name="available" class="form-control" required>
                                <option value="">Select One</option>
                                <option value="0" {{ $room->is_available == 0 ? 'selected' : '' }}>Booked</option>
                                <option value="1" {{ $room->is_available == 1 ? 'selected' : '' }}>Available</option>
                                <option value="2" {{ $room->is_available == 2 ? 'selected' : '' }}>Cleaning</option>
                            </select>
                            @error('available')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cancellation_type" class="form-label"><strong>Cancellation Type</strong>
                                <span style="color: red; font-weight: bold;">*</span>
                            </label>
                            <select name="cancellation_type" class="form-control" id="cancellation_type" required onchange="toggleChargeField()">
                                <option value="">Select One</option>
                                <option value="1" {{ $room->cancellation_type == 1 ? 'selected' : '' }}>Free</option>
                                <option value="0" {{ $room->cancellation_type == 0 ? 'selected' : '' }}>Chargable</option>
                            </select>
                            @error('cancellation_type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Cancellation Charge (initially hidden) -->
                        <div class="mb-3" id="cancellation_charge_field" style="{{ $room->cancellation_type == 0 ? 'display: block;' : 'display: none;' }}">
                            <label for="charge" class="form-label"><strong>Cancellation Charge</strong></label>
                            <input type="number" class="form-control" name="charge" id="charge" placeholder="Enter Cancellation Charge" value="{{ $room->cancellation_charge }}">
                        </div>

                        <!-- Status -->
                        <div class="form-check form-switch">
                            <label for="hotel_status" class="form-label"><strong>Status</strong></label>
                            <input type="hidden" name="hotel_status" value="0">
                            <input class="form-check-input" name="hotel_status" 
                                @if($room->status == 1) checked @endif 
                                type="checkbox" id="hotel_status" value="1">
                            <label class="form-check-label"></label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleChargeField() {
        var cancellationType = document.getElementById('cancellation_type').value;
        var chargeField = document.getElementById('cancellation_charge_field');
        if (cancellationType == "0") { // If Chargable is selected
            chargeField.style.display = "block"; // Show the charge field
        } else {
            chargeField.style.display = "none"; // Hide the charge field
        }
    }
    window.onload = function() {
        toggleChargeField();
    };
</script>
@endsection