@extends('layouts.layout')

@section('content')
<!-- Start of the form -->
<div class="page-content">
    <div class="page-container">
        <div class="row">
            <div class="col-lg-12 col-md-10 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Category</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Name</strong></label>
                                <input value="{{ $category->name }}" type="text" name="name"placeholder="Enter Name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Icon</strong></label>
                                <input type="file" name="icon" class="form-control">
                                <img src="{{ $category->icon }}" alt="Category Icon" style="width: 50px; height: 32px;">
                            </div>

                            <div class="mb-3">
                                <label for="category_type" class="form-label"><strong>Category Type</strong></label>
                                <select name="category_type" class="form-control" required>
                                    <option value="">Select Category Type</option>
                                    <option value="1" {{ $category->category_type == 1 ? 'selected' : '' }}>Hotel</option>
                                    <option value="2" {{ $category->category_type == 2 ? 'selected' : '' }}>Facilities</option>
                                </select>
                            </div>

                            <div class="form-check form-switch">
                                <label for="category_status" class="form-label"><strong>Status</strong></label>
                                <input type="hidden" name="category_status" value="0">
                                <input class="form-check-input" name="category_status" 
                                    @if($category->status == 1) checked @endif 
                                    type="checkbox" id="category_status" value="1">
                                <label class="form-check-label"></label>
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
<!-- End of the form -->
@endsection
