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
		<h4 class="page-title">Manage Stations</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            	<a href="{{ route('station.create') }}" class="btn btn-primary fa fa-plus-circle" title="Click here to add data"> Add New</a>
            </div>
            <div class="card-body">
            	@include('include.message')
	            <div class="table-responsive">
		            <table id="default-datatable" class="table table-bordered">
		                <thead>
		                    <tr>
		                        <th>Station Name</th>
		                        <th>Station Code</th>
		                        <th>Operating Company</th>
		                        <th>Contact Person</th>
		                        <th>Contact Phone</th>
		                        <th>Action</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach ($stations as $station)
		                		<tr>
		                		    <td>{{$station->station_name}}</td>
		                		    <td>{{$station->station_code}}</td>
		                		    <td>{{$station->operating_company}}</td>
		                		    <td>{{$station->contact_person}}</td>
		                		    <td>{{$station->contact_number}}</td>
		                		    <td>
		                		    	{{-- edit button --}}
		                		        <a href="{{ route('station.edit',$station->id) }}" class="btn btn-success fa fa-edit" title="Click here to edit the data"></a>
		                		        {{-- delete button --}}
		                		        <form method="post" id="delete-form-{{$station->id}}"
	                                        action="{{route('station.destroy',$station->id)}}" style="display: none;">

	                                        {{csrf_field()}}

	                                        {{method_field('DELETE')}}

	                                    </form>

	                                    <a href="" onclick="
	                                            if(confirm('Are yoy sure, You want to delete this data?')){
	                                              event.preventDefault();document.getElementById('delete-form-{{$station->id}}').submit();
	                                            }else{
	                                              event.preventDefault();
	                                            }" class="fa fa-trash-o btn btn-danger">
	                                    </a>
		                		        {{-- view details button --}}
		                		        <a href="{{ route('station.show',$station->id) }}" class="btn btn-info fa fa-eye" title="Click here to view details"></a>
		                		    </td>
		                		</tr>
		                	@endforeach
		                </tbody>
		                <tfoot>
		                    <tr>
		                        <th>Station Name</th>
		                        <th>Station Code</th>
		                        <th>Operating Company</th>
		                        <th>Contact Person</th>
		                        <th>Contact Phone</th>
		                        <th>Action</th>
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