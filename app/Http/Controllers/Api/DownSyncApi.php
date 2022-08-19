<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Api\DownSyncModel;

use App\Http\Controllers\Controller;

class DownSyncApi extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = @auth('jwt_auth')->user()->id;
    }

    public function DownSyncData(){

        //return DownSyncModel::location($this->user);
        //return DownSyncModel::dashboard($this->user);
        //return DownSyncModel::products($this->user);
        //return DownSyncModel::brifs($this->user);
        //return DownSyncModel::outlets($this->user);
        //return DownSyncModel::outlet_types();
        //return DownSyncModel::outlet_channels();
        //return DownSyncModel::schedules($this->user);
        //return DownSyncModel::posms_product_list($this->user);
        //return DownSyncModel::brand_list();


        try {

            $data=[
                'dashboard'             => DownSyncModel::dashboard($this->user),
                'route_plane'           => DownSyncModel::route_plane($this->user),
                'location'              => DownSyncModel::location($this->user),
                'brand_list'            => DownSyncModel::brand_list(),
                'products'              => DownSyncModel::products($this->user),
                'brifs'                 => DownSyncModel::brifs($this->user),
                'outlets'               => DownSyncModel::outlets($this->user),
                'outlet_types'          => DownSyncModel::outlet_types(),
                'outlet_channels'       => DownSyncModel::outlet_channels(),
                'schedules'             => DownSyncModel::schedules($this->user),
                'posms_product_list'    => DownSyncModel::posms_product_list($this->user),
            ];
            return sendSuccessResponse('Data Retrive Successfull !', $data, 200);

        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }

    }

}
