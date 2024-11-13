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
                                <h5 class="mb-0">Add New Facility</h5>
                                <!-- Back Button -->
                                <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                    <i class="mdi mdi-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <form action="{{ route('facility.store') }}" method="POST">
                                @csrf 
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label"><strong>Name:</strong></label>
                                    <input type="text" id="name" name="name" placeholder="Enter Facility Name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category_type" class="form-label"><strong>Category Type:</strong></label>
                                    <select id="category_type" name="category_type" class="form-control" required>
                                        <option value="">Select Category Type</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @empty
                                            <option>No categories available</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label"><strong>Status:</strong></label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="icon" class="form-label"><strong>Select Icon:</strong></label>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="iconDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Choose an Icon
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="iconDropdown">
                                            @foreach ($facilityIcons as $iconClass => $label)
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center" href="#" onclick="setIcon('{{ $iconClass }}', '{{ $label }}')">
                                                        <i class="bi {{$iconClass}}"></i> {{ $label }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <input type="hidden" id="icon" name="icon">
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
        </div>
    </div>
    <!-- End of the form -->
@endsection

@section('script')
<script>
    function setIcon(iconClass, label) {
        // Set the selected icon class in the hidden input
        document.getElementById('icon').value = iconClass;

        // Update the dropdown button to show the selected icon and label
        document.getElementById('iconDropdown').innerHTML = `<i class="${iconClass} me-2"></i> ${label}`;

        // Close the dropdown after selection
        const dropdown = bootstrap.Dropdown.getOrCreateInstance(document.getElementById('iconDropdown'));
        dropdown.hide();
    }
</script>
@endsection
