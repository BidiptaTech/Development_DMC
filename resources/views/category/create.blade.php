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
                            <h5 class="mb-0">Add New Role</h5>
                            <!-- Back Button -->
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf 

                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Name</strong></label>
                                <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Icon</strong></label>
                                <input type="file" name="icon" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_type" class="form-label"><strong>Category Type</strong></label>
                                <select id="category_type" name="category_type" class="form-control" required>
                                    <option value="">Select Category Type</option>
                                    <option value="1">Hotel</option>
                                    <option value="2">Facilities</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="category_status" class="form-label"><strong>Status</strong></label>
                                <select id="category_status" name="category_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
