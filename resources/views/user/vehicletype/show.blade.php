@extends('user.layouts.master')

@section('head')

@endsection

@section('content')

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
		<h4 class="page-title">Station Details</h4>
    </div>
</div><!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">
            	Details Of The Station.
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr><th>Description:</th><td>{{$vehicletype->description}}</td></tr>   
                        <tr><th>Number of Axles:</th><td>{{$vehicletype->axles_number}}</td></tr>   
                        <tr><th>Vehicle Image:</th><td><img src="{{Storage::disk('local')->url($vehicletype->image)}}" 
                            style="width: 130px;"></td>
                        </tr>   
                    </table><br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width='10%'>Axle Number</th>
                                <th width='10%'>Weight (Tons) <span class='text-danger'>*</span></th>
                                <th width='10%'>Normal ESAL <span class='text-danger'>*</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicletypes as $element)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$element->weight}}</td>
                                    <td>{{$element->normal_esal}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                                <tr>
                                    <th>Gross Weight:=></th>
                                    <th>{{$vehicletype->gross_weight}}Tons</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </table>
                </div><br>
                <div align="center">
                    <a href="{{ route('vehicletype.index') }}" class="btn btn-primary fa fa-arrow-left" title="Click here to go back"> Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection

@section('script')

@endsection