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
		<h4 class="page-title">Manage Fine Types</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            	<button type="button" class="btn btn-primary waves-effect waves-light fa fa-plus-circle" data-toggle="modal" data-target="#modal-animation-1">Add New</button>

            	<div class="modal fade" id="modal-animation-1">
                  <div class="modal-dialog">
                  	<form action="{{ route('finetype.store') }}" method="post">
                  		@csrf
	                    <div class="modal-content animated flipInX">
	                      <div class="modal-header">
	                        <h4 class="modal-title">Add New Fine Type</h4>
	                      </div>
	                      <div class="modal-body">
	                        <div class="form-group">
	                        	<label for="fine type" style="font-size: 15px;">Fine Type: <span class="text-danger">*</span>
                            </label>
	                        	<input type="text" class="form-control" name="name" required="" placeholder="Enter fine type">
	                        </div>
	                      </div>
	                      <div class="modal-footer">
	                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close
	                        </button>
	                        <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Save</button>
	                      </div>
	                    </div>
                    </form>
                  </div>
                </div>
            </div>
            <div class="card-body">
                @include('include.message')
	            <div class="table-responsive">
		            <table id="default-datatable" class="table table-bordered">
		                <thead>
		                    <tr>
		                        <th>Fine Type</th>
		                        <th width="10%">Action</th>
		                    </tr>
		                </thead>
		                <tbody>
                            @foreach ($finetypes as $finetype)
                                <tr>
                                    <td>{{$finetype->name}}</td>
                                    <td>
                                        {{-- edit button --}}
                                        <button type="button" class="btn btn-success waves-effect waves-light fa fa-edit" data-toggle="modal" data-target="#id{{$finetype->id}}"></button>

                                        <div class="modal fade" id="id{{$finetype->id}}">
                                          <div class="modal-dialog">
                                            <form action="{{ route('finetype.update',$finetype->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content animated flipInX">
                                                  <div class="modal-header">
                                                    <h4 class="modal-title">Edit Fine Type</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="fine type" style="font-size: 15px;">Fine Type: 
                                                          <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name" required="" 
                                                        value="{{$finetype->name}}">
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close
                                                    </button>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o">
                                                    </i> Save</button>
                                                  </div>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                        {{-- delete button --}}
                                        <form method="post" id="delete-form-{{$finetype->id}}"
                                            action="{{route('finetype.destroy',$finetype->id)}}" style="display: none;">

                                            {{csrf_field()}}

                                            {{method_field('DELETE')}}

                                        </form>

                                        <a href="" onclick="
                                                if(confirm('Are yoy sure, You want to delete this data?')){
                                                  event.preventDefault();document.getElementById('delete-form-{{$finetype->id}}').submit();
                                                }else{
                                                  event.preventDefault();
                                                }" class="fa fa-trash-o btn btn-danger">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
		                </tbody>
		                <tfoot>
		                    <tr>
		                        <th>Fine Type</th>
		                        <th width="10%">Action</th>
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