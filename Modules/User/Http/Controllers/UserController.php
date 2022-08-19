<?php
namespace Modules\User\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Bank;

use Modules\Setting\Entities\Team;
use Modules\User\Entities\Employee;
use Illuminate\Support\Facades\Hash;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\Location;
use Modules\Setting\Entities\Education;
use Modules\User\Entities\UserAccounts;
use Modules\User\Entities\UserGuarantor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\EmployeeRequest;

class UserController extends Controller
{

    public function index()
    {

        $users = User::where('user_type',2)->get();

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
        


        return view('user::__user_list',[
            'ptitle'        => 'User List',
            'users'         => $users,
            'country'       => $Country,
            'state'         => $State,
            'team'          => $Team,
            'bank'          => $Bank,
            'education'     => $education,
            'location'      => $location
        ]);


    }


    public function create()
    {
        return view('user::create');
    }


    public function store(EmployeeRequest $request)
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

        $user = User::create([
            'name' => $request->first.' '.@$request->midelname .' ' .@$request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type'=>2,
            'status' =>$request->status
        ]);

        if($user){

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
            $emp['midelname']       = $request->midelname;
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
            
            
            Employee::create($emp);

            $response = array(
                'success'  =>true,
                'message'  => 'Added successfully'
            );


        }else{
            $response = array(
                'success'  =>false,
                'message'  => 'internal Error'
            );
        }
       
        return json_encode($response);

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
            'success'       => true,
            'user'          => $user,
            'employee'      => ($user->employee?$user->employee:'')
        );
        return json_encode($response);

        
    }


    public function update(EmployeeRequest $request, $id)
    { 

        // $validator = Validator::make($request->all(), [
        //     'firstname' => 'required|string|between:2,100',
        //     'email' => 'required|string|email|max:100|unique:users',
        //     'password' => 'required|string|min:6',
        // ]);

        // if ($validator->fails()) {
        //     $response = array(
        //         'success'  =>false,
        //         'message'  => $validator->errors()
        //     );

        //     return json_encode($response);
        // }


        if ($request->file('image')) {
            $directory = '/uploads/user-images/';
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $emp['image'] = $directory.$filename;
        }else{
            $emp['image'] = $request->image_image;
        }

        if ($request->file('guarantor_id')) {
            $directory = '/uploads/user-images/';
            $file = $request->file('guarantor_id');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $guarantor['guarantor_id'] = $directory.$filename;
        }else{
            $emp['guarantor_id'] = $request->image_image;
        }

        User::where('id',$id)->update([
            'name'      => $request->first.' '.@$request->midelname.' '.$request->lastname,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'status'    =>@$request->status
        ]);


        $emp['firstname']       = $request->firstname;
        $emp['lastname']        = $request->lastname;
        $emp['midelname']       = $request->midelname;
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
        

        Employee::where('user_id',$id)->update($emp);
        
        $response = array(
            'success'  =>true,
            'message'  => 'update successfully'
        );
        return json_encode($response);
    }


    public function destroy($id)
    {
        Employee::where('id' , $id)->delete();
        return response()->json(['success' => 'Data Deleted Successfully']);
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


}
