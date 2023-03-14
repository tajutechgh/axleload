@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Station Details</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Details Of The Station.
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr><th>Station Name:</th><td>{{$station->station_name}}</td></tr>   
                        <tr><th>Station Code:</th><td>{{$station->station_code}}</td></tr>   
                        <tr><th>Region Allocated:</th><td>{{$station->region['region_name']}}</td></tr>   
                        <tr><th>Operating Company:</th><td>{{$station->operating_company}}</td></tr>   
                        <tr><th>Type of Weighing Device:</th><td>{{$station->weighing_device}}</td></tr>   
                        <tr><th>Contact Person:</th><td>{{$station->contact_person}}</td></tr>   
                        <tr><th>Contact Number:</th><td>{{$station->contact_number}}</td></tr>   
                        <tr><th>Tolerance/Adjustment Weight(Tons):</th><td>{{$station->tolerance_weight}}</td></tr>
                    </table>
                </div><br>
                <div align="center">
                    <a href="{{ route('station.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

@endsection