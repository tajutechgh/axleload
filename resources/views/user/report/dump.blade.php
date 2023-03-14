@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Detailed Report</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Type of Vehicle Detailed Report.
            </div>
            <div class="card-body">
                <h5>Reporting Period:</h5><br>
                <form method="post" action="{{ route('searchdetailedvehicletype') }}">
                    @csrf
                    <label>Start Date:</label>
                    <input type="date" name="startdate" required="">
                    <label>End Date:</label>
                    <input type="date" name="enddate" required="">
                    <button class="btn-success btn-xs">Generate Report</button>
                </form><br><hr>
                <div class="table-responsive">
                    @if (isset($details))
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
                        <h5 align="center">AXLE LOAD DETAILED REPORT</h5><br>
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
                                    <tr><th>CONTACT:</th><td>{{Auth::user()->station['contact_number']}}</td></tr>
                                </table>
                            </div>
                        </div><hr><br>
                        @foreach ($details as $trans => $transactions)
                            <u><h5>{{$trans}}</h5></u>
                            <strong><p align="center">AXLE WEIGHT (TONS)</p></strong>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Vehicle Number</th>
                                        <th>Comodity</th>
                                        <th>No. of Axles</th>
                                        <?php $count = 0; ?>
                                        @foreach ($transactions as $transaction)
                                            <?php if ($count == 1) break; ?>
                                            @for ($i = 1; $i <= $transaction->vehicle_type['axles_number']; $i++)
                                                <th>Axle {{ $i }}</th>
                                            @endfor
                                            <?php $count++; ?>
                                        @endforeach
                                        <th>Gross</th>
                                        <th style="background-color: #fddbb5;">Excess Weight</th>
                                        <th style="background-color: #fddbb5;">Excess Esal</th>
                                        <th style="background-color: #fddbb5;">% Excess Gross Weight</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{$transaction->transaction_date}}</td>
                                            <td>{{$transaction->vehicle_number}}</td>
                                            <td>{{$transaction->commodity['commodity_name']}}</td>
                                            <td>{{$transaction->vehicle_type['axles_number']}}</td>
                                            @foreach ($transaction->trans_axles as $element)
                                                <td>{{$element->actual_weight}}</td>
                                            @endforeach
                                            <td>
                                                {{$transaction->gross_actual_weight}}
                                                @if ($transaction->gross_excess_weight > 0)
                                                    <span class="text-danger">(OL)</span>
                                                @endif
                                            </td>
                                            <td style="background-color: #fddbb5;">{{$transaction->gross_excess_weight}}</td>
                                            <td style="background-color: #fddbb5;">
                                                @if ($transaction->trans_axles->sum('excess_esal') >= 0)
                                                    {{$transaction->trans_axles->sum('excess_esal')}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td style="background-color: #fddbb5;">
                                                <?php 
                                                $percentage = ($transaction->gross_excess_weight/$transaction->gross_actual_weight)*100;
                                                ?>
                                                {{ number_format((float)$percentage, 2, '.', '') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #E5F0FF;">
                                        <th>Total OVER LOADED(OL)</th>
                                        <th>{{$trans}}</th>
                                        <th>
                                            <?php $count = 0; ?>
                                            @foreach ($transactions as $transaction) 
                                                <?php if ($count == 1) break; ?>
                                                    <span class="text-danger">
                                                        {{$transaction->where('gross_excess_weight','>', 0)->where('vehicleType_id', $transaction->vehicle_type['id'])->count()}}
                                                    </span>
                                                <?php $count++; ?>
                                            @endforeach
                                            &nbsp;&nbsp;&nbsp;
                                            out of
                                        </th>
                                        <th>
                                            <?php $count = 0; ?>
                                            @foreach ($transactions as $transaction) 
                                                <?php if ($count == 1) break; ?>
                                                    <span class="text-danger">
                                                        {{$transaction->where('gross_excess_weight','>=', 0)->where('vehicleType_id', $transaction->vehicle_type['id'])->count()}}
                                                    </span>
                                                <?php $count++; ?>
                                            @endforeach
                                        </th>
                                        <?php $count = 0; ?>
                                        @foreach ($transactions as $transaction)
                                            <?php if ($count == 1) break; ?>
                                            @for ($i = 1; $i <= $transaction->vehicle_type['axles_number']; $i++)
                                                <th></th>
                                            @endfor
                                            <?php $count++; ?>
                                        @endforeach
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table><br>
                        @endforeach
                        <div>
                            <fieldset class="border p-2">
                               <legend  class="w-auto">REMARKS</legend>
                               <div class="row">
                                   <div class="col-md-3"></div>
                                   <?php $count = 0; ?>
                                   @foreach ($transactions as $transaction) 
                                        <?php if ($count == 1) break; ?>
                                            <?php 
                                                $vehicleWeighed = $transaction->count(); 
                                                $vehicleOverloaded =$transaction->where('gross_excess_weight','>', 0)->count();
                                            ?>
                                        <?php $count++; ?>
                                        @foreach ($transaction->trans_axles as $element)
                                            <?php $totalEsal = $element->sum('excess_esal'); ?>
                                        @endforeach
                                   @endforeach
                                   <div class="col-md-7">
                                       <table>
                                           <tr><th>Total Number of Vehicles WEIGHED:</th><td><input type="text" readonly="" value="{{$vehicleWeighed}}">
                                           </td></tr>
                                           <tr><th>Number of OVERLOADED Vehicles:</th><td><input type="text" readonly="" 
                                            value="{{$vehicleOverloaded}}">
                                           </td></tr>
                                           <tr><th>Total ESAL for the Overloaded Vehicles:</th><td><input type="text" 
                                            readonly="" value="{{$totalEsal}}">
                                           </td></tr>
                                           <tr><th>TREND OF OVERLOADING:</th><td><input type="text" readonly="">
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