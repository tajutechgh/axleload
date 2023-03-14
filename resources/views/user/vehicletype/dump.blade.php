@extends('admin.layouts.master')

@section('show-head')

@endsection

@section('main-content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Add New Vehicle Type</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Carefully Fill In The Form.
            </div>
            <div class="card-body">
            	<form action="" method="post">
            		@csrf
		            <div class="row">
	            		<div class="col-md-4">
	            			<div class="form-group">
	            				<label for="description">Description <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="" required="" placeholder="Enter description">
	            			</div>
	            		</div>
	            		<div class="col-md-4">
	            			<div class="form-group">
	            				<label for="number of axles">Number of Axles <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="" required="" placeholder="Enter number of axles">
	            			</div>
	            		</div>
	            		<div class="col-md-4">
	            			<div class="form-group">
	            				<label for="gross weight">Gross Weight (Tons) <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="" required="" placeholder="Enter gross weight">
	            			</div>
	            		</div>
		            </div><br>
		            <div class="table-responsive">
		                <table class="table table-hover">
		                    <thead>
		                    	<tr>
		                    		<th width="10%"></th>
		                    	    <th width="10%"></th>
		                            <th width="10%">Weight (Tons) <span class="text-danger">*</span></th>
		                            <th width="10%">Normal ESAL <span class="text-danger">*</span></th>
		                            <th style="text-align:" width="5%"><a href="#" class="addRow btn btn-success fa fa-plus"></a></th>
		                    	</tr>
		                    </thead>
		                    <tbody>
		                        <tr>
		                            <td>Axle 1</td>
		                            <td><img src="{{ asset('theme/assets/images/axle.png') }}" style="height: 50px;"></td>
		                            <td><input type="text" class="form-control" name=""></td>
		                            <td><input type="text" class="form-control" name=""></td>
		                            <td><a href="#" class="btn btn-danger remove"><i class="fa fa-remove"></i></a></td>
		                        </tr>
		                    </tbody>
		                </table>
		            </div><br>
		            <div align="center">
		            	<a href="{{ route('vehicletype.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
		            	<button type="submit" class="btn btn-success fa fa-check-square-o" title="Click here to submit the form"> Save</button>
		            </div>
	            </form>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('show-script')

<script type="text/javascript">
    
    $('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
        var tr='<tr>'+
                    '<td>Axle 1</td>'+
                    '<td><img src="{{ asset('theme/assets/images/axle.png') }}" style="height: 50px;"></td>'+
                    '<td><input type="text" class="form-control" name=""></td>'+
                    '<td><input type="text" class="form-control" name=""></td>'+
                    '<td><a href="#" class="btn btn-danger remove"><i class="fa fa-remove"></i></a></td>'+
                '</tr>';
        $('tbody').append(tr);
    };

    $('.table tbody').on('click', '.remove', function() {

        var l=$('tbody tr').length;

        if (l==1){

            alert('Last row can not be removed')

        }else{

            $(this).closest('tr').remove();

            total();
        }
    });
</script>

@endsection