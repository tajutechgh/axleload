@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Receipt</h4>
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
            <h6>(Transaction Fine Receipt)</h6>
        </div><br>
        <section class="content-header">
            <h3>
            Receipt
            @foreach ($transaction_fines as $fine)
                <small>#{{$fine->invoice_number}}</small>
            @endforeach
            </h3>
        </section>

        <!-- Main content -->
        <section class="invoice">
            <div class="table-responsive">
                @foreach ($transaction_fines as $fine)
                    <h5 align="center">Receipt Details</h5>
                    <table class="table table-hover">
                        @if ($fine->action == 'fine')
                            <tr><th>Status:</th><td>Fined</td></tr>
                        @elseif($fine->action == 'paidalready')
                            <tr><th>Status:</th><td>Paid Already(Elsewhere)</td></tr>
                        @elseif($fine->action == 'pardon')
                            <tr><th>Status:</th><td>Pardoned</td></tr>
                        @elseif($fine->action == 'partpayment')
                            <tr><th>Status:</th><td>Part Payment and Pardoned</td></tr>
                        @endif
                        <tr><th>Vehicle Number:</th><td>{{$fine->vehicle_number}}</td></tr>
                        <tr><th>Station Name:</th><td>{{$fine->station['station_name']}}</td></tr>
                        <tr><th>Cashier:</th><td>{{$fine->user['name']}}</td></tr>
                    </table><br>
                    <h5 align="center">Fine Details</h5>
                    <table class="table table-hover">
                        @if ($fine->excess_weight_fine != NULL)
                            <tr><th>Excess Weight Fine(GH₵):</th><td>{{$fine->excess_weight_fine}}</td></tr>
                        @endif
                        @if ($fine->excess_height_fine != NULL)
                            <tr><th>Excess Height Fine(GH₵):</th><td>{{$fine->excess_height_fine}}</td></tr>
                        @endif
                        @if ($fine->avoided_weighing_fine != NULL)
                            <tr><th>Avoided Weighing Fine(GH₵):</th><td>{{$fine->avoided_weighing_fine}}</td></tr>
                        @endif
                        <tr><th>Total Fine(GH₵):</th><td>{{$fine->total_fine}}</td></tr>
                    </table>
                    <table class="table table-hover">
                        @if ($fine->payment_mode != NULL)
                            <tr>
                                <th>Payment Mode:</th>
                                <td>
                                    @if ($fine->payment_mode == 'mobile_money')
                                        Mobile Money
                                    @elseif ($fine->payment_mode == 'cash')  
                                        Cash
                                    @elseif ($fine->payment_mode == 'check')
                                        Check
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @if ($fine->check_number != NULL)
                            <tr><th>Check Number:</th><td>{{$fine->check_number}}</td></tr>
                        @endif
                        @if ($fine->mobile_money_number != NULL)
                            <tr><th>Mobile Money Number:</th><td>{{$fine->mobile_money_number}}</td></tr>
                        @endif
                    </table>
                    <table class="table table-hover" style="background-color: #ffcb8b;">
                        @if ($fine->amount_paid != NULL)
                            <tr><th>Amount Paid(GH₵):</th><td>{{$fine->amount_paid}}</td></tr>
                        @endif
                        @if ($fine->balance_amount != 0)
                            <tr><th>Balance Amount(GH₵):</th><td>{{$fine->balance_amount}}</td></tr>
                        @endif
                        <tr><th>Action Date(Payment):</th><td>{{$fine->payment_date}}</td></tr>
                        @if ($fine->remarks != NULL)
                            <tr><th>Remarks:</th><td>{!!htmlspecialchars_decode($fine->remarks)!!}</td></tr>
                        @endif
                    </table>
                @endforeach
            </div>
            <hr>
            <div class="row no-print">
                <div class="col-lg-3">
                    <a href="{{ route('overloadcases.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
                    <a href="javascript:window.print();" class="btn btn-info m-1 fa fa-print">Print</a>
                </div>
            </div>
        </section><!-- /.content -->
    </div>
</div>

@endsection

@section('script')

@endsection