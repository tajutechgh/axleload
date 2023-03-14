@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Edit Station</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Carefully Edit The Form.
            </div>
            <div class="card-body">
            	<form action="" method="post">
            		@csrf
            		@method('PUT')
		            <div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label for="station name">Station Name <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="" required="" placeholder="Enter station name">
	            			</div>
	            			<div class="form-group">
	            				<label for="operating company">Operating Company (Optional)</label>
	            				<input type="text" class="form-control" name="" placeholder="Enter operating company">
	            			</div>
	            			<div class="form-group">
	            				<label for="contact person">Contact Person <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="" required="" placeholder="Enter contact person">
	            			</div>
	            			<div class="form-group">
	            				<label for="contact number">Contact Number <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="" required="" placeholder="Enter contact number">
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label for="station code">Station Code (Must be unique) <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="" required="" placeholder="Enter station code">
	            			</div>
	            			<div class="form-group">
	            				<label for="tolerance weight">Tolerance Weight (tons) <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="" required="" placeholder="Enter tolerance/Adjustment weight">
	            			</div>
	            			<div class="form-group">
	            				<label for="weighing device">Weighing Device <span class="text-danger">*</span></label>
	            				<select name="" class="form-control" required="">
	            					<option selected disabled="">Select weighing device</option>
	            					<option>Weighing Bridge</option>
	            					<option>Weighing Pad</option>
	            				</select>
	            			</div>
	            		</div>
		            </div><br>
		            <div align="center">
		            	<a href="{{ route('station.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
		            	<button type="submit" class="btn btn-success fa fa-check-square-o" title="Click here to submit the form"> Save</button>
		            </div>
	            </form>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

@endsection