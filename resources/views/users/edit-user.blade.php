@extends('layouts.layout')

@section('title', 'Validations')

@section('content')
<div class="page-content">
    <div class="page-container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit User</h5>
                            <!-- Back Button -->
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('users.update', $users->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <!-- User Name -->
                            <div class="row mb-3">
                                <label for="input35" class="col-sm-3 col-form-label">Enter Your Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="input35" name="yourname" placeholder="Enter Your Name" value="{{ $users->name }}" required>
                                    @error('yourname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- User Type -->
                            <div class="row mb-3">
                                <label for="inputUserType" class="col-sm-3 col-form-label">User Type</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="inputUserType" name="user_type" required>
                                        <option selected disabled value>Choose...</option>
                                        @foreach($userTypes as $key => $value)
                                            <option value="{{ $key }}" 
                                                @if(old('user_type', $users->user_type) == $key) selected @endif>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="inputRole" name="role" required>
                                        <option selected disabled value>Choose...</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" 
                                                @if(old('role', $users->role_id) == $role->id) selected @endif>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Country Code -->
                            <div class="row mb-3">
                                <label for="inputCountryCode" class="col-sm-3 col-form-label">Country Code</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="inputCountryCode" name="code" required>
                                        <option selected disabled value>Choose...</option>
                                        @foreach($countryCodes as $key => $value)
                                            <option value="{{ $key }}" 
                                                @if(old('code', $users->country_code ?? '') == $key) selected @endif>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone No -->
                            <div class="row mb-3">
                                <label for="input36" class="col-sm-3 col-form-label">Phone No</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="input36" name="phone" placeholder="Phone No" value="{{ $users->phone }}" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Email Address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="input37" name="email" placeholder="Email Address" value="{{ $users->email }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="row mb-3">
                                <label for="input38a" class="col-sm-3 col-form-label">Choose Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="input38a" name="password" placeholder="Choose Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="markup_type" class="col-sm-3 col-form-label">Markup Type</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="markup_type" required>
                                        <option value="">Select Type</option>
                                        <option value="0" {{ $users->markup_type == 0 ? 'selected' : '' }}>Flat</option>
                                        <option value="1" {{ $users->markup_type == 1 ? 'selected' : '' }}>Percentage</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="markup_price" class="col-sm-3 col-form-label">Markup Price</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="markup_price" name="markup_price" 
                                        value="{{ $users->markup_price }}" placeholder="Enter Markup Price" required>
                                </div>
                            </div>

                            <!-- Checkbox for Agreement -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="input41" name="agree">
                                        <label class="form-check-label" for="input41">Check me out</label>
                                    </div>
                                    @error('agree')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Buttons: Submit and Reset -->
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-1">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary px-4">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  

@section('scripts') 
<script>
document.getElementById('inputUserType').addEventListener('change', function() {
    var userType = this.value;
    var roleSelect = document.getElementById('inputRole');
    roleSelect.innerHTML = '<option selected disabled value>Choose a Role...</option>';
    fetch('/get-roles-by-user-type/' + userType)
        .then(response => response.json()) 
        .then(data => {
            data.roles.forEach(function(role) {
                var option = document.createElement('option');
                option.value = role.id;
                option.text = role.name;
                roleSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching roles:', error);
        });
});
</script>
@endsection
