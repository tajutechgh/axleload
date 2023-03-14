@extends('admin.layouts.master')

@section('show-head')

@endsection

@section('main-content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Add New Vehicle Type</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Carefully Fill In The Form.
            </div>
            <div class="card-body">
            	<form action="{{ route('vehicletype.store') }}" method="post">
            		@csrf
		            <div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
	            				<label for="description">Description <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="description" required="" placeholder="Enter description">
	            			</div>
	            		</div>
	            		{{-- <div class="col-md-4">
	            			<div class="form-group">
	            				<label for="gross weight">Gross Weight (Tons) <span class="text-danger">*</span></label>
	            				<input type="text" class="form-control" name="gross_weight" required="" readonly="" value="20">
	            			</div>
	            		</div> --}}
	            		<div class="col-md-6">
	            			<div class="form-group" id="dvMain">
	            				<label for="number of axles">Number of Axles <span class="text-danger">*</span></label>
	            				<input type="number" name="axles_number" required="" placeholder="Enter number of axles" style="width: 490px; height: 38px" id="txtNoOfRec">
	            				<button type="button" class="btn btn-success fa fa-plus pull-right" id="btnNoOfRec" 
	            				title="Click here to enter the weight of each axle"></button>
	            			</div>
	            		</div>
		            </div><br>
		            <div id="AddControll">
		                
		            </div><br>
		            <div align="center">
		            	<a href="{{ route('vehicletype.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
		            	<button type="submit" class="btn btn-success fa fa-check-square-o" title="Click here to submit the form"> Save</button>
		            </div>
	            </form>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('show-script')

<!-- jquery JavaScript-->
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function() {
    	load();
    });

    function load(){

        $("#txtNoOfRec").focus();

    	$("#btnNoOfRec").click(function(){

    		$("#AddControll").empty();

            var NoOfRec = $("#txtNoOfRec").val();

            if(NoOfRec > 0){

           	  createControll(NoOfRec);

            }

    	});
    	
    }

    function createControll(NoOfRec){

        //Initialize tbl to emty
        var tbl = "";

        tbl= "<table class='table table-bordered'>"+
                    "<thead>"+
                    	"<tr>"+
                    		"<th width='10%'>Axle Number</th>"+
                    	    "<th width='10%'>Image</th>"+
                            "<th width='10%'>Weight (Tons) <span class='text-danger'>*</span></th>"+
                            "<th width='10%'>Normal ESAL <span class='text-danger'>*</span></th>"+
                    	"</tr>"+
                    "</thead>";

        for (i = 1; i <= NoOfRec; i++) {

        	tbl += "<tbody>"+
                        "<tr>"+
                            "<td>" + i + "</td>"+
                            "<td>"+"<img src='{{ asset('theme/assets/images/axle.png') }}' style='height: 50px;'>"+"</td>"+
                            "<td>"+"<input type='text' class='form-control weight' name='weight[]' id='' required autofocus >"+"</td>"+
                            "<td>"+"<input type='text' class='form-control' name='normal_esal[]' id='' required autofocus >"+"</td>"+
                        "</tr>"+
                    "</tbody>";
        }

        tbl += "<tfoot>"+
                    "<tr>"+
                        "<th></th>"+
                        "<th></th>"+
                        "<th>"+"<input type='text' class='form-control total' name='gross_weight' id='total' required readonly placeholder='Gross weight'>"+"</th>"+
                        "<th></th>"+
                    "</tr>"+
                "</tfoot>"+
            "</table>";

        $("#AddControll").append(tbl);
    }

    function calculateTotal() {

        //Initialize total to 0
        var total = 0;

        $(".weight").each(function() {
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
    $("body").on('keyup', '.weight', function(e) {

        e.preventDefault();

        calculateTotal();
    });
</script>

@endsection