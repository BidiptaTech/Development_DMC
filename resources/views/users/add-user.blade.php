@extends('layouts.layout')

@section('title', 'Validations')

@section('content')
<div class="page-content">
    <div class="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add New User</h5>
                            <!-- Back Button -->
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <!-- Name Field -->
                            <div class="mb-3 row">
                                <label for="yourname" class="col-sm-3 col-form-label">Enter Your Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('yourname') is-invalid @enderror" id="yourname" name="yourname" placeholder="Enter Your Name" required>
                                    @error('yourname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- User Type Field -->
                            <div class="mb-3 row">
                                <label for="inputUserType" class="col-sm-3 col-form-label">User Type</label>
                                <div class="col-sm-9">
                                    <select class="form-select @error('user_type') is-invalid @enderror" id="inputUserType" name="user_type" required>
                                        <option selected disabled value>Choose User Type...</option>
                                        @foreach($userTypes as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Field -->
                            <div class="mb-3 row">
                                <label for="phone" class="col-sm-3 col-form-label">Phone No</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Phone No" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-3 col-form-label">Choose Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Choose Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Agree Checkbox -->
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input @error('agree') is-invalid @enderror" type="checkbox" id="input41" name="agree" required>
                                        <label class="form-check-label" for="input41">I agree to the terms</label>
                                    </div>
                                    @error('agree')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="row justify-content-center">
                                <div class="col-sm-9 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary px-4">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts') 
<script>
    // Dynamic Role Dropdown based on User Type Selection
    document.getElementById('inputUserType').addEventListener('change', function() {
        var userType = this.value;
        var roleSelect = document.getElementById('inputRole');
        roleSelect.innerHTML = '<option selected disabled value>Choose a Role...</option>';
        if (userType) {
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
        }
    });
</script>
@endsection
