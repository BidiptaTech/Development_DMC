@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3"
		style="background-color: #C0C0C0; color: #333; padding: 20px; border-radius: 5px;">
		<x-page-title title="User" pagetitle="Add Role Details" />
        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
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
                <h5 class="mb-0">Add new Role</h5>
            </div>
            <div class="card-body p-4">
            <form action="{{ route('roles.store') }}" method="POST" >
                @csrf <!-- CSRF token for protection -->
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Name:</strong></label>
                    <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" required>
                </div>

                <!-- User Type Select -->
                <div class="mb-3">
                    <label for="inputUserType" class="form-label"><strong>User Type:</strong></label>
                    <select class="form-select" id="inputUserType" name="user_type" required>
                        <option selected disabled value>Choose...</option>
                        @foreach($userTypes as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('user_type')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Permissions Checkbox Group -->
                <div class="mb-3">
                    <label class="form-label"><strong>Permissions:</strong></label>
                    <div class="row">
                        @foreach($permission as $value)
                            <div class="col-sm-6 col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="permission-{{ $value->id }}" name="permission[]" value="{{ $value->id }}">
                                    <label class="form-check-label" for="permission-{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
