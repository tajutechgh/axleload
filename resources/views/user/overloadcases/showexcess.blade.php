@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Over Load Case Details</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <form action="{{ route('overloadcase.store') }}" method="post">
                @csrf
                <div class="card-header" align="center">
                    Carefully Fill In the Form.
                </div>
                <div class="card-body">
                    <h5 align="center">
                        <input type="hidden" name="station_id" value="{{$excess->station['id']}}">
                        {{$excess->station['station_name']}}
                    </h5><br>
                    <div class="row">
                        <div class="col-md-6">
                            <tr>
                                <th><b>Vehicle Number:</b></th> 
                                <td><input type="text" name="" readonly value="{{$excess->vehicle_number}}"></td>
                            </tr>
                        </div>
                        <div class="col-md-6">
                            <tr>
                                <th><b>Excess Weight(Tons):</b></th> 
                                <td><input type="text" name="" readonly value="{{$excess->gross_excess_weight}}"></td>
                            </tr>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <tr>
                                <th><b>Date of Fine:</b></th> 
                                <td><input type="text" name="" readonly value="{{$excess->transaction_date}}"></td>
                            </tr>
                        </div>
                        <div class="col-md-6">
                            <tr>
                                <th><b>Fine Amount(GH₵):</b></th> 
                                <td>
                                <input type="text" name="fine_amount" readonly value="{{$excess->fine_amount}}" 
                                style="background-color: red;">
                                </td>
                            </tr>
                        </div>
                    </div><br>
                    <input type="hidden" name="transaction_id" value="{{$excess->id}}">
                    <input type="hidden" name="invoice_number" value="<?php echo rand(1,1000); ?>">
                    <div style="background-color: #fddbb5;">
                        <table><br>
                            <tr>
                                <th><b>Payment Status :</b></th>
                                <td>
                                    <select name="status" style="width: 400px;" required>
                                        <option value="0">Not Payed</option>
                                        <option value="1">Payed</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><b>Amount Paid(GH₵):</b></th>
                                <td><input type="text" name="amount_paid" style="width: 400px;" required></td>
                            </tr>
                            <tr>
                                <th><b>Date of Payment :</b></th>
                                <td><input type="date" name="payment_date" style="width: 400px;" required></td>
                            </tr>
                            <tr>
                                <th><b>Remarks :</b></th>
                                <td><textarea name="remarks" style="width: 400px;" rows="5" required></textarea></td>
                            </tr>
                        </table><br>
                    </div><br>
                    <div align="center">
                        <a href="{{ route('excess') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
                        <button type="submit" class="btn btn-success fa fa-check-square-o" title="Click here to submit the form"> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

@endsection