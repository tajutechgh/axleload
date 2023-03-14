@extends('user.layouts.master')

@section('head')

<!--Data Tables -->
<link href="{{ asset('theme/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" 
type="text/css">
<link href="{{ asset('theme/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" 
type="text/css">

<!--Select Plugins-->
<link href="{{ asset('theme/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Manage Roles</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            	<button type="button" class="btn btn-primary waves-effect waves-light fa fa-plus-circle" data-toggle="modal" data-target="#modal-animation-1">Add New</button>

            	<div class="modal fade" id="modal-animation-1">
                  <div class="modal-dialog modal-lg">
                  	<form action="{{ route('role.store') }}" method="post">
                  		@csrf
	                    <div class="modal-content animated flipInX">
	                      <div class="modal-header">
	                        <h4 class="modal-title">Add New Role</h4>
	                      </div>
	                      <div class="modal-body">
                          <div class="form-group">
                            <label for="role name" style="font-size: 15px;">Role Name: <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" required="" placeholder="Enter role name"> 
                          </div>
                          <div class="form-group">
                            <label for="assign permission" style="font-size: 15px;">Assign Permission: 
                              <span class="text-danger">*</span></label>
                            <div class="row">
                              @foreach ($permissions as $permission)
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <input type="checkbox" name="permission[]" value="{{$permission->id}}"> {{$permission->name}}
                                </div>
                              </div>
                              @endforeach
                            </div>
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
                          <th>Role Name</th>
		                      <th width="10%">Action</th>
		                    </tr>
		                </thead>
		                <tbody>
                        @foreach ($roles as $role)
                          <tr>
                              <td>{{$role->name}}</td>
                              <td>
                                  {{-- edit button --}}
                                  <button type="button" class="btn btn-success waves-effect waves-light fa fa-edit" data-toggle="modal" data-target="#id{{$role->id}}"></button>

                                  <div class="modal fade" id="id{{$role->id}}">
                                    <div class="modal-dialog modal-lg">
                                      <form action="{{ route('role.update',$role->id) }}" method="post">
                                          @csrf
                                          @method('PUT')
                                          <div class="modal-content animated flipInX">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Edit Role</h4>
                                            </div>
                                            <div class="modal-body">
                                              <div class="form-group">
                                                <label for="role name" style="font-size: 15px;">Role Name: 
                                                  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" required="" 
                                                value="{{$role->name}}">
                                              </div>
                                              <div class="form-group">
                                                <label for="assign permission" style="font-size: 15px;">Assign Permission: 
                                                  <span class="text-danger">*</span></label><br>
                                                <div class="row">
                                                  @foreach ($permissions as $permission)
                                                  <div class="col-sm-3">
                                                    <div class="form-group">
                                                      <input type="checkbox" name="permission[]" value="{{$permission->id}}" 
                                                      @foreach ($role->permissions as $role_permission)
                                                        @if ($role_permission->id == $permission->id)
                                                          checked
                                                        @endif
                                                      @endforeach
                                                      > {{$permission->name}}
                                                    </div>
                                                  </div>
                                                  @endforeach
                                                </div>
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
                                  <form method="post" id="delete-form-{{$role->id}}"
                                      action="{{route('role.destroy',$role->id)}}" style="display: none;">

                                      {{csrf_field()}}

                                      {{method_field('DELETE')}}

                                  </form>

                                  <a href="" onclick="
                                          if(confirm('Are yoy sure, You want to delete this data?')){
                                            event.preventDefault();document.getElementById('delete-form-{{$role->id}}').submit();
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
                          <th>Role Name</th>
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

<!--Select Plugins Js-->
<script src="{{ asset('theme/assets/plugins/select2/js/select2.min.js') }}"></script>

<!--Multi Select Js-->
<script src="{{ asset('theme/assets/plugins/jquery-multi-select/jquery.multi-select.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/jquery-multi-select/jquery.quicksearch.js') }}"></script>
    
<script>
  $(document).ready(function() {
    $('.single-select').select2();
  
    $('.multiple-select').select2();

    //multiselect start
    $('#my_multi_select1').multiSelect();
    $('#my_multi_select2').multiSelect({
        selectableOptgroup: true
    });

    $('#my_multi_select3').multiSelect({
        selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        afterInit: function (ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function (e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function (e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });

    $('.custom-header').multiSelect({
      selectableHeader: "<div class='custom-header'>Selectable items</div>",
      selectionHeader: "<div class='custom-header'>Selection items</div>",
      selectableFooter: "<div class='custom-header'>Selectable footer</div>",
      selectionFooter: "<div class='custom-header'>Selection footer</div>"
    });
  });
</script>

@endsection