<?php

namespace Modules\Client\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use  Modules\Client\Entities\Client;

use Illuminate\Support\Facades\Hash;

use Modules\Product\Entities\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;


class ClientController extends Controller
{


    public function index()
    {
        $Clients = Client::withoutGlobalScopes([Asc::class])->get();
        return view('client::__client_list',['ptitle'=>'Client List','clients'=>$Clients]);
    }


    public function create()
    {
        return view('client::create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|between:2,100',
            'client_email' => 'required',
            'password' => 'required',
            'client_address' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                'success'  =>false,
                'message'  => $validator->errors()
            );
            return json_encode($response);
        }

        if ($request->file('client_logo')) {
            $directory = '/uploads/client-images/';
            $file = $request->file('client_logo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $data['client_logo'] = $directory.$filename;
        }

        $data['client_name'] = $request->client_name;
        $data['client_address'] = $request->client_address;
        $data['client_phone'] = $request->client_phone;
        $data['client_email'] = $request->client_email;


        $password = $request->password;

        $result = User::create([
            'name'      => $data['client_name'],
            'email'     => $data['client_email'],
            'password'  => Hash::make($password),
            'user_type' => 4,
            'status'    => $request->status
        ]);

        $data['user_id'] = $result->id;
        //return $data;
        Client::create($data);
        $response = array(
            'success'  =>true,
            'message'  => 'Added successfully'
        );

        return json_encode($response);
    }


    public function show($id)
    {
        return view('client::show');
    }


    public function edit($id)
    {
        $data = Client::find($id);
        return response()->json(['data'=>$data]);
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|between:2,100',
            'client_email' => 'required',
            'password' => 'required',
            'client_address' => 'required'
        ]);

        if ($validator->fails()) {
            
            $response = array(
                'success'  =>false,
                'message'  => $validator->errors()
            );
            return json_encode($response);
        }


        if ($request->file('client_logo')) {
            
            $directory = '/uploads/client-images/';
            $file = $request->file('client_logo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $data['client_logo'] = $directory.$filename;
        }

        $data['client_name']    = $request->client_name;
        $data['client_address'] = $request->client_address;
        $data['client_phone']   = $request->client_phone;
        $data['client_email']   = $request->client_email;


        //return $data;
        Client::where('id',$request->id)->update($data);
        $response = array(
            'success'  =>true,
            'message'  => 'Update successfully'
        );

        return json_encode($response);
    }


    public function destroy($id)
    {

        if(Product::where('client_id',$id)->first()){
            $response = array(
                'success'  =>false,
                'title'=>'Client',
                'message'  => 'Your can not delete Client, Alredy exist in product'
            );
            return json_encode($response);
        }else{

            $OutletChannel = Client::findOrFail($id);
            $OutletChannel->delete();

            $response = array(
                'success'  =>true,
                'title'=>'Client',
                'message'  => 'Delete successfully'
            );
            return json_encode($response);
            
        }
        
        
    }


}
