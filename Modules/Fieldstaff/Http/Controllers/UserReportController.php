<?php

namespace Modules\Fieldstaff\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Routing\Controller;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Region;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\Location;
use Modules\Fieldstaff\Entities\UserReport;
use Illuminate\Contracts\Support\Renderable;


class UserReportController extends Controller
{
    
    public function index()
    {
        $Location   = Location::get(['location_name','id']);
        $Region     = Region::get(['region_name','id']);
        $country    = Country::get(['country_name','id']);
        $state      = State::get(['state_name','id']);

        $user       = User::where(['user_type'=>3,'status'=>1])->get(['name','id']);

        return view('fieldstaff::__fieldstaff_reoprt',[
            'country'   => $country,
            'state'     => $state,
            'region'    => $Region,
            'location'  => $Location,
            'user'      => $user,
            'ptitle'    => 'Fieldstaff Outlet Report'
        ]);

    }


    public function create()
    {
        return view('fieldstaff::create');
    }


    public function store(Request $request)
    {
        
    }


    public function show($id)
    {
        return view('fieldstaff::show');
    }


    public function edit($id)
    {
        return view('fieldstaff::edit');
    }


    public function update(Request $request, $id)
    {
        
    }


    public function destroy($id)
    {
        
    }


    
    public function getUserOutlet(Request $request)
    {

        if ($request->ajax()) {

            $data  = UserReport::user_report($request);

            return DataTables::of($data)->addIndexColumn()

                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('outlet_name', function ($data) {
                    return $data->outlet_name;
                })
                
                ->addColumn('address', function ($data) {
                    return $data->outlet_address;
                })

                ->addColumn('outlet_cp', function ($data) {
                    return $data->cpf_name.' '.$data->cpl_name;
                })

                ->rawColumns(['name', 'outlet_name','address','outlet_cp'])
                ->make(true);
        }

    }
}
