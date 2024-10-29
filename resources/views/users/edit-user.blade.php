@extends('layouts.master')

@section('title', 'Validations')
@section('css')
	
@endsection 
@section('content')
	<div class="d-flex justify-content-between align-items-center mb-3"
		style="background-color: #C0C0C0; color: #333; padding: 20px; border-radius: 5px;">
		<x-page-title title="User" pagetitle="Edit User" />
        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
	</div>
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
  @endif
	<div class="row">
		<div class="col-lg-12 mx-auto">
			<div class="card">
				<div class="card-header px-4 py-3">
					<h5 class="mb-0">Edit User Details</h5>
				</div>
				<div class="card-body p-4">
				<form action="{{ route('users.update', $users->id) }}" method="POST">
                        @csrf
						@method('PATCH')
                        <div class="row mb-3">
                            <label for="input35" class="col-sm-3 col-form-label">Enter Your Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input35" name="yourname" placeholder="Enter Your Name" value="{{$users->name}}" required>
                                @error('yourname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="inputUserType" class="col-sm-3 col-form-label">User Type</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="inputUserType" name="user_type" required>
                                    <option selected disabled value>Choose...</option>
                                    @foreach($userTypes as $key => $value)
                                        <option value="{{ $key }}" 
                                            {{-- Set the selected option if the user's type matches --}}
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

                        <div class="row mb-3">
                            <label for="inputRole" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="inputRole" name="role" required>
                                    <option selected disabled value>Choose...</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" 
                                            {{-- Set the selected option if the user's role matches --}}
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

                        <div class="row mb-3">
                            <label for="input36" class="col-sm-3 col-form-label">Phone No</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="input36" name="phone" placeholder="Phone No" value="{{$users->phone}}" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input37" class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="input37" name="email" placeholder="Email Address" value="{{$users->email}}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input38a" class="col-sm-3 col-form-label">Choose Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="input38a" name="password" placeholder="Choose Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
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
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <button type="reset" class="btn btn-secondary px-4">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
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