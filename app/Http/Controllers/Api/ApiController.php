<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Setting\Entities\Bank;
use App\Http\Controllers\Controller;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use Illuminate\Database\QueryException;
use Modules\Location\Entities\Location;
use Modules\Setting\Entities\Education;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getCountryList(){

        try {
            $country = Country::get(['id','country_name']);
            return sendSuccessResponse('Data Retrive Successfull !', $country, 200);
        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }

    }

    public function getStateList(Request $request){

        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            return sendErrorResponse('Client Site Error!', $validator->errors(), 400);
        }

        try {
            $states = State::where('country_id',$request->country_id)->get(['id','state_name']);
            return sendSuccessResponse('Data Retrive Successfull !', $states, 200);
        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }

    }

    public function getLgaList(Request $request){

        $validator = Validator::make($request->all(),[
            'state_id' => 'required',
        ]);

        if ($validator->fails()) {
            return sendErrorResponse('Client Site Error!', $validator->errors(), 400);
        }

        try {
            $states = Location::where('state_id',$request->state_id)->get(['id','location_name']);
            return sendSuccessResponse('Data Retrive Successfull !', $states, 200);
        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }

    }


    public function getBankList(){

        try {
            $banks = Bank::get(['id','bank_name']);
            return sendSuccessResponse('Data Retrive Successfull !', $banks, 200);
        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }

    }


    public function getEducationList(){

        try {
            $education = Education::get(['id','title']);
            return sendSuccessResponse('Data Retrive Successfull !', $education, 200);
        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }

    }

    public function getGuarantor(){

        // {
        //     "id": 1,
        //     "name": "NID"
        // },

        try {
            $ones = DB::table('guarantor_type_ids')->get();
            return sendSuccessResponse('Data Retrive Successfull !', $ones, 200);
        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }

    }


}
