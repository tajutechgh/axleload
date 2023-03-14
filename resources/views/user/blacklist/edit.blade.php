@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Edit Blacklist</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header" align="center">
            	Carefully Edit The Form.
            </div>
            <div class="card-body">
            	@include('include.message')
            	<form action="{{ route('blacklist.update',$blacklist->id) }}" method="post">
            		@csrf
            		@method('PUT')
        			<div class="form-group">
                    	<label for="vehicle number" style="font-size: 15px;">Vehicle Number: <span class="text-danger">*
                        </span></label>
                    	<input type="text" class="form-control" name="vehicle_number" required="" 
                    	value="{{$blacklist->vehicle_number}}">
                    </div>
                    <div class="form-group">
                        <label for="date of blacklist" style="font-size: 15px;">Date of Blacklist: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="blacklist_date" required="" 
                        value="{{$blacklist->blacklist_date}}">
                    </div>
                    <div class="form-group">
                        <label for="officer's name" style="font-size: 15px;">Officer's Name: <span class="text-danger">*
                        </span></label>
                        <input type="text" class="form-control" name="officer_name" required="" 
                        value="{{$blacklist->officer_name}}">
                    </div>
                    <div class="form-group">
                        <label for="officer's name" style="font-size: 15px;">Status: <span class="text-danger">*
                        </span></label>
                        <select name="status" class="form-control" required="">
                            <option>{{$blacklist->status}}</option>
                            <option>pending</option>
                            <option>dealt with</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reason" style="font-size: 15px;">Reason: <span class="text-danger">*
                        </span></label>
                        <textarea name="reason" class="form-control" required="" rows="5">{{$blacklist->reason}}</textarea>
                    </div>
                    <input type="hidden" name="station_id" value="{{Auth::user()->station['id']}}">
                    <input type="hidden" name="station_name" value="{{Auth::user()->station['station_name']}}">
		            <div align="center">
		            	<a href="{{ route('blacklist.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
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