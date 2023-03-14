@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Transaction Fine Details</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <form action="{{ route('overloadcases.store') }}" method="post">
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
                                <td><input type="text" readonly value="{{$excess->vehicle_number}}"></td>
                            </tr>
                        </div>
                        <div class="col-md-6">
                            <tr>
                                <th><b>Date of Fine:</b></th> 
                                <td><input type="text" readonly value="{{$excess->transaction_date}}"></td>
                            </tr>
                        </div>
                    </div><br>
                    <div class="row">
                        @if ($excess->gross_excess_weight > 0)
                            <div class="col-md-6">
                                <tr>
                                    <th><b>Excess Weight(Tons):</b></th> 
                                    <td><input type="text" readonly value="{{$excess->gross_excess_weight}}"></td>
                                </tr>
                            </div>
                        @endif
                        @if ($excess->excess_height > 0)
                            <div class="col-md-6">
                                <tr>
                                    <th><b>Excess Height(CM):</b></th> 
                                    <td><input type="text" readonly value="{{$excess->excess_height}}"></td>
                                </tr>
                            </div>
                        @endif
                    </div><br>
                    <input type="hidden" name="transaction_id" value="{{$excess->id}}">
                    <div style="background-color: #fddbb5;" class="info">
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
                            @if ($excess->excess_height > 0)
                                <tr>
                                    <th><b>Over Height Fine(GH₵):</b></th>
                                    <td>
                                        <input type="text" name="excess_height_fine" style="width: 400px; background-color: 
                                        #ff6a61;" required value="@setting('overheightfine')" readonly class="items">
                                    </td>
                                </tr>
                            @endif
                            @if ($excess->gross_excess_weight > 0)
                                <tr>
                                    <th><b>Over Weight Fine(GH₵):</b></th>
                                    <td>
                                        <input type="text" name="excess_weight_fine" style="width: 400px; background-color: 
                                        #ff6a61;" required value="{{$excess->fine_amount}}" readonly class="items">
                                    </td>
                                </tr>
                            @endif
                            @if ($excess->avoided_weighing == 1)
                                <tr>
                                    <th><b>Avoided Weighing Fine(GH₵):</b></th>
                                    <td>
                                        <input type="text" name="avoided_weighing_fine" style="width: 400px; background-color: #ff6a61;" required value="@setting('avoidedweighingfine')" readonly class="items">
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th><b>Total Fine Amount(GH₵):</b></th>
                                <td><input type="text" name="total_fine" style="width: 400px; background-color: #ff6a61;" required readonly id="tot">
                                </td>
                            </tr>
                            <tr>
                                <th><b>Amount Paid(GH₵):</b></th>
                                <td>
                                    <input type="text" name="amount_paid" style="width: 400px;" required id="amount_paid">
                                </td>
                            </tr>
                            <tr>
                                <th><b>Balance Amount(GH₵):</b></th>
                                <td>
                                    <input type="text" name="balance_amount" style="width: 400px; background-color: #ff6a61;" required readonly id="balance">
                                </td>
                            </tr>
                            <tr>
                                <th><b>Receipt Number:</b></th>
                                <td>
                                    <input type="text" name="invoice_number" style="width: 400px;" required 
                                    value="<?php echo rand(1,1000); ?>">
                                </td>
                            </tr>
                            <tr>
                                <th><b>Date of Payment :</b></th>
                                <td>
                                    <input type="text" name="payment_date" style="width: 400px;" required value="{{Carbon\carbon::now()->format('d-m-y')}}">
                                </td>
                            </tr>
                            <tr>
                                <th><b>Remarks :</b></th>
                                <td><textarea name="remarks" style="width: 400px;" rows="3" required></textarea></td>
                            </tr>
                        </table><br>
                    </div><br>
                    <div align="center">
                        <a href="{{ route('overloadcases.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
                        <button type="submit" class="btn btn-success fa fa-check-square-o" title="Click here to submit the form"> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

<script>
    // balance amount calculation
    $(document).on('keyup','#amount_paid', function(){

        var $row = $(this).closest(".info");

        var totalFine = parseInt($row.find('#tot').val()) || 0;

        var totalPaid = parseInt($row.find('#amount_paid').val()) || 0;

        $row.find('#balance').val(totalFine - totalPaid);
    });

    function getItems()
    {
        var items = document.getElementsByClassName("items");
        var itemCount = items.length;
        var total = 0;
        for(var i = 0; i < itemCount; i++)
        {
            total = total +  parseInt(items[i].value);
        }
        document.getElementById('tot').value = total;
    }
    getItems();
</script>

@endsection