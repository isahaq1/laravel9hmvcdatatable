<?php

namespace Modules\Merchandise\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Outlet\Entities\Outlet;
use Illuminate\Contracts\Support\Renderable;
use Modules\VisitProcess\Entities\VisitProductAvailability;

class ReadyStockController extends Controller
{
    
    public function index()
    {
        $outlet = Outlet::get(['outlet_name','outlet_id']);
        $client = Client::get(['client_name','id']);
        return view('merchandise::__outlet_ready_stock',[
            'ptitle'=>'Outlet ready stock',
            'outlet'=>$outlet,
            'client'=>$client
        ]);
    }


    public function getOutletReadyStock(Request $request){
        

        if ($request->ajax()) {

            $data = VisitProductAvailability::readyStock($request);

            return DataTables::of($data)->addIndexColumn()

                ->addColumn('outlet_name', function ($data) {
                    return $data->outlet_name;
                })
                ->addColumn('product_name', function ($data) {
                    return $data->product_name;
                })
                ->addColumn('availability_qty', function ($data) {
                    return @$data->availability_qty;
                })

            ->rawColumns(['outlet_name', 'product_name', 'availability_qty'])
            ->make(true);
        }

    }




}
