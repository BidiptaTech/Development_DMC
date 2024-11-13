@extends('layouts.layout')

@section('title', 'Transaction')
@section('css')
	<link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@endsection 
@section('content')
<div class="page-content">
  <div class="page-container">
    <div class="card page-title-box rounded-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
            <div class="flex-grow-1">
                <h4 class="font-18 fw-semibold mb-0">All Transaction</h4>
            </div>
        </div>
    </div>

  <hr>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example2" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Transaction Type</th>
              <th>Credited To</th>
              <th>Debited From</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaction as $tran)
            <tr>
              <td>{{ $tran->type }}</td>
              <td>{{ $tran->user->name }} </td>
              <td>{{ $tran->user_transaction->name }} </td>
              <td>{{ $tran->amount }}</td>
              <td> @if($tran->user_id == auth::user()->id ) <span class="badge bg-success">Credited</span>
               @else <span class="badge bg-danger">Debited</span> @endif </td>
            </tr>
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
@endsection 