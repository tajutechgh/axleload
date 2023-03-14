@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Add New Station</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Carefully Fill In The Form.
            </div>
            <div class="card-body">
            	@include('include.message')
            	<form action="{{ route('station.store') }}" method="post">
            		@csrf
		            <div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label for="station name" style="font-size: 15px;">Station Name: <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="station_name" required="" placeholder="Enter station name">
	            			</div>
	            			<div class="form-group">
	            				<label for="operating company" style="font-size: 15px;">Operating Company (Optional):</label>
	            				<input type="text" class="form-control" name="operating_company" placeholder="Enter operating company">
	            			</div>
	            			<div class="form-group">
	            				<label for="contact person" style="font-size: 15px;">Contact Person: <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="contact_person" required="" placeholder="Enter contact person">
	            			</div>
	            			<div class="form-group">
	            				<label for="contact number" style="font-size: 15px;">Contact Number: <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="contact_number" required="" placeholder="Enter contact number">
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label for="station code" style="font-size: 15px;">Station Code (Must be unique): 
	            					<span class="text-danger">*</span>
	            				</label>
	            				<input type="text" class="form-control" name="station_code" required="" placeholder="Enter station code">
	            			</div>
	            			<div class="form-group">
	            				<label for="tolerance weight" style="font-size: 15px;">Tolerance Weight (tons): 
	            					<span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="tolerance_weight" required="" placeholder="Enter tolerance/Adjustment weight">
	            			</div>
	            			<div class="form-group">
	            				<label for="weighing device" style="font-size: 15px;">Weighing Device: <span class="text-danger">*</span></label>
	            				<select name="weighing_device" class="form-control" required="">
	            					<option selected disabled="">Select weighing device</option>
	            					<option>Weighing Bridge</option>
	            					<option>Weighing Pad</option>
	            				</select>
	            			</div>
	            			<div class="form-group">
	            				<label for="weighing device" style="font-size: 15px;">Region: <span class="text-danger">*</span></label>
	            				<select name="region_id" class="form-control" required="">
	            					<option selected disabled="">Select region</option>
	            					@foreach ($regions as $region)
	            						<option value="{{$region->id}}">{{$region->region_name}}</option>
	            					@endforeach
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