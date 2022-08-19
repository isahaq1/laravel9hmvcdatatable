<?php

namespace Modules\Subcription\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Routing\Controller;
use Modules\Subcription\Http\Requests\PackageRequest;
use Modules\Subcription\Entities\Package;

class PackageController extends Controller
{

    public function index()
    {
        return view('subcription::packages.index',[
            'packages' => Package::orderBy('id','desc')->get()
        ]);
    }

    public function create()
    {
        return view('subcription::packages.create');
    }


    public function store(PackageRequest $request)
    {
        $package = new Package();
        $package->fill($request->all());
        $package->offer_status = @$request->offer_status ?? 0;
        $package->status = @$request->status ?? 0;
        $package->save();
        Toastr::success('Packages invoices added successfully :)','Success');
        return redirect()->route('packages-invoices.index');

    }

    public function show($id)
    {
        return view('subcription::show');
    }


    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('subcription::packages.create',[
            'package' => $package
        ]);
    }


    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->fill($request->all());
        $package->offer_status = @$request->offer_status ?? 0;
        $package->status = @$request->status ?? 0;
        $package->save();
        Toastr::success('Package updated successfully :)','Success');
        return redirect()->route('packages.index');
    }


    public function destroy($id)
    {
        Package::findOrFail($id)->delete();
        Toastr::success('Package deleted successfully :)','Success');
        return response()->json(['success' => 'Data Deleted Successfully']);
    }
}
