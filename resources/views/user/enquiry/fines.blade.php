@extends('user.layouts.master')

@section('head')

<!--Data Tables -->
<link href="{{ asset('theme/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" 
type="text/css">
<link href="{{ asset('theme/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" 
type="text/css">

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Manage Fine Enquiries</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table id="default-datatable" class="table table-bordered">
                    <thead>
                        <tr>
                          <th>Vehicle Number</th>
                          <th>Station Name</th>
                          <th>Transaction Date</th>
                          <th>Actual Weight(Tons)</th>
                          <th>Action Date(Payment)</th>
                          <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fines as $fine)
                          <tr>
                              <td>{{$fine->vehicle_number}}</td>
                              <td>{{$fine->station['station_name']}}</td>
                              <td>{{$fine->transaction['transaction_date']}}</td>
                              <td>{{$fine->transaction['gross_actual_weight']}}</td>
                              <td>{{$fine->payment_date}}</td>
                              <td>
                                {{-- print button --}}
                                <a href="{{ route('fines.show',$fine->id) }}" class="btn btn-info fa fa-eye" title="Click here to view details"></a>
                              </td>
                          </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>Vehicle Number</th>
                          <th>Station Name</th>
                          <th>Transaction Date</th>
                          <th>Actual Weight(Tons)</th>
                          <th>Action Date(Payment)</th>
                          <th width="5%">Action</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

<!-- jquery JavaScript-->
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>

<!--Data Tables js-->
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js') }}"></script>

<script>
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable( {
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
        } );
 
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
</script>

@endsection