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
		<h4 class="page-title">Manage Blacklisted Vehicles</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            	<button type="button" class="btn btn-primary waves-effect waves-light fa fa-plus-circle" data-toggle="modal" data-target="#modal-animation-1">Add New</button>

          	  <div class="modal fade" id="modal-animation-1">
                <div class="modal-dialog">
                	<form action="{{ route('blacklist.store') }}" method="post">
                		@csrf
                    <div class="modal-content animated flipInX">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Blacklist</h4>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                        	<label for="vehicle number" style="font-size: 15px;">Vehicle Number: <span class="text-danger">*
                          </span></label>
                        	<input type="text" class="form-control" name="vehicle_number" required="" placeholder="Enter vehicle number">
                        </div>
                        <div class="form-group">
                          <label for="date of blacklist" style="font-size: 15px;">Date of Blacklist: <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="blacklist_date" required="" value="{{Carbon\carbon::now()->format('d-m-y')}}">
                        </div>
                        <div class="form-group">
                          <label for="officer's name" style="font-size: 15px;">Officer's Name: <span class="text-danger">*
                          </span></label>
                          <input type="text" class="form-control" name="officer_name" required="" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                          <label for="reason" style="font-size: 15px;">Reason: <span class="text-danger">*
                          </span></label>
                          <textarea name="reason" class="form-control" required="" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="station_id" value="{{Auth::user()->station['id']}}">
                        <input type="hidden" name="station_name" value="{{Auth::user()->station['station_name']}}">
                        <input type="hidden" name="status" value="pending">
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
	                        <th>Vehicle Number</th>
                          <th>Station Name</th>
                          <th>Date of Blacklist</th>
                          <th>Officer's Name</th>
                          <th>Status</th>
	                        <th width="10%">Action</th>
		                    </tr>
		                </thead>
		                <tbody>
                            @foreach ($blacklists as $blacklist)
                                <tr>
                                    <td>{{$blacklist->vehicle_number}}</td>
                                    <td>{{$blacklist->station['station_name']}}</td>
                                    <td>{{$blacklist->blacklist_date}}</td>
                                    <td>{{$blacklist->officer_name}}</td>
                                    <td>
                                      <button type="button" class="btn btn-danger btn-sm">{{$blacklist->status}}</button>
                                    </td>
                                    <td>
                                        {{-- edit button --}}
                                        <a href="{{ route('blacklist.edit',$blacklist->id) }}" class="btn btn-success fa fa-edit"></a>
                                        {{-- delete button --}}
                                        <form method="post" id="delete-form-{{$blacklist->id}}"
                                            action="{{route('blacklist.destroy',$blacklist->id)}}" style="display: none;">

                                            {{csrf_field()}}

                                            {{method_field('DELETE')}}

                                        </form>

                                        <a href="" onclick="
                                                if(confirm('Are yoy sure, You want to delete this data?')){
                                                  event.preventDefault();document.getElementById('delete-form-{{$blacklist->id}}').submit();
                                                }else{
                                                  event.preventDefault();
                                                }" class="fa fa-trash-o btn btn-danger">
                                        </a>
                                        {{-- arrest button --}}
                                        <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#id{{$blacklist->id}}">Arrest</button>

                                        <div class="modal fade" id="id{{$blacklist->id}}">
                                          <div class="modal-dialog">
                                            <form action="{{ route('arrest.update',$blacklist->id) }}" method="post"> 
                                              @csrf
                                              <div class="modal-content animated flipInX">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Issue an Arrest</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="form-group">
                                                    <label for="vehicle number" style="font-size: 15px;">Vehicle Number: <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="" required="" 
                                                    value="{{$blacklist->vehicle_number}}" readonly="">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="date of arrest" style="font-size: 15px;">Date of Arrest: 
                                                    <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="arrest_date" required="" value="{{Carbon\carbon::now()->format('d-m-y')}}">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="arresting officer" style="font-size: 15px;">Arresting Officer: <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="officer_name" required="" value="{{Auth::user()->name}}">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="station name" style="font-size: 15px;">Station Name: <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="" required="" value="{{Auth::user()->station['station_name']}}" readonly="">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="remarks" style="font-size: 15px;">Remarks: <span class="text-danger">*</span></label>
                                                    <textarea name="reason" class="form-control" rows="3" required="">
                                                    </textarea>
                                                  </div>
                                                  <input type="hidden" name="status" value="arrest">
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Stop
                                                  </button>
                                                  <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Proceed</button>
                                                </div>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
		                </tbody>
		                <tfoot>
		                    <tr>
                          <th>Vehicle Number</th>
                          <th>Station Name</th>
                          <th>Date of Blacklist</th>
                          <th>Officer's Name</th>
                          <th>Status</th>
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

{{-- alert for arrest --}}
<script>
  var msg = '{{Session('alert')}}';

  var exist = '{{Session::has('alert')}}';

  if (exist) {
    alert(msg);
  }
</script>

@endsection