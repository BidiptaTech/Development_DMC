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
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf <!-- CSRF token for protection -->

                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Role Name:</strong>
                                    <span style="color: red; font-weight: bold;">*</span>
                                </label>
                                <input type="text" id="name" name="name" placeholder="Enter Role Name" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- User Type Select -->
                            <div class="mb-3">
                                <label for="inputUserType" class="form-label"><strong>User Type:</strong>
                                    <span style="color: red; font-weight: bold;">*</span>
                                </label>
                                <select class="form-select @error('user_type') is-invalid @enderror" id="inputUserType" name="user_type" required>
                                    <option selected disabled value>Choose User Type...</option>
                                    @foreach($userTypes as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('user_type')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Permissions Checkbox Group (Optional) -->
                            <!--
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
                            -->

                            <!-- Submit Button -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2">Save Role</button>
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
