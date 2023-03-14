<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Commodity;
use Auth;

class CommodityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $commodities = Commodity::latest()->get();

        return view('user.commodity.index',compact('commodities'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'commodity_name'=>'required',

        ]);

        $commodity = new Commodity;

        $commodity->user_id=Auth::user()->id;
        $commodity->commodity_name=$request->commodity_name;

        $commodity->save();

        return redirect(route('commodity.index'))->with('message','Commodity added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'commodity_name'=>'required',

        ]);

        $commodity = Commodity::find($id);

        $commodity->user_id=Auth::user()->id;
        $commodity->commodity_name=$request->commodity_name;

        $commodity->save();

        return redirect(route('commodity.index'))->with('message','Commodity updated successfully');
    }

    public function destroy($id)
    {
        Commodity::where('id',$id)->delete();

        return redirect()->back()->with('message','Commodity deleted successfully');
    }
}
