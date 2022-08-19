<?php

namespace Modules\User\Http\Controllers;

use Google\Service\AndroidPublisher\DeviceRam;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

use Modules\user\Entities\DeviceRequest;

class DeviceRequestController extends Controller
{


    public function index()
    {

        $sql = DeviceRequest::select("device_requests.*","employees.*");
        $sql->join("employees","employees.user_id","=","device_requests.user_id");
        $data = $sql->get();

        return view('user::__device_request_list');
    }



    public function get_request_ajaxdata(Request $request)
    {

        $sql = DeviceRequest::select("device_requests.*","employees.firstname","employees.lastname","employees.image");
        $sql->join("employees","employees.user_id","=","device_requests.user_id");
        $sql->orderBy('id','DESC');
        $data = $sql->get();

        
        return DataTables::of($data)->addIndexColumn()

                ->addColumn('image', function ($data) {
                    if($data->image){
                        $imag = url('/public/'.$data->image);
                    }else{
                        $imag = url('public/assets/dist/img/avatar-1.jpg');
                    }
                    $image = '<img src="'.$imag.'" width="50">';
                    return $image;
                })
                
                ->addColumn('name', function ($data) {
                    return $data->firstname.' '.$data->lastname;
                })

                ->addColumn('device_id', function ($data) {
                    return $data->device_id;
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at;
                })
                ->addColumn('status', function($data){
                    if($data->status==0){
                        $status = '<a href="javascript:void(0)" class="btn btn-success btn-sm">Request</a> ';
                    }else{
                        $status = '<a href="javascript:void(0)" class="btn btn-success btn-sm">Active</a> ';
                    }
                    return $status;
                })

                ->addColumn('action', function($data){
                    $actionBtn = '<a href="javascript:void(0)" id="editAction" data-update-route="" data-edit-route="" class="btn btn-success btn-sm">Approve</a> '; 
                    $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="" class="btn btn-danger btn-sm">Reject</a>';
                    return $actionBtn;
                })

            ->rawColumns([ 'image', 'name','device_id','status','action'])
            ->make(true);

    }




    public function loginLogoutLog()
    {
        return view('user::__login_logout_log');
    }



    public function loginLogoutCount()
    {
        return view('user::__login_logout_count');
    }


    public function create()
    {
        return view('user::create');
    }


    public function store(Request $request)
    {
        
    }


    public function show($id)
    {
        return view('user::show');
    }


    public function edit($id)
    {
        return view('user::edit');
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
