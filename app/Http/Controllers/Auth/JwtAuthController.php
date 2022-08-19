<?php
namespace App\Http\Controllers\Auth;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\User\Entities\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Modules\User\Entities\UserAccounts;

use Modules\User\Entities\UserLoginLog;
use Modules\User\Entities\UserGuarantor;
use Modules\User\Entities\UserLogoutLog;
use Illuminate\Support\Facades\Validator;

class JwtAuthController extends Controller
{

    public function login(Request $request)
    {

        $credentials = request(['email', 'password', 'device_id']);
        $data='';
        if (!$token = auth()->guard('jwt_auth')->attempt($credentials)) {
            return sendErrorResponse('Check Your Email Or Password',$data=null,401);
        }
        $status = auth('jwt_auth')->user()->status;

        if(auth('jwt_auth')->user()->status==0){
            return sendErrorResponse('Your are not active user',$data=null,401);
        }

        if(auth('jwt_auth')->user()->status==1){

            $count['login_count'] = auth('jwt_auth')->user()->login_count+1;
            User::where('id',auth('jwt_auth')->user()->id)->update($count);

            $loginlog['user_id']    = auth('jwt_auth')->user()->id;
            $loginlog['ip_address'] = $request->ip_address;
            $loginlog['type']       = 1;
            $loginlog['login_address'] = $request->login_address;
            UserLoginLog::create($loginlog);

        }

        return $this->respondWithToken($token,$status);

    }


    public function me()
    {

        $id = auth('jwt_auth')->user()->id;

        try {

            $user  = User::find($id);
            $user1 = User::find($id);

            $details = $user->employee;
            $account = $user->account;
            $guarantor = $user->guarantor;

            $info['reg_info']   = $user1;
            $info['details']    = $details;
            $info['account']    = $account;
            $info['guarantor']   = $guarantor;

            return sendSuccessResponse('Data Retrive Successfull !',$info,200);

        } catch(QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }
        //return response()->json(auth('jwt_auth')->user());
    }


    public function logout(Request $request)
    {

        if(auth('jwt_auth')->user()->id){
            $locoutlog['user_id']           = auth('jwt_auth')->user()->id;
            $locoutlog['ip_address']        = $request->ip_address;
            $locoutlog['logout_address']    = $request->logout_address;
            UserLogoutLog::create($locoutlog);
            auth('jwt_auth')->logout();
        }
        return response()->json(['message' => 'Successfully logged out']);

    }


    public function refresh()
    {
        $data =[
            'access_token'  => auth('jwt_auth')->refresh(),
            'token_type'    => 'bearer',
            'expires_in'    => auth()->guard('jwt_auth')
        ];
        return sendSuccessResponse('Refresh Token Successfull!',$data,200);
    }


    protected function respondWithToken($token,$status=null)
    {
        $data =[
            'user_status'   => @$status,
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth()->guard('jwt_auth')
        ];
        return sendSuccessResponse('Login Successfull!',$data,200);
    }


    public function register(Request $request)
    {

        //return $request->all();
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|between:2,100',
            'email'     => 'required|string|email|max:100|unique:users',
            'password'  => 'required|string|min:6',
            'device_id' =>'required',
            'ip_address'=>'required'
        ]);

        if ($validator->fails()) {
            return sendErrorResponse('Client Site Error!', $validator->errors(), 400);
        }

        try {

            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'device_id' => $request->device_id,
                'ip_address' => $request->ip_address,
                'user_type' => 3,
                'status'    => 2
            ]);
            
            return sendSuccessResponse('Registration Successfull !',$user,200);

        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }
       
    }

}
