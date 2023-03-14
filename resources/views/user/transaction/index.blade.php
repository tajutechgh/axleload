@extends('user.layouts.master')

@section('head')
<style>
    #output, #final {
        background-color:#ff6a61;;
    }
</style>
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Transactions</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="alert alert-danger alert-dismissible d-none" role="alert" id="alertbox">
    <button type="button" class="btn btn-warning close" data-dismiss="alert"><strong>Ignore</strong></button>
    <div class="alert-icon contrast-alert">
        <i class="fa fa-times"></i>
    </div>
    <div class="alert-message">
        This vehicle with number <strong><span id="vehicleNumber"></span></strong> has been blacklisted at 
        <span id="station"></span> on <span id="date"></span>.<br>
        <strong>Reason For Blacklist:</strong> <span id="reason"></span><br><br>
        {{-- arrest button --}}
        <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" 
        data-target="#blacklistId">Arrest</button>
    </div>
</div>

<div class="modal fade" id="blacklistId"> 
  <div class="modal-dialog">
    <form id="modalForm" method="post">
      @csrf
      <div class="modal-content animated flipInX">
        <div class="modal-header">
          <h4 class="modal-title">Issue an Arrest</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="vehicle number" style="font-size: 15px;">Vehicle Number: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="" required="" id="vNumber" readonly="">
          </div>
          <div class="form-group">
            <label for="date of arrest" style="font-size: 15px;">Date of Arrest: 
            <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="arrest_date" required="" 
            value="{{Carbon\carbon::now()->format('d-m-y')}}">
          </div>
          <div class="form-group">
            <label for="arresting officer" style="font-size: 15px;">Arresting Officer: <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" name="officer_name" required="" value="{{Auth::user()->name}}">
          </div>
          <div class="form-group">
            <label for="station name" style="font-size: 15px;">Station Name: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="" required="" value="{{Auth::user()->station['station_name']}}" readonly="">
          </div>
          <div class="form-group">
            <label for="remarks" style="font-size: 15px;">Remarks: <span class="text-danger">*</span></label>
            <textarea name="reason" class="form-control" rows="3" required="">
            </textarea>
          </div>
          <input type="hidden" name="status" value="arrest">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Stop
          </button>
          <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Proceed</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Carefully fill in the form.
            </div>
            <form action="{{ route('transaction.store') }}" method="post" id="myForm">
                @csrf
                <div class="card-body">
                    <fieldset class="border p-2">
                        <legend  class="w-auto">Vehicle Details:</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <form method="get">
                                    <div class="form-group">
                                        <label for="vehicle type" style="font-size: 15px;">Vehicle Type: <span class="text-danger">*</span></label>
                                        <select name="vehicleType_id" class="form-control" required="" id="vehicletype">
                                            <option selected disabled="">Select vehicle type:</option>
                                            @foreach ($vehicletypes as $vehicletype)
                                                <option value="{{$vehicletype->id}}">{{$vehicletype->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vehicle number" style="font-size: 15px;">Vehicle Number: <span class="text-danger">*</span></label>
                                    <input type="text" name="vehicle_number" class="form-control" required="" placeholder="Enter vehicle number" id="blacklisted">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="commodity" style="font-size: 15px;">Commodity: <span class="text-danger">*</span></label>
                                    <select name="commodity_id" class="form-control" required="">
                                        <option selected disabled="">Select commodity</option>
                                        @foreach ($commodities as $commodity)
                                            <option value="{{$commodity->id}}">{{$commodity->commodity_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ex_height">
                                    <label for="vehicle type" style="font-size: 15px;">Height: <span class="text-danger">*</span>
                                    </label>
                                    <input type="hidden" name="excess_height" id="excess_height">
                                    <input type="text" name="actual_height" class="form-control" required id="actual_height"
                                    placeholder="Enter vehicle height">
                                    @foreach ($heights as $height)
                                        <input type="hidden" name="height_id" value="{{$height->id}}">
                                        <input type="hidden" id="height" value="{{$height->standard_height}}">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="vehicle number" style="font-size: 15px;">Origin: <span class="text-danger">*</span></label>
                                    <input type="text" name="origin" class="form-control" required="" placeholder="Enter origin">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="vehicle number" style="font-size: 15px;">Destination: <span class="text-danger">*</span></label>
                                    <input type="text" name="destination" class="form-control" required="" placeholder="Enter destination">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type of goods" style="font-size: 15px;">Types of Goods: <span class="text-danger">*</span></label>
                                    <select name="goods_type" class="form-control" required="">
                                        <option selected disabled="">Select type of goods</option>
                                        <option>Local</option>
                                        <option>Transit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    {{-- <h5 align="center"><u>Vehicle Details:</u></h5><br> --}}
                    <br>
                    <fieldset class="border p-2">
                        <legend  class="w-auto">Transaction Details:</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="transaction date" style="font-size: 15px;">Transaction Date: 
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="transaction_date" class="form-control" required="" 
                                    value="{{Carbon\carbon::now()->format('d-m-y')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="transaction time" style="font-size: 15px;">Transaction Time: <span class="text-danger">*</span></label>
                                    <input type="text" name="transaction_time" class="form-control" required="" 
                                    value="{{Carbon\carbon::now()->format('h:i')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="option1" style="font-size: 15px;">Avoided Weighing?</label>
                                    <input type="checkbox" name="avoided_weighing" id="checkbox" value="1" />
                                    <input type="text" name="officer_name" class="form-control" id="showthis" placeholder="Enter name of officer who brought the culprit back">
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <img id="image" style="width: 200px;">
                            </div>
                            <input type="hidden" name="invoice_number" value="<?php echo rand(1,1000); ?>">
                            <input type="hidden" name="region_name" value="{{Auth::user()->station->region['region_name']}}">
                            <input type="hidden" name="station_id" id="station_id" value="{{Auth::user()->station['id']}}">
                            <input type="hidden" name="station_name" value="{{Auth::user()->station['station_name']}}">
                            <input type="hidden" name="vehicleType" id="vehicleType">
                            <input type="hidden" name="fine_amount" id="fine_amount">
                        </div><br>
                        <div class="row">
                            {{-- <div class="col-md-2"></div> --}}
                            <div class="col-md-12">
                                <div id="axles_number"></div>
                            </div>
                        </div>
                    </fieldset>
                    {{-- <h5 align="center"><u>Transaction Details:</u></h5><br> --}}
                    <br>
                    <div align="center">
                        {{-- <a href="{{ route('vehicletype.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a> --}}
                        <button type="submit" class="btn btn-success fa fa-check-square-o" id="ajaxSubmit" title="Click here to submit the form"> Save Transaction</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

<!-- jquery JavaScript-->
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script> 

<script type="text/javascript">

    $(document).ready(function(){

        $(document).on('change', '#vehicletype', function(){

            // $.get() - 1. url 2. data 
            $.getJSON('{{ route("vehicleDetails") }}', { vehicleId: $(this).val()})
            // chain the done promise to the get ajax request
            .done(function(response){
                // console.log(response);
                $('#axles_number').empty();

                $('#image').attr("src",response.image);

                $('#vehicleType').val(response.description);

                //Initialize tbl to emty
                var tbl = "";

                tbl= "<table class='table table-bordered'>"+
                    "<thead>"+
                        "<tr>"+
                            // "<th width='10%'>Image</th>"+
                            "<th width='10%'><b>Acceptable</b></br>Weight(Tons):&nbsp;&nbsp;&nbsp;ESAL:</th>"+
                            "<th width='10%'>Actual Weight (Tons) <span class='text-danger'>*</span></th>"+
                            "<th width='10%'>Excess Weight<span class='text-danger'>*</span></th>"+
                        "</tr>"+
                    "</thead>";

                $.each(response.axles_numbers, function(index, element){

                    tbl += "<tbody>"+
                                "<tr class='info'>"+
                                    // "<td>"+"<img src="+response.image+" style='height: 50px;'>"+"</td>"+
                                    "<td>"+
                                        "<input type='text' value="+element.weight+" name='acceptable_weight[]' readonly style='width: 80px;' class='weightone' autofocus>&nbsp;&nbsp;&nbsp;&nbsp;"+
                                        "<input type='text' id='normal_esal' value="+element.normal_esal+" name='acceptable_esal[]' readonly style='width: 80px;'>"
                                    +"</td>"+
                                    "<td>"+
                                        "<input type='text' name='actual_weight[]' class='form-control weighttwo' id='weighttwo'>"+
                                        "<input type='hidden' name='actual_esal[]' class='form-control' id='actual_esal'>"
                                    +"</td>"+
                                    "<td>"+
                                        "<input type='text' id='output' name='excess_weight[]' class='form-control' readonly>"+
                                        "<input type='hidden' id='excess_esal' name='excess_esal[]' class='form-control' readonly>"
                                    +"</td>"+
                                "</tr>"+
                            "</tbody>";
                });

                tbl += "<tfoot>"+
                            "<tr class='result'>"+
                                // "<th>Gross Weight:</th>"+
                                "<th>"+
                                "<input type='text' value="+response.gross_weight+" class='form-control' id='gross' readonly>"+"</th>"+
                                "<th>"+"<input type='text' class='form-control' name='gross_actual_weight' id='total' required readonly autofocus>"+"</th>"+
                                "<th>"+
                                "<input type='text' class='form-control' name='gross_excess_weight' id='final' readonly required>"+
                                "</th>"+
                            "</tr>"+
                        "</tfoot>"+
                    "</table>";

                $("#axles_number").append(tbl);
            });
        });
    });
    
    // gross actual weight calculation
    function calculateTotal() {

        //Initialize total to 0
        var total = 0;

        $(".weighttwo").each(function() {
          // Sum only if the text entered is number and greater than 0
          if (!isNaN(this.value) && this.value.length != 0) {

            total += parseFloat(this.value);
          }
        });

        //.toFixed() method will roundoff the final sum to 0 decimal places
        $('#total').val(total.toFixed(2));
        
        // gross excess weight calculation
        var result = parseInt($('#total').val() - $('#gross').val());

        if (result >= 0) {

            $('#final').val(result.toFixed(2));

            if(parseInt($('#final').val()) > 0){
                
                $.ajax({

                    type : 'get',

                    url  : '{{URL::to("/overload")}}',

                    data : {excess_value:$('#final').val()},
                })

                .done(function(data) {

                   $('#fine_amount').val(data);
                });
            }
        }
    }

    //Iterate through each Textbox and add keyup event handler
    $("body").on('focusout mouseout', '.weighttwo', function(e) {

        e.preventDefault();

        calculateTotal();
    });

    // function to show iput box for officers name when checked
    $(function () {
        $('input[id="showthis"]').hide();
        //show it when the checkbox is clicked
        $('input[name="avoided_weighing"]').on('click', function () {

            if ($(this).prop('checked')) {

                $('input[id="showthis"]').fadeIn();

            } else {

                $('input[id="showthis"]').hide();
            }
        });
    });
 
    // excess weight calculation
    $(document).on('keyup','.weighttwo', function(){

        var $row = $(this).closest(".info");

        var totalAccept = parseInt($row.find('.weightone').val()) || 0;

        var totalActua = parseInt($row.find('.weighttwo').val()) || 0;

        var output = totalActua - totalAccept;

        $row.find('#output').val(output.toFixed(2));
    });

    // excess height calculation
    $(document).on('keyup','#actual_height', function(){

        var $row = $(this).closest(".ex_height");

        var actualHeight = parseInt($row.find('#actual_height').val()) || 0;

        var height = parseInt($row.find('#height').val()) || 0;

        var result = actualHeight-height;

        if (result > 0 && confirm('Are you sure of the height?')) {

            $row.find('#excess_height').val(result);
        }
    });

    //actual esal and excess esal calculation
    $(document).on('blur focusout','#weighttwo', function(){

        var $row = $(this).closest(".info");

        var weight = parseInt($row.find('#weighttwo').val()) || 0;

        var actual_esal  = ((weight/8.2)**4.5);

        $row.find('#actual_esal').val(actual_esal.toFixed(2));

        var actual = parseInt($row.find('#actual_esal').val()) || 0;

        var normal = parseInt($row.find('#normal_esal').val()) || 0;

        var excess_esal = actual - normal;

        $row.find('#excess_esal').val(excess_esal.toFixed(2));
    });


    $(document).ready(function() {
        $("#blacklisted").on('focusout mouseout',function() {
            $.ajax({
                type: "get",
                url: '{{url('/blacklisted')}}',
                data: {vehicle_number:$('#blacklisted').val()},
                dataType: "json",
                success: function(response) {
                    if(response.success){
                        $('#vehicleNumber').html(response.blacklist.vehicle_number);
                        $('#reason').html(response.blacklist.reason);
                        $('#vNumber').val(response.blacklist.vehicle_number);
                        $('#station').html(response.blacklist.station_name);
                        $('#date').html(response.blacklist.blacklist_date);
                        // var blacklistedId = response.blacklist.id;
                        $('#modalForm').attr('action','{{ route("arrest.update",' + response.blacklist.id + ') }}');
                        $('#alertbox').removeClass('d-none');
                    }
                }
            });
        });
    });
</script>

@endsection