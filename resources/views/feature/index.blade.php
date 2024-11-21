@extends('layouts.layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection 

@section('content')
<div class="page-content">
    <div class="page-container">
        <div class="card page-title-box rounded-0">
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                <div class="flex-grow-1">
                    <h4 class="font-18 fw-semibold mb-0">Features</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Feature</th>
                                <th>Assign Roles</th>
                                <th width="280px">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($features as $key => $f)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $f->name }}</td>
                                    <td>
                                        <!-- Button to open modal -->
                                        <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#featureModal{{ $f->id }}">
                                            View Roles
                                        </button>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked_{{ $f->id }}" 
                                                @if($f->status == 1) checked @endif 
                                                onclick="checkStatus(this, '{{ $f->id }}')">
                                            <label class="form-check-label" for="flexSwitchCheckChecked_{{ $f->id }}"></label>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="featureModal{{ $f->id }}" tabindex="-1" aria-labelledby="featureModalLabel{{ $f->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="featureModalLabel{{ $f->id }}">{{ $f->name }} Roles</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('save-feature-roles', $f->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    @foreach($roles as $role)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                                @if(is_array(json_decode($f->feature_roles)) && in_array($role->id, json_decode($f->feature_roles))) 
                                                                    checked 
                                                                @endif> <!-- Check if the role ID exists in feature_roles array -->
                                                            <label>{{ $role->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function checkStatus(checkbox, id) {
        const newStatus = checkbox.checked ? 1 : 0;
        checkbox.disabled = true; // Disable the checkbox while the request is in progress

        fetch('/update-status', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                status: newStatus,
                id: id 
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'An error occurred while updating the status.');
                });
            }
            return response.json();
        })
        .then(data => {
            // If the response is successful, enable the checkbox
            toastr.success(data.message || 'Status updated successfully');
            checkbox.disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error(error.message || 'An error occurred while updating the status.');

            // Revert the checkbox state if there is an error
            checkbox.checked = !checkbox.checked;
            checkbox.disabled = false;
        });
    }
</script>
@endsection
