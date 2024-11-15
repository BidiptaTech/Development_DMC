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
                            <h5 class="mb-0">Hotel Contact Details</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <x-alert />
                    <div class="card-body p-4">
                        <form id="hotelForm" method="POST" action="{{ route('hotels.createcontacts') }}">
                            @csrf
                            <input type="hidden" class="form-control" name="id" value="{{ $hotel->id }}">

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Hotel Reservation Contact No</strong></label>
                                <input type="text" class="form-control" name="hotel_reservation_cont_no" 
                                    value="{{ old('hotel_reservation_cont_no', $hotel->hotel_reservation_cont_no ?? '') }}" 
                                    placeholder="Enter Hotel Reservation Contact No">
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Hotel Reservation Email</strong></label>
                                <input type="text" class="form-control" name="hotel_reservation_email" 
                                    value="{{ old('hotel_reservation_email', $hotel->hotel_reservation_email ?? '') }}" 
                                    placeholder="Enter Hotel Reservation Email">
                            </div>
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Director of Revenue Contact No</strong></label>
                                <input type="text" class="form-control" name="revenue_director_cont_no" 
                                    value="{{ old('revenue_director_cont_no', $hotel->revenue_director_cont_no ?? '') }}" 
                                    placeholder="Enter Director of Revenue Contact No">
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Director of Revenue Email</strong></label>
                                <input type="text" class="form-control" name="revenue_director_email" 
                                    value="{{ old('revenue_director_email', $hotel->revenue_director_email ?? '') }}" 
                                    placeholder="Enter Director of Revenue Email">
                            </div>
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Director of Sales & Marketing Contact No</strong></label>
                                <input type="text" class="form-control" name="sales_director_cont_no" 
                                    value="{{ old('sales_director_cont_no', $hotel->sales_director_cont_no ?? '') }}" 
                                    placeholder="Enter Director of Sales & Marketing Contact No">
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Director of Sales & Marketing Email</strong></label>
                                <input type="text" class="form-control" name="sales_director_email" 
                                    value="{{ old('sales_director_email', $hotel->sales_director_email ?? '') }}" 
                                    placeholder="Enter Director of Sales & Marketing Email">
                            </div>
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Director of Finance Contact No</strong></label>
                                <input type="text" class="form-control" name="finance_director_cont_no" 
                                    value="{{ old('finance_director_cont_no', $hotel->finance_director_cont_no ?? '') }}" 
                                    placeholder="Enter Director of Finance Contact No">
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Director of Finance Email</strong></label>
                                <input type="text" class="form-control" name="finance_director_email" 
                                    value="{{ old('finance_director_email', $hotel->finance_director_email ?? '') }}" 
                                    placeholder="Enter Director of Finance Email">
                            </div>
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Director of Food & Beverage Contact No</strong></label>
                                <input type="text" class="form-control" name="beverage_director_cont_no" 
                                    value="{{ old('beverage_director_cont_no', $hotel->beverage_director_cont_no ?? '') }}" 
                                    placeholder="Enter Director of Food & Beverage Contact No">
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Director of Food & Beverage Email</strong></label>
                                <input type="text" class="form-control" name="beverage_director_email" 
                                    value="{{ old('beverage_director_email', $hotel->beverage_director_email ?? '') }}" 
                                    placeholder="Enter Director of Food & Beverage Email">
                            </div>
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Marketing Director/Manager Contact No</strong></label>
                                <input type="text" class="form-control" name="marketing_manager_cont_no" 
                                    value="{{ old('marketing_manager_cont_no', $hotel->marketing_manager_cont_no ?? '') }}" 
                                    placeholder="Enter Marketing Director/Manager Contact No">
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Marketing Director/Manager Email</strong></label>
                                <input type="text" class="form-control" name="marketing_manager_email" 
                                    value="{{ old('marketing_manager_email', $hotel->marketing_manager_email ?? '') }}" 
                                    placeholder="Enter Marketing Director/Manager Email">
                            </div>
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Account Manager Contact No</strong></label>
                                <input type="text" class="form-control" name="account_manager_cont_no" 
                                    value="{{ old('account_manager_cont_no', $hotel->account_manager_cont_no ?? '') }}" 
                                    placeholder="Enter Account Manager Contact No">
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>Account Manager Email</strong></label>
                                <input type="text" class="form-control" name="account_manager_email" 
                                    value="{{ old('account_manager_email', $hotel->account_manager_email ?? '') }}" 
                                    placeholder="Enter Account Manager Email">
                            </div>
                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>General Manager Contact No</strong></label>
                                <input type="text" class="form-control" name="general_manager_cont_no" 
                                    value="{{ old('general_manager_cont_no', $hotel->general_manager_cont_no ?? '') }}" 
                                    placeholder="Enter General Manager Contact No">
                            </div>

                            <div class="mb-3">
                                <label for="input35" class="form-label"><strong>General Manager Email</strong></label>
                                <input type="text" class="form-control" name="general_manager_email" 
                                    value="{{ old('general_manager_email', $hotel->general_manager_email ?? '') }}" 
                                    placeholder="Enter General Manager Email">
                            </div>

                            <!-- Submit and Previous Buttons -->
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-secondary px-4" id="previousButton">Previous</a>
                                <button type="submit" class="btn btn-primary px-4">Save and Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
