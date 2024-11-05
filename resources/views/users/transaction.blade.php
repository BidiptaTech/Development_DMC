@extends('layouts.master')

@section('title', 'Transaction')
@section('css')
	<link href="{{ URL::asset('build/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@endsection 
@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3"
      style="background-color: #C0C0C0; color: #333; padding: 20px; border-radius: 5px;">
      <x-page-title title="Transaction" pagetitle="Transaction History" />
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
              <td> @if($tran->user_id == auth::user()->id ) <span class="badge badge-pill badge-success">Credited</span> @else <span class="badge badge-pill badge-danger">Debited</span> @endif </td>
            </tr>
            @endforeach
          </tbody>
        </table>
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