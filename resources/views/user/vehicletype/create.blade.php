@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

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
            	<form action="{{ route('vehicletype.store') }}" method="post" enctype="multipart/form-data">
            		@csrf
		            <div class="row">
	            		<div class="col-md-4">
	            			<div class="form-group">
	            				<label for="description" style="font-size: 15px;">Description: <span class="text-danger">*
                                </span></label>
	            				<input type="text" class="form-control" name="description" required="" placeholder="Enter description">
	            			</div>
	            		</div>
	            		<div class="col-md-4">
                            <div class="form-group" id="dvMain">
                                <label for="number of axles" style="font-size: 15px;">Number of Axles: <span class="text-danger">*</span></label>
                                <input type="text" name="axles_number" required="" placeholder="Enter number of axles"
                                 id="txtNoOfRec" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
	            			<div class="form-group">
                                <label for="image" style="font-size: 15px;">Image: <span class="text-danger">*</span></label>
                                <br>
	            				<input type="file" name="image" required>
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

@section('script')

<!-- jquery JavaScript-->
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function() {
    	load();
    });

    function load(){

        $("#txtNoOfRec").keyup(function(){

            $("#AddControll").empty();

            var NoOfRec = $(this).val();

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
                            "<th width='10%'>Weight (Tons) <span class='text-danger'>*</span></th>"+
                            "<th width='10%'>Normal ESAL <span class='text-danger'>*</span></th>"+ 
                    	"</tr>"+
                    "</thead>";

        for (i = 1; i <= NoOfRec; i++) {

        	tbl += "<tbody>"+
                        "<tr class='info'>"+
                            "<td>" + i + "</td>"+
                            "<td>"+"<input type='text' class='form-control weight' name='weight[]' id='weight' required autofocus>"+"</td>"+
                            "<td>"+"<input type='text' class='form-control' name='normal_esal[]' id='esal' required autofocus >"+"</td>"+
                        "</tr>"+
                    "</tbody>";
        }

        tbl += "<tfoot>"+
                    "<tr>"+
                        "<th></th>"+
                        "<th>"+"<input type='text' class='form-control total' name='gross_weight' id='total' required readonly placeholder='Gross weight'>"+"</th>"+
                        "<th></th>"+
                    "</tr>"+
                "</tfoot>"+
            "</table>";

        $("#AddControll").append(tbl);
    }
    
    // gross weight calculation
    function calculateTotal() {

        //Initialize total to 0
        var total = 0;

        $(".weight").each(function() {
          // Sum only if the text entered is number and greater than 0
          if (!isNaN(this.value) && this.value.length != 0) {

            total += parseFloat(this.value);
          }
        });

        //.toFixed() method will roundoff the final sum to 0 decimal places
        $('#total').val(total.toFixed(2));
    }

    //Iterate through each Textbox and add keyup event handler
    $("body").on('keyup', '.weight', function(e) {

        e.preventDefault();

        calculateTotal();
    });

    // esal calculation
    $(document).on('keyup','#weight', function(){

        var $row = $(this).closest(".info");

        var weight = parseInt($row.find('#weight').val()) || 0;

        var esal  = ((weight/8.2)**4.5);

        $row.find('#esal').val(esal.toFixed(2));
    });
</script>

@endsection