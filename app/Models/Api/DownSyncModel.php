<?php

namespace App\Models\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DownSyncModel extends Model
{

    use HasFactory;

    public static function dashboard($user){

        $visitdata = DownSyncModel::countvisit($user);
        $products = DownSyncModel::countproducts($user);
        $outlets = DownSyncModel::countoutlet($user);

        $result = (object) array(
            "total_schedule" => $visitdata->total,
            "sales_visit" => $visitdata->sales_visit,
            "merchandise_visit" => $visitdata->merchandise_visit,
            "panding_visit" => $visitdata->panding_visit,
            "visited" => $visitdata->visited,
            "products" => $products->total_product,
            "outlets" => $outlets->total_outlet,
        );
        
        return $result;

    }

    public static function countvisit($user){
        $visitdata = DB::table('visit_schedules')->selectRaw('count(*) as total')->selectRaw("count(case when visit_type = '1' then 1 end) as sales_visit")
        ->selectRaw("count(case when visit_type = '2' then 1 end) as merchandise_visit")->selectRaw("count(case when visit_status = '0' then 1 end) as panding_visit")
        ->selectRaw("count(case when visit_status = '1' then 1 end) as visited")->where('user_id',$user)->first();
        return $visitdata;
    } 


    public static function countproducts($user){
        $product = DB::table('product_assigns')->selectRaw('count(*) as total_product')->where('user_id',$user)->first();
        return $product;
    } 


    public static function countoutlet($user){

        $routeplane = DB::table('route_plans')->select('day_of_week','id')->where('user_id',$user)->get();
        $routeplanid = [];
        foreach ($routeplane as $key => $value) {
            $routeplanid[] = $value->id;
        }
        $locations = DB::table('route_plan_details')->whereIn('route_plane_id',$routeplanid)->groupBy('location_id')->get();
        $locationid = [];
        foreach ($locations as $key => $value) {
            $locationid[] = $value->location_id;
        }
        $outlets = DB::table('outlets')->selectRaw('count(*) as total_outlet')->whereIn('location_id',$locationid)->first();
        return $outlets;

    } 


    public static function route_plane($user){

        $routeplane = DB::table('route_plans')->select('day_of_week','id')->where('user_id',$user)->get();

        $route_plane_id = [];
        $response = [];
        foreach ($routeplane as $key => $route) {
            $response[$key]['day_of_week'] = $route->day_of_week;
            $response[$key]['id'] = $route->id;
            $route_plane_id[]=$route->id;
           
        }
        return $response;

    }



    public static function location($user){

        $routeplane = DB::table('route_plans')->select('id')->where('user_id',$user)->get();

        $response=[];

        if(!empty($routeplane)){

            $route_plane_id = [];
            foreach ($routeplane as $route) {
                $route_plane_id[]=$route->id;
            }

            $locations = DB::table('route_plan_details')
                ->join('locations','route_plan_details.location_id','=','locations.id')
                ->select('route_plan_details.*',
                'locations.location_name',
                'locations.country_id',
                'locations.state_id',
                'locations.region_id',
                'locations.gio_lat',
                'locations.gio_long'
                )
                ->whereIn('route_plane_id',$route_plane_id)
                ->get();

                if(!empty($locations)){

                    foreach ($locations as $key => $item) {
                        $response[$key]['id']             = $item->id;
                        $response[$key]['route_plane_id'] = $item->route_plane_id;
                        $response[$key]['country_id']    = $item->country_id;
                        $response[$key]['state_id']    = $item->state_id;
                        $response[$key]['region_id']    = $item->region_id;
                        $response[$key]['location_id']    = $item->location_id;
                        $response[$key]['location_name']  = $item->location_name;
                        $response[$key]['gio_lat']    = $item->gio_lat;
                        $response[$key]['gio_long']    = $item->gio_long;
                    }

                }

            return $response;

        }
            
        return $response;
        
        
    }


    public static function brifs($user){
        $brifs = DB::table('brifs')->get();
        $breaf = [];
        foreach ($brifs as $key => $item) {
            $breaf[$key]['id'] = $item->id;
            $breaf[$key]['title'] = @$item->title;
            $breaf[$key]['description'] = @$item->description;
            $breaf[$key]['file'] = ($item->file?url('public'.$item->file):null);
        }
        return $breaf;
    }


    public static function products($user){

        $product = DB::table('product_assigns')
        ->join('products','product_assigns.product_id','=','products.id')
        ->join('clients','product_assigns.client_id','=','clients.id')
        ->select(
            'product_assigns.id',
            'product_assigns.case_target_qty',
            'product_assigns.unit_target_qty',
            'product_assigns.product_id',
            'product_assigns.client_id',
            'product_assigns.user_id',
            'products.*',
            'clients.client_name')
        ->where('product_assigns.user_id',$user)
        ->where('products.p_type',1)->get();

        $products = [];
        foreach ($product as $key => $item) {

            $products[$key]['id'] = $item->id;
            $products[$key]['product_name'] = $item->product_name;
            $products[$key]['brand_id'] = $item->brand_id;
            $products[$key]['category_id'] = $item->category_id;
            $products[$key]['product_image'] = ($item->product_image?url('public'.$item->product_image):'');
            $products[$key]['unit_per_case'] = $item->unit_per_case;
            $products[$key]['unit_price'] = $item->unit_price;
            $products[$key]['sales_price'] = $item->sales_price;
            $products[$key]['rec_retail_price'] = $item->rec_retail_price;

            $products[$key]['client_id'] = $item->client_id;
            $products[$key]['client_name'] = $item->client_name;
        }

        return $products;

    }

    public static function posms_product_list($user){

        $product = DB::table('product_assigns')
        ->join('products','product_assigns.product_id','=','products.id')
        ->join('clients','product_assigns.client_id','=','clients.id')
        ->select(
            'product_assigns.client_id',
            'product_assigns.user_id',
            'products.*',
            'clients.client_name')
        ->where('product_assigns.user_id',$user)->where('products.p_type',2)->get();

        $products = [];
        foreach ($product as $key => $item) {

            $products[$key]['id'] = $item->id;
            $products[$key]['product_name'] = @$item->product_name;
            $products[$key]['brand_id'] = @$item->brand_id;
            $products[$key]['category_id'] = @$item->category_id;
            $products[$key]['product_weight'] = @$item->product_weight;
            
            $products[$key]['product_image'] = ($item->product_image?url('public'.$item->product_image):null);
            $products[$key]['client_id'] = $item->client_id;
            $products[$key]['client_name'] = $item->client_name;
        }

        return $products;

    }




    public static function outlets($user){


        $routeplane = DB::table('route_plans')->select('day_of_week','id')->where('user_id',$user)->get();
        $routeplanid = [];
        foreach ($routeplane as $key => $value) {
            $routeplanid[] = $value->id;
        }


        $locations = DB::table('route_plan_details')->whereIn('route_plane_id',$routeplanid)->groupBy('location_id')->get();
        $locationid = [];
        foreach ($locations as $key => $value) {
            $locationid[] = $value->location_id;
        }

        
        $sql = DB::table('outlets')->select("outlets.*","outlet_types.type_name","outlet_channels.channel_name");
        $sql->join("outlet_types","outlet_types.id","=","outlets.type_id");
        $sql->join("outlet_channels","outlet_channels.id","=","outlets.channel_id");
        $sql->whereIn('location_id',$locationid);
        $outlet = $sql->get();

        $outlets = [];
        foreach ($outlet as $key => $item) {

            $outlets[$key]['outlet_id'] = $item->outlet_id;
            $outlets[$key]['outlet_name'] = $item->outlet_name;
            $outlets[$key]['type_id'] = $item->type_id;
            $outlets[$key]['channel_id'] = $item->channel_id;
            $outlets[$key]['outlet_image'] = ($item->outlet_image?url('public'.$item->outlet_image):'');
            $outlets[$key]['outlet_address'] = $item->outlet_address;
            $outlets[$key]['outlet_phone'] = $item->outlet_phone;
            $outlets[$key]['country_id']    = $item->country_id;
            $outlets[$key]['state_id']    = $item->state_id;
            $outlets[$key]['region_id']    = $item->region_id;
            $outlets[$key]['location_id']    = $item->location_id;
            $outlets[$key]['gio_lat'] = $item->gio_lat;
            $outlets[$key]['gio_long'] = $item->gio_long;
            $outlets[$key]['is_bso'] = $item->is_bso;
        }

        return $outlets;

    }

    
    public static function brand_list(){
        $result = DB::table('brands')->select("brand_name","id")->get();
        return $result;
    }

    public static function outlet_types(){
        $result = DB::table('outlet_types')->select("type_name","id")->get();
        return $result;
    }

    public static function outlet_channels(){
        $result = DB::table('outlet_channels')->select("channel_name","id")->get();
        return $result;
    }


    public static function schedules($user){

        $sql = DB::table('visit_schedules')->select(
            "visit_schedules.*",
            "users.name",
            'outlets.outlet_name',
            'outlets.outlet_image',
            'outlets.outlet_address',
            'locations.location_name',
            'visited_types.*',

        );
        $sql->join("users","users.id","=","visit_schedules.user_id");
        $sql->join("outlets","outlets.outlet_id","=","visit_schedules.outlet_id");
        $sql->join("locations","locations.id","=","visit_schedules.location_id");
        $sql->join("visited_types","visited_types.schedule_id","=","visit_schedules.schedule_id");
        $sql->where('user_id',$user);
        $data = $sql->get();

        $schedule = [];
        foreach ($data as $key => $item) {

            $schedule[$key]['schedule_id'] = $item->schedule_id;
            $schedule[$key]['outlet_id'] = $item->outlet_id;
            $schedule[$key]['outlet_name'] = $item->outlet_name;
            // $schedule[$key]['outlet_image'] = ($item->outlet_image?url('public'.$item->outlet_image):'');
            $schedule[$key]['outlet_address'] = $item->outlet_address;
            $schedule[$key]['location_name'] = $item->location_name;
            $schedule[$key]['client_id'] = $item->client_id;
            $schedule[$key]['schedule_date'] = $item->schedule_date;
            $schedule[$key]['schedule_time'] = $item->schedule_time;
            $schedule[$key]['start_time'] = $item->start_time;
            $schedule[$key]['end_time'] = $item->end_time;
            $schedule[$key]['is_exception'] = $item->is_exception;
            $schedule[$key]['created_at'] = $item->created_at;
            $schedule[$key]['updated_at'] = $item->updated_at;
            $schedule[$key]['gio_lat'] = $item->gio_lat;
            $schedule[$key]['gio_long'] = $item->gio_long;
            $schedule[$key]['visit_type'] = $item->visit_type;
            $schedule[$key]['visit_status'] = $item->visit_status;

            $schedule[$key]['outlet_visit'] = $item->outlet_visit;
            $schedule[$key]['merchandising_visit'] = $item->merchandising_visit;
            $schedule[$key]['posm_visit'] = $item->posm_visit;
            $schedule[$key]['competition_visit'] = $item->competition_visit;
            $schedule[$key]['freshness_visit'] = $item->freshness_visit;
            $schedule[$key]['oos_visit'] = $item->oos_visit;
            $schedule[$key]['planogram_visit'] = $item->planogram_visit;
            $schedule[$key]['pricing_visit'] = $item->pricing_visit;
            $schedule[$key]['ordering_visit'] = $item->ordering_visit;


        }

        return $schedule;
    }







}
