@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Technical Reports</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Availabel Technical Reports.
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <h5>Detailed Reports:</h5>
                            <li>
                                <a href="{{ route('detailedvehicletype') }}">Vehicles Weighed Grouped by Type of Vehicle.
                                </a>
                            </li> 
                            <li><a href="{{ route('detailedattendant') }}">Vehicles Weighed Grouped by Attendant.</a></li> 
                        </ul>  
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <h5>Summary Reports:</h5>
                            @foreach (Auth::user()->roles as $role)
                                @if ($role->name == 'Station Admin')
                                    {{-- station report grouped by vehicle type summary --}}
                                    <li><a href="{{ route('summaryvehicletype') }}">Vehicles Weighed Grouped by Type of Vehicle.</a></li>
                                @endif
                                @if ($role->name == 'Regional Admin')
                                    {{-- regional report grouped by vehicle type summary --}}
                                    <li><a href="{{ route('regionalsummaryvehicletype') }}">Vehicles Weighed Grouped by Type of Vehicle.</a></li>
                                @endif
                                @if ($role->name == 'National Admin')
                                    {{-- national report grouped by vehicle type summary --}}
                                    <li><a href="{{ route('nationalsummaryvehicletype') }}">Vehicles Weighed Grouped by Type of Vehicle.</a></li>
                                @endif
                                @if ($role->name == 'Station Admin')
                                    {{-- station report grouped by attendant summary --}}
                                    <li><a href="{{ route('summaryattendant') }}">Vehicles Weighed Grouped by Attendant.</a>
                                    </li> 
                                @endif
                                @if ($role->name == 'Regional Admin')
                                    {{-- regional report grouped by attendant summary --}}
                                    <li><a href="{{ route('regionalsummaryattendant') }}">Vehicles Weighed Grouped by Attendant.</a></li>
                                @endif
                                @if ($role->name == 'National Admin')
                                    {{-- national report grouped by attendant summary --}}
                                    <li><a href="{{ route('nationalsummaryattendant') }}">Vehicles Weighed Grouped by Attendant.</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

@endsection