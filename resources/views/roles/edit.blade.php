@extends('layouts.layout')

@section('content')
<!-- Main Content Section -->
<div class="page-content">
    <div class="page-container">
        <div class="row">
            <div class="col-lg-12 col-md-10 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Role</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Start of the form -->
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf <!-- CSRF token for protection -->
                            @method('PATCH') <!-- Specify the method for update -->

                            <!-- Role Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Role Name:</strong>
                                    <span style="color: red; font-weight: bold;">*</span>
                                </label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Role Name"
                                    value="{{ old('name', $role->name) }}" required>
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
                                        <option value="{{ $key }}" @if(old('user_type', $role->user_type) == $key) selected @endif>
                                            {{ $value }}
                                        </option>
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
                                    @foreach($permissions as $permission)
                                        @if(in_array($permission->id, $assignedRolePermissions)) <!-- Show only assigned permissions -->
                                            <div class="col-sm-6 col-md-4 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="permission-{{ $permission->id }}" name="permission[]"
                                                        value="{{ $permission->id }}" @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2">Update Role</button>
                                </div>
                            </div>

                        </form>
                        <!-- End of the form -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
