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
                            <label for="status" class="form-label"><strong>Room Type</strong></label>
                            <select name="room_type" class="form-control" required>
                                <option value="">Select One</option>
                                <option value="1" {{ $room->room_type == 1 ? 'selected' : '' }}>Single Room</option>
                                <option value="2" {{ $room->room_type == 2 ? 'selected' : '' }}>Double Room</option>
                                <option value="3" {{ $room->room_type == 3 ? 'selected' : '' }}>Delux Room</option>
                                <option value="4" {{ $room->room_type == 4 ? 'selected' : '' }}>Premium Room</option>
                            </select>
                        </div>

                        <!-- Max Capacity -->
                        <div class="mb-3">
                            <label for="input35" class="form-label"><strong>Max Capacity</strong></label>
                            <input type="number" class="form-control" name="max_capacity" placeholder="Enter Max Capacity" value="{{ $room->max_capacity }}">
                        </div>

                        <!-- Availability -->
                        <div class="mb-3">
                            <label for="status" class="form-label"><strong>Check Availability</strong></label>
                            <select name="available" class="form-control" required>
                                <option value="">Select One</option>
                                <option value="0" {{ $room->is_available == 0 ? 'selected' : '' }}>Booked</option>
                                <option value="1" {{ $room->is_available == 1 ? 'selected' : '' }}>Available</option>
                                <option value="2" {{ $room->is_available == 2 ? 'selected' : '' }}>Cleaning</option>
                            </select>
                        </div>

                        <!-- Cancellation Type -->
                        <div class="mb-3">
                            <label for="status" class="form-label"><strong>Cancellation Type</strong></label>
                            <select name="cancellation_type" class="form-control" required>
                                <option value="">Select One</option>
                                <option value="1" {{ $room->cancellation_type == 1 ? 'selected' : '' }}>Free</option>
                                <option value="0" {{ $room->cancellation_type == 0 ? 'selected' : '' }}>Chargable</option>
                            </select>
                        </div>

                        <!-- Cancellation Charge -->
                        <div class="mb-3">
                            <label for="input35" class="form-label"><strong>Cancellation Charge</strong></label>
                            <input type="number" class="form-control" name="charge" placeholder="Enter Cancellation Charge" value="{{ $room->cancellation_charge }}">
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label"><strong>Status</strong></label>
                            <select name="hotel_status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="1" {{ $room->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $room->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
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
</div>
@endsection