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
                <div class="card shadow-sm">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Hotel Contact Details</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <x-alert />
                    <div class="card-body p-4">
                        <form id="hotelForm" method="POST" action="{{ route('hotels.createcontacts') }}">
                            @csrf
                            <input type="hidden" class="form-control" name="id" value="{{ $hotel->id }}">

                            <div class="row g-4">
                                <!-- Reservation Details -->
                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">Reservation Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Reservation Contact No</strong></label>
                                        <input type="text" class="form-control" name="hotel_reservation_cont_no"
                                            value="{{ old('hotel_reservation_cont_no', $hotel->hotel_reservation_cont_no ?? '') }}"
                                            placeholder="Hotel Reservation Contact No">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Reservation Email</strong></label>
                                        <input type="email" class="form-control" name="hotel_reservation_email"
                                            value="{{ old('hotel_reservation_email', $hotel->hotel_reservation_email ?? '') }}"
                                            placeholder="Hotel Reservation Email">
                                    </div>
                                </div>

                                <!-- Revenue Director Details -->
                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">Revenue Director Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Contact No</strong></label>
                                        <input type="text" class="form-control" name="revenue_director_cont_no"
                                            value="{{ old('revenue_director_cont_no', $hotel->revenue_director_cont_no ?? '') }}"
                                            placeholder="Revenue Director Contact No">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control" name="revenue_director_email"
                                            value="{{ old('revenue_director_email', $hotel->revenue_director_email ?? '') }}"
                                            placeholder="Revenue Director Email">
                                    </div>
                                </div>

                                <!-- Sales & Marketing Details -->
                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">Sales & Marketing Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Contact No</strong></label>
                                        <input type="text" class="form-control" name="sales_director_cont_no"
                                            value="{{ old('sales_director_cont_no', $hotel->sales_director_cont_no ?? '') }}"
                                            placeholder="Sales & Marketing Contact No">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control" name="sales_director_email"
                                            value="{{ old('sales_director_email', $hotel->sales_director_email ?? '') }}"
                                            placeholder="Sales & Marketing Email">
                                    </div>
                                </div>

                                <!-- Finance Director Details -->
                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">Finance Director Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Contact No</strong></label>
                                        <input type="text" class="form-control" name="finance_director_cont_no"
                                            value="{{ old('finance_director_cont_no', $hotel->finance_director_cont_no ?? '') }}"
                                            placeholder="Finance Director Contact No">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control" name="finance_director_email"
                                            value="{{ old('finance_director_email', $hotel->finance_director_email ?? '') }}"
                                            placeholder="Finance Director Email">
                                    </div>
                                </div>

                                <!-- Food & Beverage Director Details -->
                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">Food & Beverage Director Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Contact No</strong></label>
                                        <input type="text" class="form-control" name="beverage_director_cont_no"
                                            value="{{ old('food_beverage_director_cont_no', $hotel->food_beverage_director_cont_no ?? '') }}"
                                            placeholder="Food & Beverage Contact No">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control" name="beverage_director_email"
                                            value="{{ old('food_beverage_director_email', $hotel->food_beverage_director_email ?? '') }}"
                                            placeholder="Food & Beverage Email">
                                    </div>
                                </div>

                                <!-- Marketing Manager Details -->
                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">Marketing Manager Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Contact No</strong></label>
                                        <input type="text" class="form-control" name="marketing_manager_cont_no"
                                            value="{{ old('marketing_manager_cont_no', $hotel->marketing_manager_cont_no ?? '') }}"
                                            placeholder="Marketing Manager Contact No">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control" name="marketing_manager_email"
                                            value="{{ old('marketing_manager_email', $hotel->marketing_manager_email ?? '') }}"
                                            placeholder="Marketing Manager Email">
                                    </div>
                                </div>

                                <!-- Account Manager Details -->
                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">Account Manager Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Contact No</strong></label>
                                        <input type="text" class="form-control" name="account_manager_cont_no"
                                            value="{{ old('account_manager_cont_no', $hotel->account_manager_cont_no ?? '') }}"
                                            placeholder="Account Manager Contact No">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control" name="account_manager_email"
                                            value="{{ old('account_manager_email', $hotel->account_manager_email ?? '') }}"
                                            placeholder="Account Manager Email">
                                    </div>
                                </div>

                                <!-- General Manager Details -->
                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">General Manager Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Contact No</strong></label>
                                        <input type="text" class="form-control" name="general_manager_cont_no"
                                            value="{{ old('general_manager_cont_no', $hotel->general_manager_cont_no ?? '') }}"
                                            placeholder="General Manager Contact No">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control" name="general_manager_email"
                                            value="{{ old('general_manager_email', $hotel->general_manager_email ?? '') }}"
                                            placeholder="General Manager Email">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <h6 class="border-bottom pb-2">Whatsapp Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Whatsapp</strong></label>
                                        <input type="text" class="form-control" name="whatsapp"
                                            value="{{ old('whatsapp', $hotel->whatsapp ?? '') }}"
                                            placeholder="Whatsapp Number">
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-secondary px-4" id="previousButton">Previous</a>
                                <button type="submit" class="btn btn-primary px-4">Save and Next</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
