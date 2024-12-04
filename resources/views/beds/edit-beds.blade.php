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
                            <h5 class="mb-0">Add New Bed Type</h5>
                            <!-- Back Button -->
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>

                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('beds.update', $bed->bedId) }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label"><strong>Bed Type</strong>
                                        <span style="color: red; font-weight: bold;">*</span>
                                    </label>
                                    <input value="{{$bed->bed_type}}" type="text" id="name" name="bed_type" placeholder="Enter Bed Type" class="form-control" required>
                                    @error('bed_type')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="mb-3">
                                        <label for="image" class="form-label"><strong>Icon</strong>
                                            
                                        </label>
                                        <input type="file" name="image" class="form-control">
                                        <img src="{{ $bed->image }}" alt="bed image" style="width: 50px; height: 32px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Separate Row for Status -->
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label"><strong>Description</strong>
                                
                                </label>
                                <input value="{{$bed->description}}" type="text" id="description" name="description" placeholder="Description..." class="form-control">
                                
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
