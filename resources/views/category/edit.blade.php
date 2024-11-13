@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3"
		style="background-color: #C0C0C0; color: #333; padding: 20px; border-radius: 5px;">
		<x-page-title title="Hotel" pagetitle="Edit Category" />
        <a class="btn btn-primary" href="{{ route('category.index') }}"> Back</a>
	</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<!-- Start of the form -->
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Add new Category</h5>
            </div>
            <div class="card-body p-4">
            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf 
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Name:</strong></label>
                    <input value="{{$category->name}}" type="text" id="name" name="name" placeholder="Enter Name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="category_type" class="form-label"><strong>Category Type:</strong></label>
                    <select value="" id="category_type" name="category_type" class="form-control" required>
                        <option value="">Select Category Type</option>
                        <option value="1" {{$category->category_type == 1? 'selected' : ''}}>Hotel</option>
                        <option value="2" {{$category->category_type == 2? 'selected' : ''}}>Facilities</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="category_status" class="form-label"><strong>Category Type:</strong></label>
                    <select id="category_status" name="status" class="form-control" required>
                        <option value="">Status</option>
                        <option value="1" {{$category->category_type == 1? 'selected' : ''}}>Active</option>
                        <option value="0" {{$category->category_type == 0? 'selected' : ''}}>Inactive</option>
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
<!-- End of the form -->
@endsection
