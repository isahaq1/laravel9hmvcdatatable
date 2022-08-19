<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClientWiseStockController extends Controller
{
    
    public function index()
    {
        return view('inventory::__client_wise_stock',[
            'ptitle'=>'Stock report'
        ]);
    }

    
    public function create()
    {
        return view('inventory::create');
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        return view('inventory::show');
    }

    
    public function edit($id)
    {
        return view('inventory::edit');
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
