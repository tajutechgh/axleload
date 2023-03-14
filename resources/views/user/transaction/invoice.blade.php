@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Invoice</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="card">
    <div class="card-body">
        <!-- Content Header (Page header) -->
        <div class="text-center">
            @foreach ($systems as $system)
                <h5>{{$system->company_name}}</h5>
                <img src="{{Storage::disk('local')->url($system->image)}}" style="width: 80px;">
            @endforeach
            <h6>(Axle Load Weighing Certificate)</h6>
        </div><br>
        {{-- <section class="content-header">
            <h3>
            Invoice
            @foreach ($transactions as $transaction)
                <small>#{{$transaction->invoice_number}}</small>
            @endforeach
            </h3>
        </section> --}}

        <!-- Main content -->
        <section class="invoice">
            <div class="row">
                @foreach ($transactions as $transaction)
                    <div class="col-md-3">
                        <table>
                            <tr><th>OPERATOR:</th><td>{{$transaction->station['operating_company']}}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <tr><th>At:</th><td>{{$transaction->station['station_name']}}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <tr><th>CONTACT:</th><td>{{$transaction->station['contact_number']}}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <tr><th>TRANSACTION ID:</th><td>{{$transaction->invoice_number}}</td></tr>
                        </table>
                    </div>
                @endforeach
            </div><hr><br>
            <div class="row">
                <div class="col-md-4">
                    <div class="table-responsive">
                        @foreach ($transactions as $transaction)
                            <table>
                                <tr><th>Number of Axles:</th><td>{{$transaction->vehicle_type['axles_number']}}</td></tr>
                                <tr><th>Vehicle Number:</th><td>{{$transaction->vehicle_number}}</td></tr>
                            </table>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="table-responsive">
                        @foreach ($transactions as $transaction)
                            <table>
                                <tr><th>Origin:</th><td>{{$transaction->origin}}</td></tr>
                                <tr><th>Commodity:</th><td>{{$transaction->commodity['commodity_name']}}</td></tr>
                            </table>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="table-responsive">
                        @foreach ($transactions as $transaction)
                            <table>
                                <tr><th>Destination:</th><td>{{$transaction->destination}}</td></tr>
                                <tr><th>Transaction Date:</th><td>{{$transaction->transaction_date}}</td></tr>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div><hr><br>
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        @foreach ($transactions as $transaction)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Axle Number</th>
                                        <th>Actual Weight</th>
                                        <th>Excess Weight</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->trans_axles as $element)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$element->actual_weight}}</td>
                                            <td>
                                                @if ($element->excess_weight > 0)
                                                    {{$element->excess_weight}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><b>Gross Weight(Tons):</b></td>
                                        <td><b>{{$transaction->gross_actual_weight}}</b></td>
                                        <td><b>{{$transaction->gross_excess_weight}}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive pull-right">
                        <h4 align="center">FINE DETAILS</h4>
                        @foreach ($transactions as $transaction)
                            @if ($transaction->avoided_weighing != NULL)
                                <table class="table table-stripped">
                                    <tr><th>Avoided Weighing Fine(GH₵):</th><td>@setting('avoidedweighingfine')</td></tr>
                                </table>
                            @endif
                            @if ($transaction->gross_excess_weight > 0)
                                <table class="table table-stripped">
                                    <tr><th>Excess Weighing Fine(GH₵):</th><td>{{$transaction->fine_amount}}</td></tr>
                                </table>
                            @endif
                            @if ($transaction->excess_height > 0)
                                <table class="table table-stripped">
                                    <tr><th>Excess Height Fine(GH₵):</th><td>@setting('overheightfine')</td></tr>
                                </table>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div><hr><br>
            <div class="row">
                @foreach ($transactions as $transaction)
                    <div class="col-md-6">
                        <table>
                            <tr><th>Attendent:</th><td>{{$transaction->user['name']}}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tr><th>Sign:</th><td>...................................</td></tr>
                        </table>
                    </div>
                @endforeach
            </div>
            <!-- this row will not appear when printing -->
            <hr>
            <div class="row no-print">
                <div class="col-lg-3">
                    <a href="{{ route('transaction.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
                    <a href="javascript:window.print();" class="btn btn-info m-1 fa fa-print">Print</a>
                </div>
            </div>
        </section><!-- /.content -->
    </div>
</div>

@endsection

@section('script')

@endsection