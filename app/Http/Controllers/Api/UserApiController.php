<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Employee;
use App\Http\Controllers\Controller;
use Doctrine\DBAL\Query\QueryException;
use Modules\User\Entities\UserAccounts;
use Modules\User\Entities\UserGuarantor;

class UserApiController extends Controller
{

    public function updateProfile(Request $request)
    {

        $id = auth('jwt_auth')->user()->id;
    
        try {

            DB::transaction(function() use($request,$id){ 
                
                $user = User::where('user_type',3)->findOrFail($id);

                if($user){


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
                    $emp['email']           = $user->email;
                    $emp['country_id']      = $request->country_id;
                    $emp['state_id']        = $request->state_id;
                    $emp['lga']             = $request->lga;
                    $emp['nin']             = $request->nin;
                    $emp['bvn']             = $request->bvn;
                    $emp['lassra']          = $request->lassra;
                    $emp['education']       = $request->education;
        
                    $account['bank_id']         = $request->bank_id;
                    $account['account_name']    = $request->account_name;
                    $account['account_number']  = $request->account_number;
        
                    $guarantor['user_id'] = $id;
                    $guarantor['guarantor_name'] = $request->guarantor_name;
                    $guarantor['guarantor_email']    = $request->guarantor_email;
                    $guarantor['guarantor_phone']    = $request->guarantor_phone;
                    $guarantor['guarantor_id_type'] = $request->guarantor_id_type;


                    User::where('id',$id)->update([
                        'name'      => $request->firstname.' '.@$request->middlename .' ' .@$request->lastname,
                        'status'    => 0
                    ]);

                    //basic info update and create
                    if($user->employee !=''){
                        Employee::where('user_id',$id)->update($emp);
                    }else{
                        $emp['user_id'] = $id;
                        Employee::create($emp);
                    }

                    //account update and create
                    if($user->account !=''){
                        UserAccounts::where('user_id',$id)->update($account);
                    }else{
                        $account['user_id'] = $id;
                        UserAccounts::create($account);
                    }
                   
                    //guarantor update and create
                    if($user->guarantor !=''){
                        UserGuarantor::where('user_id',$id)->update($guarantor);
                    }else{
                        $guarantor['user_id'] = $id;
                        UserGuarantor::create($guarantor);
                    }


                }else{
                    return sendErrorResponse('','Something Went Wrong!',500);
                }

            });

           $info = '';
            return sendSuccessResponse('Updated successfully !',$info=null,200);

                  
        }catch (QueryException $e) {

            //return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
            return sendErrorResponse('','Something Went Wrong!! Your transaction is Rolled Back',500);
        }
    }
    
}
