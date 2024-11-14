@extends('layouts.layout')

@section('content')
<div class="page-content">
    <div class="page-container">
        <div class="row">
            <div class="col-lg-12 col-md-10 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header px-4 py-3" style="background-color: #e0bbf7; color: white;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Facility</h5>
                            <a href="javascript:history.back()" class="btn btn-sm btn-outline-light">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('facility.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Name</strong></label>
                                <input value="{{ old('name', $facility->name) }}" type="text" id="name" name="name" placeholder="Enter Facility Name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="icon" class="form-label"><strong>Icon</strong></label>
                                <input type="file" name="icon" class="form-control">
                                @if ($facility->icon)
                                    <div class="mt-2">
                                        <img src="{{ $facility->icon }}" alt="Facility Icon" style="width: 50px; height: 32px;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="chargeable" class="form-label"><strong>Chargeable</strong></label>
                                <select name="chargeable" class="form-control" id="chargeable" required onchange="toggleCommentField()">
                                    <option value="">Select One</option>
                                    <option value="1" {{ old('is_chargeable', $facility->is_chargeable ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('is_chargeable', $facility->is_chargeable ?? '') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="mb-3" id="comment_section" style="display: {{ old('chargeable', $facility->chargeable) == '1' ? 'block' : 'none' }};">
                                <label for="comment" class="form-label"><strong>Comment</strong></label>
                                <input type="text" name="comment" id="comment" placeholder="Enter Comment Name" class="form-control" value="{{ old('comment', $facility->chargable_comment) }}">
                            </div>

                            <div class="mb-3">
                                <label for="category_type" class="form-label"><strong>Category Type</strong></label>
                                <select id="category_type" name="category_type" class="form-control" required>
                                    <option value="">Select Category Type</option>
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $facility->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @empty
                                        <option>No categories available</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="category_status" class="form-label"><strong>Status</strong></label>
                                <select name="status" class="form-control" required>
                                    <option value="">Status</option>
                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
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
    </div>
</div>

@endsection

@section('scripts')
    <script>
        function toggleCommentField() {
            var chargeable = document.getElementById('chargeable').value;
            var commentSection = document.getElementById('comment_section');
            if (chargeable == '1') {
                commentSection.style.display = 'block';
            } else {
                commentSection.style.display = 'none';
            }
        }
        window.onload = function() {
            toggleCommentField();
        }
    </script>
@endsection
