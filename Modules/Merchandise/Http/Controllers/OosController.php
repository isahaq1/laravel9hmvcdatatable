<?php

namespace Modules\Merchandise\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Outlet\Entities\Outlet;
use Modules\VisitProcess\Entities\VisitOos;
use Illuminate\Contracts\Support\Renderable;

class OosController extends Controller
{
    
    public function index()
    {
        $outlet = Outlet::get(['outlet_name','outlet_id']);
        $client = Client::get(['client_name','id']);
        return view('merchandise::__client_wise_oos',[
            'ptitle'=>'Client wise out stock',
            'outlet'=>$outlet,
            'client'=>$client
        ]);

    }


    public function getClientOos(Request $request){
        

        if ($request->ajax()) {

            $data = VisitOos::clientOos($request);

            return DataTables::of($data)->addIndexColumn()

                ->addColumn('client_name', function ($data) {
                    return $data->client_name;
                })
                ->addColumn('outlet_name', function ($data) {
                    return $data->outlet_name;
                })
                ->addColumn('product_name', function ($data) {
                    return $data->product_name;
                })
                ->addColumn('is_oos', function ($data) {
                    return @$data->is_oos;
                })

            ->rawColumns(['client_name','outlet_name', 'product_name', 'is_oos'])
            ->make(true);
        }

    }

    
}
