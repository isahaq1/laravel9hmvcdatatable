<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\Lga;

use Modules\Location\Entities\State;
use Modules\Location\Entities\Region;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\Location;
use Illuminate\Contracts\Support\Renderable;

class LocationController extends Controller
{


    public function index()
    {

        return view('location::index',[
            'countries'     => Country::get(),
            'states'        => State::get(),
            'regions'       => Region::get(),
            'locations'     => Location::get()
        ]);


    }

    public function create()
    {
        return view('location::create');
    }


    public function storeCountry(Request $request)
    {
        foreach($request->country_name as $cname){
            $data['country_name'] = $cname;
        }
        Country::create($data);

        $response = array(
            'success'  =>true,
            'title'=>'Country',
            'message'  => 'Added successfully'
        );
        return json_encode($response);
    }


    public function storeRegion(Request $request)
    {

        Region::create($request->all());
        $response = array(
            'success'   => true,
            'title'     => 'Country',
            'message'   => 'Added successfully'
        );
        return json_encode($response);
    }


    public function storeLocation(Request $request)
    {
        $cdata = Region::findOrFail($request->region_id);

        $data['country_id']     = $cdata->state->country_id;
        $data['state_id']       = $cdata->state_id;
        $data['region_id']      = $request->region_id;
        $data['location_name']  = $request->location_name;

        $data['gio_lat'] = $request->gio_lat;
        $data['gio_long'] = $request->gio_long;

        Location::create($data);
        $response = array(
            'success'  =>true,
            'title'=>'Country',
            'message'  => 'Added successfully'
        );
        return json_encode($response);
        
    }


    public function storeLga(Request $request)
    {

        $cdata = State::findOrFail($request->state_id);

        $data['country_id']     = $cdata->state->country_id;
        $data['state_id']       = $cdata->state_id;
        $data['lga_name']       = $request->lga_name;

        Lga::create($data);

        $response = array(
            'success'  =>true,
            'title'=>'Country',
            'message'  => 'Added successfully'
        );
        return json_encode($response);
        
    }


    public function store(Request $request)
    {
       
    }

    public function show($id)
    {
        return view('location::show');
    }


    public function edit($id)
    {
        return view('location::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }


    public function delteLocation($id)
    {
        $data = Location::where('id',$id)->delete();
        $response = array(
            'success'  =>true,
            'title'=>'Country',
            'message'  => 'Delete successfully'
        );
        return json_encode($response);
    }


    public function delteRegion($id)
    {
        $data = Region::where('id',$id)->delete();
        $response = array(
            'success'  =>true,
            'title'=>'Country',
            'message'  => 'Delete successfully'
        );
        return json_encode($response);
    }


}
