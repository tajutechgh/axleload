@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Transactions</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Carefully fill in the form.
            </div>
            <form action="" method="post">
                <div class="card-body">
                    <h5 align="center"><u>Vehicle Details:</u></h5><br>
                    <div class="row">
                        <div class="col-md-4">
                            <form method="get">
                                <div class="form-group">
                                    <label for="vehicle type" style="font-size: 15px;">Vehicle Type: <span class="text-danger">*</span></label>
                                    <select name="" class="form-control" required="" id="vehicletype">
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
                                <input type="text" name="" class="form-control" required="" placeholder="Enter vehicle number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="commodity" style="font-size: 15px;">Commodity: <span class="text-danger">*</span></label>
                                <select name="" class="form-control" required="">
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
                            <div class="form-group">
                                <label for="vehicle type" style="font-size: 15px;">Height:</label>
                                <select name="" class="form-control" required="">
                                    @foreach ($heights as $height)
                                        <option selected >{{$height->standard_height}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vehicle number" style="font-size: 15px;">Origin: <span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control" required="" placeholder="Enter origin">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vehicle number" style="font-size: 15px;">Destination: <span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control" required="" placeholder="Enter destination">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="type of goods" style="font-size: 15px;">Types of Goods: <span class="text-danger">*</span></label>
                                <select name="" class="form-control" required="">
                                    <option selected disabled="">Select type of goods</option>
                                    <option>Local</option>
                                    <option>Transit</option>
                                </select>
                            </div>
                        </div>
                    </div><br>
                    <h5 align="center"><u>Transaction Details:</u></h5><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="transaction date" style="font-size: 15px;">Transaction Date: 
                                <span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control" required="" 
                                value="{{Carbon\carbon::now()->format('d-m-y')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="transaction time" style="font-size: 15px;">Transaction Time: <span class="text-danger">*</span></label>
                                <input type="text" name="" class="form-control" required="" 
                                value="{{Carbon\carbon::now()->format('h:i')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="option1" style="font-size: 15px;">Avoided Weighing?</label>
                                <input type="checkbox" name="avoided_weighing" id="checkbox" value="scheckbox" />
                                <input type="text" name="officer_name" class="form-control" id="showthis" placeholder="Enter name of officer who brought the culprit back">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div id="axles_number"></div>
                        </div>
                    </div>
                    <br>
                    <div align="center">
                        {{-- <a href="{{ route('vehicletype.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a> --}}
                        <button type="submit" class="btn btn-success fa fa-check-square-o" title="Click here to submit the form"> Save Transaction</button>
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
<script src="{{ asset('auto/jlautocalculate.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function(){

        $('#vehicletype').on('change', function(e){

            var id_category = e.target.value;

            $.get('{{ url('vehicletype')}}/'+id_category, function(data){

                console.log(id_category);

                console.log(data);

                $('#axles_number').empty();

                //Initialize tbl to emty
                var tbl = "";

                tbl= "<table class='table table-bordered'>"+
                    "<thead>"+
                        "<tr>"+
                            // "<th width='10%'>Image</th>"+
                            "<th width='10%'><b>Acceptable</b></br>Weight(Tons):&nbsp;&nbsp;&nbsp;ESAL:</th>"+
                            "<th width='10%'>Actual Weight (Tons) <span class='text-danger'>*</span></th>"+
                            "<th width='10%'>Excess <span class='text-danger'>*</span></th>"+
                        "</tr>"+
                    "</thead>";

                $.each(data, function(index, element){

                        tbl += "<tbody>"+
                                    "<tr>"+
                                        // "<td>"+"<img src="+element.image+" style='height: 50px;'>"+"</td>"+
                                        "<td>"+
                                            "<input type='text' value="+element.weight+" class='weightone' readonly style='width: 80px;' id='weightone' autofocus>"+
                                            "<input type='text' value="+element.normal_esal+" readonly style='width: 80px;'>"
                                        +"</td>"+
                                        "<td>"+"<input type='text' class='form-control weighttwo' id='weighttwo'>"+"</td>"+
                                        "<td>"+"<input type='text' id='output' class='form-control' readonly>"+"</td>"+
                                    "</tr>"+
                                "</tbody>";
                });

                tbl += "<tfoot>"+
                            "<tr>"+
                                // "<th>Gross Weight:</th>"+
                                "<th>"+"<input type='text' class='form-control' id='tot' readonly>"+"</th>"+
                                "<th>"+"<input type='text' class='form-control' name='' id='total' required readonly>"+"</th>"+
                                "<th>"+"<input type='text' class='form-control' readonly>"+"</th>"+
                            "</tr>"+
                        "</tfoot>"+
                    "</table>";

                $("#axles_number").append(tbl);
            });
        });
    });

    function calculateTotal() {

        //Initialize total to 0
        var total = 0;

        $(".weighttwo").each(function() {
          // Sum only if the text entered is number and greater than 0
          if (!isNaN(this.value) && this.value.length != 0) {

            total += parseFloat(this.value);
          }
        });
        //Assign the total to label
        //.toFixed() method will roundoff the final sum to 0 decimal places
        $('#total').val(total.toFixed(0));
    }

    //Iterate through each Textbox and add keyup event handler
    $("body").on('keyup', '.weighttwo', function(e) {

        e.preventDefault();

        calculateTotal();
    });

    // function to show iput box for officers name when checked
    $(function () {
        $('input[name="officer_name"]').hide();

        //show it when the checkbox is clicked
        $('input[name="avoided_weighing"]').on('click', function () {
            if ($(this).prop('checked')) {
                $('input[name="officer_name"]').fadeIn();
            } else {
                $('input[name="officer_name"]').hide();
            }
        });
    });

    function total() {

      var sum = 0;
      
      $.each($(".weightone"), function() {
        sum = sum + Number($(this).val());
      });
      
        $("#tot").val(sum);
    }

    //Iterate through each Textbox and add keyup event handler
    $("body").on('focus', '.weightone', function(e) {

        e.preventDefault();

        total();
    });
    
    $(function() {
        $("body").on('keyup', '.weighttwo', function(e) {
            var sum = 0;
            $('.weightone, .weighttwo').each(function(i) {
                if (!isNaN(this.value) && this.value.length != 0) {
                
                    if ($(this).hasClass('weightone')) {
                        sum += parseFloat(this.value);
                    }
                    else {
                        sum -= parseFloat(this.value);
                    } 
                }
            });
            $('#output').val(sum.toFixed(2));
        });
    });

</script>

@endsection