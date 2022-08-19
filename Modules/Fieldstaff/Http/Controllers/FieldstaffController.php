<?php

namespace Modules\Fieldstaff\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Setting\Entities\Bank;
use Modules\Setting\Entities\Team;
use Modules\User\Entities\Employee;
use Illuminate\Support\Facades\Hash;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Region;
use Modules\Location\Entities\Country;
use Illuminate\Database\QueryException;
use Modules\Location\Entities\Location;
use Modules\Setting\Entities\Education;
use Modules\User\Entities\UserAccounts;
use Modules\User\Entities\UserGuarantor;
use Illuminate\Support\Facades\Validator;
use Modules\User\Entities\GuarantorTypeId;
use Illuminate\Contracts\Support\Renderable;

class FieldstaffController extends Controller
{
    
    public function index()
    {

        $users = User::where('user_type',3)->with('employee','guarantor','account')->get();



        $Country = Country::pluck('country_name','id');
        $Country->prepend('Please Select Country','');
        $State = State::pluck('state_name','id');
        $State->prepend('Please Select State','');
        $Team = Team::pluck('Team_name','id');
        $Team->prepend('Please Select Team','');
        $Bank = Bank::pluck('bank_name','id');
        $Bank->prepend('Please Select Bank','');

        $education = Education::get(['title','id']);
        $location = Location::get(['location_name','id']);

        $idtype = DB::table('guarantor_type_ids')->get();

        return view('fieldstaff::__fieldstaff_list',[
            'ptitle'=>'Fieldstaff List',
            'users' => $users,
            'country' => $Country,
            'state' => $State,
            'team'=>$Team,
            'bank'=>$Bank,
            'education'     => $education,
            'location'      => $location,
            'idtype'   =>$idtype
        ]);

    }


    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            $response = array(
                'success'  =>false,
                'message'  => $validator->errors()
            );
        }

        try {

            DB::transaction(function() use($request){


                $user = User::create([
                    'name' => $request->firstname.' '.@$request->middlename .' ' .@$request->lastname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'ip_address' => $request->ip(),
                    'user_type' => 3,
                    'status' =>$request->status
                ]);

                $emp['user_id'] = $user->id;
                if ($request->file('image')) {
                    $directory = '/uploads/user-images/';
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path().$directory, $filename);
                    $emp['image'] = $directory.$filename;
                }

                if ($request->file('guarantor_id')) {
                    $directory = '/uploads/user-images/';
                    $file = $request->file('guarantor_id');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path().$directory, $filename);
                    $guarantor['guarantor_id'] = $directory.$filename;
                }

                $emp['firstname']       = $request->firstname;
                $emp['lastname']        = $request->lastname;
                $emp['middlename']       = $request->middlename;
                $emp['gender']          = $request->gender;
                $emp['phone']           = $request->phone;
                $emp['address']         = $request->address;
                $emp['email']           = $request->email;
                $emp['country_id']      = $request->country_id;
                $emp['state_id']        = $request->state_id;
                $emp['lga']             = $request->lga;
                $emp['nin']             = $request->nin;
                $emp['bvn']             = $request->bvn;
                $emp['lassra']          = $request->lassra;
                $emp['education']       = $request->education;
                $emp['team_id']         = $request->team_id;
                
                
                $account['user_id']         = $user->id;
                $account['bank_id']         = $request->bank_id;
                $account['account_name']    = $request->account_name;
                $account['account_number']  = $request->account_number;

                $guarantor['user_id']           = $user->id;
                $guarantor['guarantor_name']    = $request->guarantor_name;
                $guarantor['guarantor_email']   = $request->guarantor_email;
                $guarantor['guarantor_phone']   = $request->guarantor_phone;
                $guarantor['guarantor_id_type'] = $request->guarantor_id_type;

                Employee::create($emp);
                UserAccounts::create($account);
                UserGuarantor::create($guarantor);
                    

            });

            $response = array(
                'success'  =>true,
                'message'  => 'Added successfully'
            );

            return json_encode($response);

        }catch (QueryException $e) {
            return sendErrorResponse('','Something Went Wrong!! Your transaction is Rolled Back',500);
        }
       
        

    }


    public function show($id)
    {
        $modules = Employee::get();
        $role    = Employee::search($id);
        return view('role::edit',[
            'modules' => $modules,
            'role' =>   $role
        ]);
    }


    public function edit($id)
    {

        $user = User::findOrFail($id);

        $response = array(
            'success'   =>  true,
            'user'      =>  $user,
            'employee'  => ($user->employee?$user->employee:''),
            'account'   =>  ($user->account?$user->account:''),
            'guarantor' =>  ($user->guarantor?$user->guarantor:''),
        );

        return json_encode($response);
        
    }

    public function update(Request $request, $id)
    { 

        try {

            DB::transaction(function() use($request,$id){

                if ($request->file('image')) {
                    $directory = '/uploads/user-images/';
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path().$directory, $filename);
                    $emp['image'] = $directory.$filename;
                }

                if ($request->file('guarantor_id')) {
                    $directory = '/uploads/user-images/';
                    $file = $request->file('guarantor_id');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path().$directory, $filename);
                    $guarantor['guarantor_id'] = $directory.$filename;
                }

                $emp['firstname']       = $request->firstname;
                $emp['lastname']        = $request->lastname;
                $emp['middlename']       = $request->middlename;
                $emp['gender']          = $request->gender;
                $emp['phone']           = $request->phone;
                $emp['address']         = $request->address;
                $emp['email']           = $request->email;
                $emp['country_id']      = $request->country_id;
                $emp['state_id']        = $request->state_id;
                $emp['lga']             = $request->lga;
                $emp['nin']             = $request->nin;
                $emp['bvn']             = $request->bvn;
                $emp['lassra']          = $request->lassra;
                $emp['education']       = $request->education;
                $emp['team_id']         = $request->team_id;
                
                $account['bank_id']         = $request->bank_id;
                $account['account_name']    = $request->account_name;
                $account['account_number']  = $request->account_number;

                $guarantor['guarantor_name']    = $request->guarantor_name;
                $guarantor['guarantor_email']   = $request->guarantor_email;
                $guarantor['guarantor_phone']   = $request->guarantor_phone;
                $guarantor['guarantor_id_type'] = $request->guarantor_id_type;


                Employee::where('user_id',$id)->update($emp);
                UserAccounts::where('user_id',$id)->update($account);
                UserGuarantor::where('user_id',$id)->update($guarantor);
            
                User::where('id',$id)->update([
                    'name' => $request->firstname.' '.@$request->middlename .' ' .@$request->lastname,
                    'email'     => $request->email,
                    'password'  => Hash::make($request->password),
                    'status'    =>@$request->status
                ]);

            });

            $response = array(
                'success'  =>true,
                'message'  => 'update successfully'
            );
            return json_encode($response);
            
        }catch (QueryException $e) {

            //return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
            return sendErrorResponse('','Something Went Wrong!! Your transaction is Rolled Back',500);
        }
    }

 
    public function destroy($id)
    {
        User::whereIn(['id' , $id,'user_type',3])->delete();
        Employee::where('user_id' , $id)->delete();
        UserAccounts::where('user_id' , $id)->delete();
        UserGuarantor::where('user_id' , $id)->delete();

        $response = array(
            'success'  =>true,
            'message'  => 'Data Deleted Successfully'
        );
        return json_encode($response);

    }


    public function profile()
    {
        $id = Auth::User()->id;
        $users = User::findOrFail($id);
        $users = Employee::findOrFail($id);
        return view('user::__user_profile',[
            'ptitle'=>'User Profile',
        ]);
    }


    public function changeUserStatus($id){

        if($user = User::where(['id'=>$id,'user_type'=>3])->first()){

            if($user->status=='0'){
                $status['status'] = 1;
            }elseif( $user->status=='1'){
                $status['status']=0;
            }else{
                $status['status'] = 2;
            }

            User::where('id',$id)->update($status);
            $response = array(
                'success'  =>true,
                'message'  => 'Change Successfully'
            );

        }else{
            $response = array(
                'success'  =>false,
                'message'  => 'Not Change Eat'
            );
        }

        return json_encode($response);

    }


    public function get_fieldstaff(Request $request){
        

        $client_id = $request->client_id;

        if ($request->ajax()) {

            $data = User::where('user_type',3)->with('employee','guarantor','account')->get();

            //return $data;


            return DataTables::of($data)->addIndexColumn()

                ->addColumn('image', function ($data) {
                    if(@$data->employee->image){
                        $imag = url('/public/'.$data->employee->image);
                    }else{
                        $imag = url('public/assets/dist/img/avatar-1.jpg');
                    }
                    $image = '<img src="'.$imag.'" width="50">';
                    return $image;
                })

                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('email', function ($data) {
                    return $data->email;
                })

                ->addColumn('phone', function ($data) {
                    return @$data->employee->phone;
                })

                ->addColumn('address', function ($data) {
                    return @$data->employee->address;
                })

               
                ->addColumn('status', function ($data) {

                    if(@$data->status==2){
                        $status = '<span class="badge bg-warning text-dark">Profile Not Updated</span>';
                    }elseif($data->status==0){
                        $status = '<span class="badge bg-danger">Not Active</span>';
                    }else{
                        $status = '<span class="badge bg-success">Active</span>';
                    }
                    return $status;
                })

                ->addColumn('changesatatus', function ($data) {

                    if($data->status==0){
                        $changestatus = '<button type="button" id="statusChange"  data-status-route="'.route('changeUserStatus',$data->id).'" class="btn btn-labeled btn-success mb-2 me-1">
                        <span class="btn-label"><i class="fas fa-check"></i></span>Active
                    </button>';
                    }elseif($data->status==1){
                        $changestatus = '<button type="button" id="statusChange" data-status-route="'.route('changeUserStatus',$data->id).'" class="btn btn-labeled btn-danger mb-2 me-1">
                        <span class="btn-label"><i class="fas fa-times"></i></span>InActive
                    </button>';
                    }else{
                        $changestatus = '<button type="button"  class="btn btn-labeled btn-warning mb-2 me-1">
                            <span class="btn-label"><i class="far fa-bookmark"></i></span>Profile Not Updated
                        </button>';
                    }
                    return $changestatus;
                })

                ->addColumn('action', function($data){

                    $actionBtn = $actionBtn = '<a href="javascript:void(0)" id="editAction" data-update-route="'.route('fieldstaff.update',$data->id).'" data-edit-route="'.route('fieldstaff.edit',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> '; 
                    $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('fieldstaff.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    return $actionBtn;
                })

            ->rawColumns(['image', 'name', 'email','phone','address', 'status','changesatatus','action'])
            ->make(true);
        }

    }




}
