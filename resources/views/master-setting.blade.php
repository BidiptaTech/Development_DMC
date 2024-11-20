@extends('layouts.layout')

@section('title', 'Settings')
@section('css')

@endsection 
@section('content')
<div class="page-content">

<div class="page-container">
<div class="card page-title-box rounded-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
            <div class="flex-grow-1">
                <h4 class="font-18 fw-semibold mb-0">Master Settings</h4>
            </div>
        </div>
    </div>

    <x-alert />

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('store-setting') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="input35" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="{{ $name }}" required>
                            @error('name') 
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="currency" class="form-label">Currency</label>
                            <select name="currency" class="form-control" required>
                                <option value="" disabled {{ empty($currentCurrency) ? 'selected' : '' }}>Select Currency</option>
                                @foreach(\App\Models\Setting::getCurrencyCodes() as $currency)
                                    <option value="{{ $currency }}" {{ isset($currentCurrency) && $currentCurrency === $currency ? 'selected' : '' }}>
                                        {{ $currency }}
                                    </option>
                                @endforeach
                            </select>
                            @error('currency') 
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="inputLogo" class="form-label">Logo</label>
                            <input type="file" class="form-control" name="logo" @if(!isset($existingLogo)) required @endif > <!-- Only require if no existing logo -->
                            <img src="{{ $existingLogo }}" alt="Current Logo" style="width: 55px; height: 55px;">
                            @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="inputFavicon" class="form-label">Favicon</label>
                            <input type="file" class="form-control" name="favicon" @if(!isset($existingFavicon)) required @endif> <!-- Only require if no existing favicon -->
                            <img src="{{ $existingFavicon }}" alt="Current Favicon" style="width: 55px; height: 55px;">
                            @error('favicon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        
                        <div class="col-sm-6">
                            <label for="inputFileStorage" class="form-label">File Storage</label>
                            <select id="inputFileStorage" name="file_storage" class="form-select">
                                <option value="" disabled {{ old('file_storage', $file ?? '') == '' ? 'selected' : '' }}>Select an option</option>
                                <option value="local" {{ old('file_storage', $file ?? '') == 'local' ? 'selected' : '' }}>Local Storage</option>
                                <option value="s3" {{ old('file_storage', $file ?? '') == 's3' ? 'selected' : '' }}>Amazon S3</option>
                                <option value="azure" {{ old('file_storage', $file ?? '') == 'azure' ? 'selected' : '' }}>Azure Blob Storage</option>
                            </select>
                            @error('file_storage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="input35" class="form-label">Tax Percentage</label>
                            <input type="number" class="form-control" name="tax_percentage" placeholder="Enter Tax Percentage" value="{{ $tax_percentage }}" required>
                            @error('tax') 
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

