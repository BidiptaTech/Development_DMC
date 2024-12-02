@extends('layouts.layout')
@section('content')

<!-- Start of the form -->
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add New Category</h5>
                            <!-- Back Button -->
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>

                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf 

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label"><strong>Name</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" required>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="category_type" class="form-label"><strong>Category Type</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <select id="category_type" name="category_type" class="form-control" required>
                                        <option value="">Select Category Type</option>
                                        <option value="1">Hotel</option>
                                        <option value="2">Facilities</option>
                                    </select>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="icon" class="form-label"><strong>Icon</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input type="file" name="icon" class="form-control" required>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Separate Row for Status -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="category_status" value="0">
                                        <input class="form-check-input" name="category_status" type="checkbox" id="category_status" value="1">
                                        <label for="category_status" class="form-check-label"><strong>Status</strong></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of the form -->
@endsection
