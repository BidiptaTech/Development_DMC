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
                            <h5 class="mb-0">Add Room Details</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <x-alert />
                    <div class="card-body p-4">
                        <form id="hotelForm" method="POST" action="{{ route('storeroom') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="id" value="{{ $hotel->id }}">
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Room Number</strong></label>
                                <input type="text" class="form-control" name="room_number" placeholder="Enter Room Number">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label"><strong>Room Type</strong></label>
                                <select name="room_type" class="form-control" required>
                                    <option value="">Select One</option>
                                    <option value="1">Single Room</option>
                                    <option value="2">Double Room</option>
                                    <option value="2">Delux Room</option>
                                    <option value="2">Premium Room</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Max capacity</strong></label>
                                <input type="number" class="form-control" name="max_capacity" placeholder="Enter Hotel Number">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label"><strong>Check availability</strong></label>
                                <select name="available" class="form-control" required>
                                    <option value="">Select One</option>
                                    <option value="0">Booked</option>
                                    <option value="1">Available</option>
                                    <option value="2">Cleaning</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label"><strong>Cancellation Type</strong></label>
                                <select name="cancellation_type" class="form-control" required>
                                    <option value="">Select One</option>
                                    <option value="1">Free</option>
                                    <option value="0">Chargable</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Cancellation Charge</strong></label>
                                <input type="number" class="form-control" name="charge" placeholder="Enter Hotel Number">
                            </div>


                            <div class="mb-3">
                                <label for="status" class="form-label"><strong>Status</strong></label>
                                <select name="hotel_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <!-- Submit and Previous Buttons -->
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{ route('contactdetails.edit', $hotel->id) }}" class="btn btn-secondary px-4" id="previousButton">Previous</a>
                                <button type="submit" class="btn btn-primary px-4">Save and Add more rooms</button>
                                <a href="{{ route('hotels.index') }}" class="btn btn-success px-4">Save and Finish</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
