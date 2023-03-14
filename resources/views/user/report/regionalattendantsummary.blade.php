@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Summary Report</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Attendant Summary Report.
            </div>
            <div class="card-body">
                <h5>Reporting Period:</h5><br>
                <form method="post" action="{{ route('searchregionalsummaryattendant') }}">
                    @csrf
                    <select name="station_name">
                        <option selected disabled="">Select station</option>
                        @foreach ($stations as $station)
                            <option value="{{$station->station_name}}">{{$station->station_name}}</option>
                        @endforeach
                    </select>
                    <label>Start Date:</label>
                    <input type="date" name="startdate" required="">
                    <label>End Date:</label>
                    <input type="date" name="enddate" required="">
                    <button class="btn-success btn-xs">Generate Report</button>
                </form><br><hr>
                <div class="table-responsive">
                    @if (isset($details))
                        <div>
                            @foreach ($systems as $system)
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{Storage::disk('local')->url($system->image)}}" style="width: 80px;">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 align="center">GHALoCS</h5>
                                        <h6 align="center">{{$system->system_name}}</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{Storage::disk('local')->url($system->image)}}" style="width: 80px;" 
                                        class="pull-right">
                                    </div>
                                </div><hr>
                            @endforeach
                            <h5 align="center">AXLE LOAD SUMMARY REPORT</h5><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <table>
                                        <tr><th>OPERATOR:</th><td>{{Auth::user()->station['operating_company']}}</td></tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table>
                                        <tr><th>At:</th><td>{{Auth::user()->station['station_name']}}</td></tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table>
                                        @foreach($details as $transaction)
                                            @if ($loop->first)
                                                <tr><th>Periods:</th><td>{{$transaction->periods}}</td></tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div><hr><br>
                        </div>
                        <div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="3" style="background-color: #fddbb5;">
                                            Number of Overloaded Trucks<br>(Extent of Overload)
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Attendant</th>
                                        <th width="3%">Number of Vehicles</th>
                                        <th width="3%">Number of Overload Vehicles</th>
                                        <th width="3%">Mean Equivalence Factor</th>
                                        <th>Trend of Overloading</th>
                                        <th style="background-color: #fddbb5;">Less Than 10%</th>
                                        <th style="background-color: #fddbb5;">10-20%</th>
                                        <th style="background-color: #fddbb5;"> >20% </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      $total = 0;
                                    ?>
                                    @foreach ($details as $transaction)
                                        <tr>
                                            <td>{{$transaction->attendant}}</td>
                                            <td>{{$transaction->number_of_vehicles}}</td>
                                            <td>{{$transaction->overload_vehicles}}</td>
                                            <td>{{number_format((float)$transaction->mean_equivalence, 2, '.', '')}}</td>
                                            <td>{{number_format((float)$transaction->overloading_trend, 2, '.', '')}} %</td>
                                            <?php
                                                $query = $transaction->extent_overload;
                                                if ($query < '10') {
                                                    $lessTen = count($query);
                                                }elseif($query >= '10' && $query <= '20'){
                                                    $inBetween = count($query);
                                                }elseif($query > '20'){
                                                    $greaterTwenty = count($query);
                                                }
                                            ?>
                                            <td style="background-color: #fddbb5;">{{$lessTen}}</td>
                                            <td style="background-color: #fddbb5;">{{$inBetween}}</td>
                                            <td style="background-color: #fddbb5;">{{$greaterTwenty}}</td>
                                        </tr>
                                        <?php 
                                            $totalVehicleNumber = $total + $transaction->number_of_vehicles;
                                            $totalVehicleOverloaded = $total + $transaction->overload_vehicles;
                                            $totalEquivalenceFactor = $total + $transaction->equivalence_factor;
                                            $totalMeanEquivalenceFactor = $total + $transaction->mean_equivalence;
                                            $totalTrendOverloading = $total + $transaction->overloading_trend;
                                        ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <fieldset class="border p-2">
                               <legend  class="w-auto">REMARKS</legend>
                               <div class="row">
                                   <div class="col-md-3"></div>
                                   <div class="col-md-7">
                                       <table>
                                           <tr><th>Total Number of Vehicles WEIGHED:</th><td><input type="text" readonly="" value="{{$totalVehicleNumber}}">
                                           </td></tr>
                                           <tr><th>Number of OVERLOADED Vehicles:</th><td><input type="text" readonly="" 
                                            value="{{$totalVehicleOverloaded}}">
                                           </td></tr>
                                           <tr><th>Equivalence Factor:</th><td><input type="text" 
                                            readonly="" value="{{number_format((float)$totalEquivalenceFactor, 2, '.', '')}}">
                                           </td></tr>
                                           <tr><th>Mean Equivalence Factor:</th><td><input type="text" readonly="" 
                                            value="{{number_format((float)$totalMeanEquivalenceFactor, 2, '.', '')}}">
                                           </td></tr>
                                           <tr><th>TREND(%) OF OVERLOADING:</th><td><input type="text" readonly="" 
                                            value="{{number_format((float)$totalTrendOverloading, 2, '.', '')}}">
                                           </td></tr>
                                       </table>
                                   </div>
                                   <div class="col-md-2"></div>
                               </div>
                            </fieldset>
                        </div>
                    @elseif(isset($message))
                       <div class="alert alert-danger alert-dismissible" role="alert" id="alertbox">
                           <button type="button" class="btn btn-warning close" data-dismiss="alert"><strong>Close</strong>
                           </button>
                           <div class="alert-icon contrast-alert">
                               <i class="fa fa-times"></i>
                           </div>
                           <div class="alert-message">
                               <h3>{{$message}}</h3>
                           </div>
                       </div>
                    @endif
                </div>

                <div class="pull-right">
                    <a href="javascript:window.print();" class="btn btn-info m-1 fa fa-print">Print</a>
                    <a href="{{ route('technical') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

@endsection