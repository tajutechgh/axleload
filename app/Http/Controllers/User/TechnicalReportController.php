<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Model\user\Transaction;
use App\Model\user\Vehicle_type;
use App\Model\user\System;
use App\Model\user\Station;
use App\Model\user\Region;
use App\Model\user\Overload_case;
use Auth;
use DB;

class TechnicalReportController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function technical()
    {
    	return view('user.report.technical');
    }
    
    //detailed report grouped by type of vehicle
    public function detailedVehicleType()
    {
    	$systems = System::latest()->limit(1)->get();

    	return view('user.report.vehicletypedetailed',compact('systems'));
    }

    public function searchDetailedVehicleType(Request $request)
    {
        $systems = System::latest()->limit(1)->get();

        $startdate = $request['startdate'];

        $enddate = $request['enddate'];

        $transaction = Transaction::whereBetween('created_at', [$startdate,$enddate])
    	                            ->where('station_id', '=', Auth::user()->station['id'])
                                    ->orderBy('vehicleType_id', 'desc')
                                    ->get()
                                    ->groupBy('vehicleType');

        // $transaction =  DB::table('transactions')
        //                 ->whereBetween('created_at', [$startdate,$enddate])
        //                 ->where('station_id', '=', Auth::user()->station['id'])
        //                 ->orderBy('vehicleType_id', 'desc')
		      //           ->groupBy('vehicleType')
		      //           ->get();

        

        // $transaction = DB::select("SELECT vt.description, t.transaction_date, t.vehicle_number, c.commodity_name, 
        // 	                    vt.axles_number, ta.actual_weight
								// FROM transactions t
								// LEFT JOIN commodities c ON t.commodity_id = c.id
								// LEFT JOIN vehicle_types vt ON t.vehicleType_id = vt.id
								// LEFT JOIN trans_axles ta ON t.id = ta.transaction_id
								// WHERE t.created_at BETWEEN '$startdate' AND '$enddate'
								// GROUP BY vt.description ORDER BY t.vehicleType_id DESC");

        // dd($transaction);

        if (count($transaction) > 0) {

            return view('user.report.vehicletypedetailed',compact('systems'))->withDetails($transaction)->withQuery($startdate,$enddate);
        }

        return view('user.report.vehicletypedetailed',compact('systems'))->withMessage('No transactions available for the period selected!'); 
    }
    
    //detailed report grouped by attendant
    public function detailedAttendant()
    {
    	$systems = System::latest()->limit(1)->get();

    	return view('user.report.attendantdetailed',compact('systems'));
    }

    public function searchDetailedAttendant()
    {
        $systems = System::latest()->limit(1)->get();

        $startdate = Input::get('startdate');

        $enddate = Input::get('enddate');

        $transaction =  Transaction::whereBetween('created_at', [$startdate,$enddate])
    	                            ->where('station_id', '=', Auth::user()->station['id'])
                                    ->orderBy('vehicleType_id', 'desc')
                                    ->get()
                                    ->groupBy(['attendant','vehicleType']);

        // $transaction =  Transaction::select('transaction_date','vehicle_number')
        //                 ->whereBetween('created_at', [$startdate,$enddate])
    	   //              ->where('station_id', '=', Auth::user()->station['id'])
        //                 ->orderBy('vehicleType_id', 'desc')
        //                 ->get()
        //                 ->groupBy(['attendant','vehicleType']);

        // dd($transaction);

        if (count($transaction) > 0) {

            return view('user.report.attendantdetailed',compact('systems'))->withDetails($transaction)->withQuery($startdate,$enddate);
        }

        return view('user.report.attendantdetailed',compact('systems'))->withMessage('No transactions available for the period selected!'); 
    }

    //station summary report grouped by type of vehicle
    public function summaryVehicleType()
    {
    	$systems = System::latest()->limit(1)->get();

    	return view('user.report.vehicletypesummary',compact('systems'));
    }

    public function searchSummaryVehicleType(Request $request)
    {
        $systems = System::latest()->limit(1)->get();

        $startdate = $request['startdate'];

        $enddate = $request['enddate'];

        $station = Auth::user()->station['id']; 

        $transaction = DB::select("SELECT IFNULL(vt.description, 'Total') type_of_Vehicle, 
                            POWER((gross_actual_weight/8.2),4.5)/COUNT(*) mean_equivalence,
                            POWER((gross_actual_weight/8.2),4.5) equivalence_factor,
                            ROUND((gross_excess_weight/gross_actual_weight)*100, 2) extent_overload,
        				    COUNT(*) number_of_vehicles, 
        				    COUNT(IF(gross_excess_weight > 0,1,NULL)) overload_vehicles, 
        				    (COUNT(IF(gross_excess_weight > 0,1,NULL))/COUNT(*))*100 as overloading_trend 
        		    	    FROM transactions t 
        		    	    LEFT JOIN vehicle_types vt on t.vehicleType_id=vt.id  
        		    	    WHERE t.created_at BETWEEN '$startdate' AND '$enddate' AND t.station_id = '$station'
        		    	    GROUP BY vt.description WITH ROLLUP");

        // dd($transaction);

        if (count($transaction) > 0) {

            return view('user.report.vehicletypesummary',compact('systems'))->withDetails($transaction)->withQuery($startdate,$enddate);
        }

        return view('user.report.vehicletypesummary',compact('systems'))->withMessage('No transactions available for the period selected!'); 
    }

    //regional summary report grouped by type of vehicle
    public function regionalSummaryVehicleType()
    {
    	$systems = System::latest()->limit(1)->get();

    	$stations = Station::all();

    	return view('user.report.regionalvehicletypesummary',compact('systems','stations'));
    }

    public function searchRegionalSummaryVehicleType(Request $request)
    {
        $systems = System::latest()->limit(1)->get();

        $startdate = $request['startdate'];

        $enddate = $request['enddate'];

        $station_name = $request['station_name'];

        $station = Auth::user()->station['id'];

        $transaction = DB::select("SELECT IFNULL(vt.description, 'Total') type_of_Vehicle, 
                            POWER((gross_actual_weight/8.2),4.5)/COUNT(*) mean_equivalence,
                            POWER((gross_actual_weight/8.2),4.5) equivalence_factor,
                            ROUND((gross_excess_weight/gross_actual_weight)*100, 2) extent_overload,
        				    COUNT(*) number_of_vehicles, 
        				    COUNT(IF(gross_excess_weight > 0,1,NULL)) overload_vehicles, 
        				    (COUNT(IF(gross_excess_weight > 0,1,NULL))/COUNT(*))*100 as overloading_trend 
        		    	    FROM transactions t 
        		    	    LEFT JOIN vehicle_types vt on t.vehicleType_id=vt.id  
        		    	    WHERE t.created_at BETWEEN '$startdate' AND '$enddate' AND t.station_id = '$station' 
        		    	    AND t.station_name = '$station_name'
        		    	    GROUP BY vt.description WITH ROLLUP");

        // dd($transaction);

        if (count($transaction) > 0) {

            return view('user.report.regionalvehicletypesummary',compact('systems','stations'))->withDetails($transaction)->withQuery($startdate,$enddate);
        }

        return view('user.report.regionalvehicletypesummary',compact('systems','stations'))->withMessage('No transactions available for the period selected!'); 
    }
    
    //national summary report grouped by type of vehicle
    public function nationalSummaryVehicleType()
    {
    	$systems = System::latest()->limit(1)->get();

    	$stations = Station::all();

    	$regions = Region::all();

    	return view('user.report.nationalvehicletypesummary',compact('systems','stations','regions'));
    }

    public function searchNationalSummaryVehicleType(Request $request)
    {
        $systems = System::latest()->limit(1)->get();

        $startdate = $request['startdate'];

        $enddate = $request['enddate'];

        $station_name = $request['station_name'];

        $region_name = $request['region_name'];

        $station = Auth::user()->station['id'];

        $transaction = DB::select("SELECT IFNULL(vt.description, 'Total') type_of_Vehicle, 
                            POWER((gross_actual_weight/8.2),4.5)/COUNT(*) mean_equivalence,
                            POWER((gross_actual_weight/8.2),4.5) equivalence_factor,
                            ROUND((gross_excess_weight/gross_actual_weight)*100, 2) extent_overload,
        				    COUNT(*) number_of_vehicles, 
        				    COUNT(IF(gross_excess_weight > 0,1,NULL)) overload_vehicles, 
        				    (COUNT(IF(gross_excess_weight > 0,1,NULL))/COUNT(*))*100 as overloading_trend 
        		    	    FROM transactions t 
        		    	    LEFT JOIN vehicle_types vt on t.vehicleType_id=vt.id  
        		    	    WHERE t.created_at BETWEEN '$startdate' AND '$enddate' AND t.station_id = '$station' 
        		    	    AND t.station_name = '$station_name' AND t.region_name = '$region_name'
        		    	    GROUP BY vt.description WITH ROLLUP");

        // dd($transaction);

        if (count($transaction) > 0) {

            return view('user.report.nationalvehicletypesummary',compact('systems','stations','regions'))->withDetails($transaction)->withQuery($startdate,$enddate);
        }

        return view('user.report.nationalvehicletypesummary',compact('systems','stations','regions'))->withMessage('No transactions available for the period selected!'); 
    }
    
    //station summary report grouped by attendant
    public function summaryAttendant()
    {
    	$systems = System::latest()->limit(1)->get();

    	return view('user.report.attendantsummary',compact('systems'));
    }

    public function searchSummaryAttendant(Request $request)
    {
        $systems = System::latest()->limit(1)->get();

        $startdate = $request['startdate'];

        $enddate = $request['enddate'];

        $station = Auth::user()->station['id'];

        $transaction =  DB::select("SELECT IFNULL(u.name, 'Total') attendant, 
        	                transaction_date periods,
                            POWER((gross_actual_weight/8.2),4.5)/COUNT(*) mean_equivalence,
                            POWER((gross_actual_weight/8.2),4.5) equivalence_factor,
                            ROUND((gross_excess_weight/gross_actual_weight)*100, 2) extent_overload,
        				    COUNT(*) number_of_vehicles, 
        				    COUNT(IF(gross_excess_weight > 0,1,NULL)) overload_vehicles, 
        				    (COUNT(IF(gross_excess_weight > 0,1,NULL))/COUNT(*))*100 as overloading_trend 
        		    	    FROM transactions t 
        		    	    LEFT JOIN users u on t.user_id=u.id  
        		    	    WHERE t.created_at BETWEEN '$startdate' AND '$enddate' AND t.station_id = '$station'
        		    	    GROUP BY u.name WITH ROLLUP");

        // dd($transaction);

        if (count($transaction) > 0) {

            return view('user.report.attendantsummary',compact('systems'))->withDetails($transaction)->withQuery($startdate,$enddate);
        }

        return view('user.report.attendantsummary',compact('systems'))->withMessage('No transactions available for the period selected!'); 
    }
   
    //regional summary report grouped by attendant
    public function regionalSummaryAttendant()
    {
    	$systems = System::latest()->limit(1)->get();

    	$stations = Station::all();

    	return view('user.report.regionalattendantsummary',compact('systems','stations'));
    }

    public function searchRegionalSummaryAttendant(Request $request)
    {
        $systems = System::latest()->limit(1)->get();

        $startdate = $request['startdate'];

        $enddate = $request['enddate'];

        $station_name = $request['station_name'];

        $station = Auth::user()->station['id'];

        $transaction =  DB::select("SELECT IFNULL(u.name, 'Total') attendant, 
        	                transaction_date periods,
                            POWER((gross_actual_weight/8.2),4.5)/COUNT(*) mean_equivalence,
                            POWER((gross_actual_weight/8.2),4.5) equivalence_factor,
                            ROUND((gross_excess_weight/gross_actual_weight)*100, 2) extent_overload,
        				    COUNT(*) number_of_vehicles, 
        				    COUNT(IF(gross_excess_weight > 0,1,NULL)) overload_vehicles, 
        				    (COUNT(IF(gross_excess_weight > 0,1,NULL))/COUNT(*))*100 as overloading_trend 
        		    	    FROM transactions t 
        		    	    LEFT JOIN users u on t.user_id=u.id  
        		    	    WHERE t.created_at BETWEEN '$startdate' AND '$enddate' AND t.station_id = '$station'
        		    	    AND t.station_name = '$station_name'
        		    	    GROUP BY u.name WITH ROLLUP");

        // dd($transaction);

        if (count($transaction) > 0) {

            return view('user.report.regionalattendantsummary',compact('systems','stations'))->withDetails($transaction)->withQuery($startdate,$enddate);
        }

        return view('user.report.regionalattendantsummary',compact('systems','stations'))->withMessage('No transactions available for the period selected!'); 
    }
   
    //national summary report grouped by attendant
    public function nationalSummaryAttendant()
    {
    	$systems = System::latest()->limit(1)->get();

    	$stations = Station::all();

    	$regions = Region::all();

    	return view('user.report.nationalattendantsummary',compact('systems','stations','regions'));
    }

    public function searchNationalSummaryAttendant(Request $request)
    {
        $systems = System::latest()->limit(1)->get();

        $startdate = $request['startdate'];

        $enddate = $request['enddate'];

        $station_name = $request['station_name'];

        $region_name = $request['region_name'];

        $station = Auth::user()->station['id'];

        $transaction =  DB::select("SELECT IFNULL(u.name, 'Total') attendant, 
        	                transaction_date periods,
                            POWER((gross_actual_weight/8.2),4.5)/COUNT(*) mean_equivalence,
                            POWER((gross_actual_weight/8.2),4.5) equivalence_factor,
                            ROUND((gross_excess_weight/gross_actual_weight)*100, 2) extent_overload,
        				    COUNT(*) number_of_vehicles, 
        				    COUNT(IF(gross_excess_weight > 0,1,NULL)) overload_vehicles, 
        				    (COUNT(IF(gross_excess_weight > 0,1,NULL))/COUNT(*))*100 as overloading_trend 
        		    	    FROM transactions t 
        		    	    LEFT JOIN users u on t.user_id=u.id  
        		    	    WHERE t.created_at BETWEEN '$startdate' AND '$enddate' AND t.station_id = '$station'
        		    	    AND t.station_name = '$station_name' AND t.region_name = '$region_name'
        		    	    GROUP BY u.name WITH ROLLUP");

        // dd($transaction);

        if (count($transaction) > 0) {

            return view('user.report.nationalattendantsummary',compact('systems','stations','regions'))->withDetails($transaction)->withQuery($startdate,$enddate);
        }

        return view('user.report.nationalattendantsummary',compact('systems','stations','regions'))->withMessage('No transactions available for the period selected!'); 
    }
}
