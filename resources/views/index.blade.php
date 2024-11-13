@extends('layouts.layout')

@section('content')
<div class="page-content">

<div class="page-container">

    <div class="card page-title-box rounded-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
            <div class="flex-grow-1">
                <h4 class="font-18 fw-semibold mb-0">Calendar</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Adminox</a></li>
                    
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                    
                    <li class="breadcrumb-item active">Calendar</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row g-3">
                <div class="col-xl-3">
                    <button class="btn btn-primary w-100" id="btn-new-event">
                        <i class="ti ti-plus me-2 font-22 align-middle"></i> Create New Event
                    </button>

                    <div id="external-events" class="mt-2">
                        <p class="text-muted">Drag and drop your event or click in the calendar</p>
                        <div class="external-event fc-event bg-success-subtle text-success" data-class="bg-success-subtle">
                            <i class="ti ti-circle-filled me-2"></i>New Event Planning
                        </div>
                        <div class="external-event fc-event bg-info-subtle text-info" data-class="bg-info-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Meeting
                        </div>
                        <div class="external-event fc-event bg-warning-subtle text-warning" data-class="bg-warning-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Generating Reports
                        </div>
                        <div class="external-event fc-event bg-danger-subtle text-danger" data-class="bg-danger-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Create New theme
                        </div>
                    </div>

                </div> <!-- end col-->

                <div class="col-xl-9">
                    <div id="calendar"></div>
                </div><!-- end col -->
            </div>
            <!--end row-->
        </div>
    </div>

    <!-- Add New Event MODAL -->
    <div class="modal fade" id="event-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" name="event-form" id="forms-event" novalidate>
                    <div class="modal-header p-3 border-bottom-0">
                        <h5 class="modal-title" id="modal-title">
                            Event
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-3 pb-3 pt-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="control-label form-label">Event
                                        Name</label>
                                    <input class="form-control" placeholder="Insert Event Name" type="text" name="title" id="event-title" required />
                                    <div class="invalid-feedback">Please provide a valid event name</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="control-label form-label">Category</label>
                                    <select class="form-select" name="category" id="event-category" required>
                                        <option value="bg-primary">Blue</option>
                                        <option value="bg-secondary">Gray Dark</option>
                                        <option value="bg-success">Green</option>
                                        <option value="bg-info">Cyan</option>
                                        <option value="bg-warning">Yellow</option>
                                        <option value="bg-danger">Red</option>
                                        <option value="bg-dark">Dark</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid event category</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <button type="button" class="btn btn-danger" id="btn-delete-event">
                                Delete
                            </button>

                            <button type="button" class="btn btn-light ms-auto" data-bs-dismiss="modal">
                                Close
                            </button>

                            <button type="submit" class="btn btn-primary" id="btn-save-event">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end modal-content-->
        </div>
        <!-- end modal dialog-->
    </div>
    <!-- end modal-->

</div> <!-- container -->

</div>
@endsection
