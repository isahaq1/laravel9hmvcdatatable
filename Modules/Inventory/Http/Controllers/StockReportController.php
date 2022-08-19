<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Inventory\Entities\Store;
use Modules\Inventory\Entities\InvStock;
use Illuminate\Contracts\Support\Renderable;

class StockReportController extends Controller
{

    public function index(){

        $client = Client::get(['client_name','id']);
        $store = Store::get(['store_name','id']);
        return view('inventory::__stock_report',[
            'ptitle'=>'Stock Report',
            'client'=>$client,
            'store'=>$store
        ]);

    }
    

    
    public function getStockList(Request $request)
    {
        

        if ($request->ajax()) {

            
            $data = InvStock::getStockReport();


            return DataTables::of($data)->addIndexColumn()
                
                ->addColumn('client_name', function ($data) {
                    return $data->client_name;
                })

                ->addColumn('store_name', function ($data) {
                    return $data->store_name;
                })

                ->addColumn('product_name', function ($data) {
                    return $data->product_name;
                })

                ->addColumn('stock_case_qty', function ($data) {
                    return $data->stock_case_qty;
                })

                ->addColumn('stock_unit_qty', function ($data) {
                    return $data->stock_unit_qty;
                })
               

            ->rawColumns([ 'client_name', 'store_name','product_name','stock_case_qty','stock_unit_qty'])
            ->make(true);
        }

    }

}
