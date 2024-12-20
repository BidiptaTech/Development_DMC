@extends('layouts.layout')

@section('title', 'Users')
@section('css')
	<link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection 
@section('content')
  <div class="page-content">
  <div class="page-container">
    <div class="card page-title-box rounded-0">
      <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row gap-2">
          <div class="flex-grow-1">
              <h4 class="font-18 fw-semibold mb-0">Users</h4>
          </div>
          <!-- Add User Button Row -->
          <div class="mt-3 mt-sm-0">
              <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
          </div>
      </div>
    </div>

    
    <x-alert />
   
      <hr>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>phone</th>
                  <th>Role</th>
                  <th>User Type</th>
                  <th>Wallet</th>
                  <th>Action</th>
                  @if(auth::user()->user_type == 1)
                  <th>Auto Login</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $key => $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->role->name ?? 'No Role' }}</td>
                    <td>{{ $user->getUserTypeName() }}</td>
                    <td>
                      @if((auth::user()->user_type == 1 && $user->user_type == 2)||
                      (auth::user()->user_type == 2 && $user->user_type == 3)||
                      (auth::user()->user_type == 3 && $user->user_type == 4))
                      <button type="button" class="btn btn-primary btn-sm" 
                              style="padding: 4px 8px; border-radius: 4px;"
                              data-toggle="modal" data-target="#walletmodal"
                              data-id="{{ $user->id }}">
                          Add Balance
                      </button>
                      @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm" style="width: 36px; height: 36px; padding: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                                <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
                            </svg>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" style="width: 36px; height: 36px; padding: 0;" data-toggle="modal" data-target="#deleteModal" onclick="setDeleteForm('{{ route('users.destroy', $user->id) }}')">
                              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff">
                                  <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                              </svg>
                        </button>
                    </td>
                    <td>
                      @if(auth::user()->user_type == 1 && $user->user_type == 2)
                        <a href="{{ route('admin.loginAsUser', $user->id) }}" class="btn btn-success" ><i class="bi bi-box-arrow-in-right"></i></a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!--User Delete Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
            </div>
            <div class="modal-body">
              Are you sure want to delete?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form id="deleteForm" action="" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
          </div>
        </div>
      </div>

      <!--User Add Wallet money -->
      <div class="modal fade" id="walletmodal" tabindex="-1" role="dialog" aria-labelledby="walletmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="walletmodalLabel">Add Wallet Money</h5>
              </div>
              <div class="modal-body">
                  <form id="addMoneyForm" action="{{ route('add-money', ':id') }}" method="POST">
                      @csrf
                      <input type="hidden" id="userId" name="userId"> <!-- Hidden field for user ID -->
                      <div class="form-group">
                          <label for="amount">Amount:</label>
                          <input type="number" class="form-control" id="amount" name="amount" required placeholder="Enter amount">
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Add Money</button>
                  </div>
                      </form>
              </div>
          </div>
      </div>
  </div>
  </div>
@endsection 
@section('scripts')  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="{{ URL::asset('build/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('build/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
  
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
  <script>
      function setDeleteForm(action) {
          document.getElementById('deleteForm').action = action;
      }
  </script>
  <script>
      $(document).ready(function() {
          $('#walletmodal').on('show.bs.modal', function(event) {
              var button = $(event.relatedTarget); 
              var userId = button.data('id'); 
              var modal = $(this);
              modal.find('#userId').val(userId); 
              modal.find('#addMoneyForm').attr('action', '{{ url("add-money") }}/' + userId); 
          });
      });
  </script>

@endsection 