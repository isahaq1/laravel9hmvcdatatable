<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Entities\Client;
use Modules\Location\Entities\Location;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\Region;
use Modules\Location\Entities\State;
use Modules\Outlet\Entities\Outlet;
use Modules\Outlet\Entities\OutletChannel;
use Modules\ClientProject\Entities\Project;
use Modules\Product\Entities\Brand;
use Modules\VisitProcess\Entities\VisitOrder;
use Modules\VisitProcess\Entities\VisitOrderDetail;
use Modules\VisitProcess\Entities\VisitFreshness;
use Carbon\Carbon;
use DB;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        ini_set('memory_limit', '3000M');
        ini_set('max_execution_time', '0');
        $totalQty = 0;
        $totalSaleQty = 0;
        $totalSaleAmount = 0;
        $totalPresaleQty = 0;
        $averageSaleQty = 0;
        $totalUser = 0;
        $avgSaleQtyByTotalSaler = 0;
        $avgSaleAmountByTotalSaler = 0;
        $totalCallageByVisits = 0;
        $totalVisitOrder = 0;
        $avgCallageByVisitsPerDay = 0;
        $readySalesStock = 0;
        $repeatedPurchase = 0;

        $max_date = VisitFreshness::max('created_at');
        $readySalesStock = VisitFreshness::groupBy('outlet_id')->where('created_at' , $max_date)->sum('product_qty');

        $orderDetails = VisitOrderDetail::with('product')->cursor();
        foreach($orderDetails as $details){
            if($details->product){
                $totalSaleQty += $this->totalSaleQty($details);
                $totalPresaleQty += $this->totalPreSaleQty($details);
            }
        }
        $totalSaleAmount = (  $totalSaleQty * $orderDetails->sum('price'));

        $orderIds = VisitOrder::where('order_date',Carbon::now()->format('Y-m-d'))->pluck('id')->toArray();
        $avgOrderDetails = VisitOrderDetail::with('product')->whereIn('order_id', $orderIds)->cursor();
        foreach($avgOrderDetails as $details){
            if($details->product){
                $averageSaleQty += (($details->case_qty * $details->product->unit_per_case) + $details->unit_qty);
            }
        }

        if($averageSaleQty > 0){
            $averageSaleQty = $averageSaleQty/ count($avgOrderDetails);
            $avgCallageByVisitsPerDay = $averageSaleQty / count($orderIds);
        }
        $totalUser = VisitOrder::select('user_id')->distinct()->get()->count();
        $totalVisitOrder = VisitOrder::cursor()->count();
        if($totalSaleQty > 0){
            $avgSaleQtyByTotalSaler =  $totalSaleQty / $totalUser;
            $totalCallageByVisits = $totalSaleQty / $totalVisitOrder;
        }
        if($totalSaleAmount > 0){
            $avgSaleAmountByTotalSaler = $totalSaleAmount / $totalUser;
        }
        $totalOutlets = VisitOrder::select('outlet_id')->distinct()->pluck('outlet_id')->toArray();
        for($i=0; $i < count($totalOutlets); $i++){
            $ordersId = VisitOrder::select('id')->where('outlet_id',$totalOutlets[$i])->pluck('id')->toArray();
            $orderDetails =  VisitOrderDetail::whereIn('order_id',$ordersId )
                                    ->selectRaw('product_id,count(*) as totalRepeat')
                                    ->groupBy('product_id')
                                    ->cursor();
            foreach($orderDetails as $details){
                if($details->totalRepeat > 1){
                    $repeatedPurchase += $details->totalRepeat;
                }
            }
        }

        return view('pages.blankpage',[
            'countries' => Country::orderBy('id','desc')->cursor(),
            'regions' => Region::orderBy('id','desc')->cursor(),
            'states' => State::orderBy('id','desc')->cursor(),
            'locations' => Location::orderBy('id','desc')->cursor(),
            'clients' => Client::orderBy('id','desc')->cursor(),
            'projects' => Project::orderBy('id','desc')->cursor(),
            'outletChannels' => OutletChannel::orderBy('id','desc')->cursor(),
            'outlets' => Outlet::orderBy('id','desc')->cursor(),
            'brands' => Brand::orderBy('id','desc')->cursor(),
            'totalSaleQty' => $totalSaleQty,
            'totalSaleAmount' => $totalSaleAmount,
            'totalPresaleQty' => $totalPresaleQty,
            'averageSaleQty' => $averageSaleQty,
            'avgSaleQtyByTotalSaler' => $avgSaleQtyByTotalSaler,
            'avgSaleAmountByTotalSaler' => $avgSaleAmountByTotalSaler,
            'totalCallageByVisits' => $totalCallageByVisits,
            'avgCallageByVisitsPerDay' => $avgCallageByVisitsPerDay,
            'readySalesStock' => $readySalesStock,
            'repeatedPurchase' =>  $repeatedPurchase
        ]);
    }

    public function filterSellsQty(Request $request){
          ini_set('memory_limit', '3000M');
          ini_set('max_execution_time', '0');
        if(@$request->reset){
            return redirect()->route('home');
        }else{
            $orders = VisitOrder::whereNotNull('id');
            $orderDetails = VisitOrderDetail::whereNotNull('id');
            $visitFreshness = $this->checkVisitfreshness($request);

            $totalSaleQty = 0;
            $totalSaleAmount = 0;
            $totalPresaleQty = 0;
            $countAllNull = 0;
            $countOrderNull = 0;
            $countDetailsNull=0;
            $averageSaleQty = 0;
            $totalUser = 0;
            $avgSaleQtyByTotalSaler = 0;
            $avgSaleAmountByTotalSaler = 0;
            $totalCallageByVisits = 0;
            $totalVisitOrder = 0;
            $avgCallageByVisitsPerDay = 0;
            $totalOrderDayWise = 0;
            $readySalesStock = 0;
            $repeatedPurchase = 0;

            if ($request->country_id != ''){
                $orders = $orders->where('country_id', $request->country_id);
            }
            if ($request->region_id != ''){
                $orders = $orders->where('region_id', $request->region_id);
            }
            if ($request->state_id != ''){
                $orders = $orders->where('state_id', $request->state_id);
            }
            if ($request->location_id != ''){
                $orders = $orders->where('location_id', $request->location_id);
            }
            if ($request->outlet_channel_id != ''){
                $orders = $orders->where('outlet_channel_id', $request->outlet_channel_id);
            }
            if ($request->outlet_id != ''){
                $orders = $orders->where('outlet_id', $request->outlet_id);
            }
            if($request->datefilter != ''){
                $dateRange = explode("-",$request->datefilter);
                $start_date = Carbon::parse($dateRange[0])->format('Y-m-d');
                $end_date = Carbon::parse($dateRange[1])->format('Y-m-d');
                $orders = $orders->whereBetween('order_date', [$start_date, $end_date]);
            }
            if ($request->client_id != ''){
                $orderDetails = $orderDetails->where('client_id', $request->client_id);
            }
            if ($request->brand_id != ''){
                $orderDetails = $orderDetails->where('brand_id', $request->brand_id);
            }
            if ($request->project_id != ''){
                $orderDetails = $orderDetails->where('project_id', $request->project_id);
            }

            $countAllNull = $this->countAllNull($request);
            $countOrderNull = $this->countOrderNull($request);
            $countDetailsNull = $this->countDetailsNull($request);

            if($countAllNull > 0){
                $readySalesStock = $this->getVisitfreshnessProductQtySum($visitFreshness);
                $orderDetails = $orderDetails->with('product')->cursor();
                foreach($orderDetails as $details){
                    if($details->product){
                        $totalSaleQty += $this->totalSaleQty($details);
                        $totalPresaleQty += $this->totalPreSaleQty($details);
                    }
                }
                $totalSaleAmount = ($totalSaleQty * $orderDetails->sum('price'));
                $averageSaleQty = $this->averageSaleQty($totalSaleQty , $orderDetails);
                $totalUser = $orders->select('user_id')->distinct()->get()->count();
                $totalVisitOrder = $orders->count();

                $orderIds = VisitOrder::where('order_date',Carbon::now()->format('Y-m-d'))->pluck('id')->toArray();
                $avgOrderDetails = VisitOrderDetail::with('product')->whereIn('order_id', $orderIds)->cursor();
                foreach($avgOrderDetails as $details){
                    if($details->product){
                        $averageSaleQty += (($details->case_qty * $details->product->unit_per_case) + $details->unit_qty);
                    }
                }
                if(count($orderIds) > 0){
                    $avgCallageByVisitsPerDay =  $averageSaleQty / count($orderIds);
                }
                if($totalSaleQty > 0){
                    $avgSaleQtyByTotalSaler =  $totalSaleQty / $totalUser;
                    $totalCallageByVisits = $totalSaleQty / $totalVisitOrder;
                }
                if($totalSaleAmount > 0){
                    $avgSaleAmountByTotalSaler = $totalSaleAmount / $totalUser;
                }
                $totalOutlets = $orders->select('outlet_id')->distinct()->pluck('outlet_id')->toArray();
                $repeatedPurchase = $this->getReapeatPurchase($totalOutlets);

            }elseif($countAllNull == 0 && $countDetailsNull > 0){
                $readySalesStock = $this->getVisitfreshnessProductQtySum($visitFreshness);
                $orderIds = $orders->with('orderDetails')->cursor()->pluck('id')->toArray();
                $orderDetails = $orderDetails->with('product')
                                             ->whereIn('order_id',  $orderIds)
                                             ->cursor();
                foreach($orderDetails as $details){
                    if($details->product){
                        $totalSaleQty += $this->totalSaleQty($details);
                        $totalPresaleQty += $this->totalPreSaleQty($details);
                    }
                }
                $totalSaleAmount = ( $totalSaleQty * $orderDetails->sum('price'));
                $averageSaleQty = $this->averageSaleQty($totalSaleQty , $orderDetails);
                $totalUser = $orders->select('user_id')->distinct()->get()->count();
                $totalVisitOrder = $orders->count();
                $totalOrderDayWise = $orders->select('order_date')->distinct()->get()->count();
                if($totalSaleQty > 0){
                    $avgSaleQtyByTotalSaler =  $totalSaleQty / $totalUser;
                    $totalCallageByVisits = $totalSaleQty / $totalVisitOrder;
                    $avgCallageByVisitsPerDay =  $totalSaleQty / $totalOrderDayWise;
                }
                if($totalSaleAmount > 0){
                    $avgSaleAmountByTotalSaler = $totalSaleAmount / $totalUser;
                }
                $totalOutlets = $orders->select('outlet_id')->distinct()->pluck('outlet_id')->toArray();
                $repeatedPurchase = $this->getReapeatPurchase($totalOutlets);
            }elseif($countAllNull == 0 && $countOrderNull > 0 && $countDetailsNull == 0){
                $readySalesStock = $this->getVisitfreshnessProductQtySum($visitFreshness);
                $orderDetailsUq1 = $orderDetails->with('product')->cursor();
                foreach($orderDetailsUq1 as $details){
                    if($details->product){
                        $totalSaleQty += $this->totalSaleQty($details);
                        $totalPresaleQty += $this->totalPreSaleQty($details);
                    }
                }
                $totalSaleAmount = ($totalSaleQty * $orderDetails->sum('price'));
                $averageSaleQty = $this->averageSaleQty($totalSaleQty , $orderDetailsUq1);
                $totalOrderIdByDays = $orderDetails->select('order_id')->distinct()->pluck('order_id')->toArray();
                $totalUser = $orders->select('user_id')->distinct()->get()->count();
                $totalVisitOrder = $orderDetails->select('order_id')->distinct()->get()->count();
                $totalOrderDayWise = $orders->whereIn('id',  $totalOrderIdByDays)->select('order_date')->distinct()->get()->count();
                if($totalSaleQty > 0){
                    $avgSaleQtyByTotalSaler =  $totalSaleQty / $totalUser;
                    $totalCallageByVisits = $totalSaleQty / $totalVisitOrder;
                    $avgCallageByVisitsPerDay =  $totalSaleQty /  $totalOrderDayWise;
                }
                if($totalSaleAmount > 0){
                    $avgSaleAmountByTotalSaler = $totalSaleAmount / $totalUser;
                }
                $totalOutlets =  VisitOrder::select('outlet_id')->whereIn('id', $totalOrderIdByDays)->distinct()->pluck('outlet_id')->toArray();
                $repeatedPurchase = $this->getReapeatPurchase($totalOutlets);
            }
            else{
                $allOrderId = [];
                $readySalesStock = $this->getVisitfreshnessProductQtySum($visitFreshness);
                $orderIds = $orders->with('orderDetails')->cursor()->pluck('id')->toArray();
                $orderDetails = $orderDetails->with('product')
                                             ->whereIn('order_id',   $orderIds)
                                             ->cursor();
                foreach($orderDetails as $details){
                    if($details->product){
                        $totalSaleQty += $this->totalSaleQty($details);
                        $totalPresaleQty += $this->totalPreSaleQty($details);
                    }
                    $allOrderId[] = $details->order_id;
                }
                $totalSaleAmount = ( $totalSaleQty * $orderDetails->sum('price'));
                $averageSaleQty = $this->averageSaleQty($totalSaleQty , $orderDetails);
                $totalUser = $orders->select('user_id')->distinct()->get()->count();

                $totalVisitOrder = $orders->count();
                $totalOrderDayWise = $orders->select('order_date')->distinct()->get()->count();

                if($totalSaleQty > 0){
                    $avgSaleQtyByTotalSaler =  $totalSaleQty / $totalUser;
                    $totalCallageByVisits = $totalSaleQty / $totalVisitOrder;
                    $avgCallageByVisitsPerDay =  $totalSaleQty / $totalOrderDayWise;
                }
                if($totalSaleAmount > 0){
                    $avgSaleAmountByTotalSaler = $totalSaleAmount / $totalUser;
                }
                $totalOutlets =  VisitOrder::select('outlet_id')->whereIn('id', array_unique($allOrderId))->distinct()->pluck('outlet_id')->toArray();
                $repeatedPurchase = $this->getReapeatPurchase($totalOutlets);
            }
            return view('pages.blankpage',[
                'countries' => Country::orderBy('id','desc')->cursor(),
                'regions' => Region::orderBy('id','desc')->cursor(),
                'states' => State::orderBy('id','desc')->cursor(),
                'locations' => Location::orderBy('id','desc')->cursor(),
                'clients' => Client::orderBy('id','desc')->cursor(),
                'projects' => Project::orderBy('id','desc')->cursor(),
                'outletChannels' => OutletChannel::orderBy('id','desc')->cursor(),
                'outlets' => Outlet::orderBy('id','desc')->cursor(),
                'brands' => Brand::orderBy('id','desc')->cursor(),
                'totalSaleQty' => $totalSaleQty,
                'request' => @$request->reset ? null : (object)$request->all(),
                'totalSaleAmount' =>  $totalSaleAmount,
                'totalPresaleQty' => $totalPresaleQty,
                'averageSaleQty' => $averageSaleQty,
                'avgSaleQtyByTotalSaler' => $avgSaleQtyByTotalSaler,
                'avgSaleAmountByTotalSaler' => $avgSaleAmountByTotalSaler,
                'totalCallageByVisits' => $totalCallageByVisits,
                'avgCallageByVisitsPerDay' => $avgCallageByVisitsPerDay,
                'readySalesStock' => $readySalesStock,
                'repeatedPurchase' =>  $repeatedPurchase
            ]);
        }

    }

    private function countAllNull($request){
        if($request->country_id == null
        && $request->region_id == null
        && $request->state_id == null
        && $request->location_id == null
        && $request->outlet_channel_id == null
        && $request->outlet_id == null
        && $request->datefilter == null
        && $request->client_id == null
        && $request->brand_id == null
        && $request->project_id == null
        ){
            return 1;
        }else{
           return 0;
        }
    }
    public function countOrderNull($request){
        if($request->country_id == null
            && $request->region_id == null
            && $request->state_id == null
            &&$request->location_id == null
            && $request->outlet_channel_id == null
            && $request->outlet_id == null
            && $request->datefilter == null
        ){
            return 1;
        }else{
            return 0;
        }
    }
    public function countDetailsNull($request){
        if($request->client_id == '' && $request->brand_id == '' && $request->project_id == ''){
           return 1;
        }else{
            return 0;
        }
    }

    private function averageSaleQty($totalSaleQty , $orderDetails){
        if($totalSaleQty > 0){
           return $totalSaleQty/ count($orderDetails);
        }else{
            return 0;
        }
    }

    private function totalSaleQty($details){
        $totalSaleQty = 0;
        return (($details->case_qty * $details->product->unit_per_case) + $details->unit_qty) ??  $totalSaleQty;
    }

    private function totalPreSaleQty($details){
        $totalPresaleQty = 0;
        return (($details->order_case_qty * $details->product->unit_per_case) + $details->order_unit_qty) ??  $totalPresaleQty;
    }

    private function checkVisitfreshness($request){
        $visitFreshness = VisitFreshness::whereNotNull('id');
        if ($request->country_id != ''){
            $visitFreshness = $visitFreshness->where('country_id', $request->country_id);
        }
        if ($request->region_id != ''){
            $visitFreshness = $visitFreshness->where('region_id', $request->region_id);
        }
        if ($request->state_id != ''){
            $visitFreshness = $visitFreshness->where('state_id', $request->state_id);
        }
        if ($request->location_id != ''){
            $visitFreshness = $visitFreshness->where('location_id', $request->location_id);
        }
        if ($request->outlet_channel_id != ''){
            $visitFreshness = $visitFreshness->where('outlet_channel_id', $request->outlet_channel_id);
        }
        if ($request->outlet_id != ''){
            $visitFreshness = $visitFreshness->where('outlet_id', $request->outlet_id);
        }
        if($request->datefilter != ''){
            $dateRange = explode("-",$request->datefilter);
            $start_date = Carbon::parse($dateRange[0])->format('Y-m-d');
            $end_date = Carbon::parse($dateRange[1])->format('Y-m-d');
            $visitFreshness = $visitFreshness->whereBetween('created_at', [$start_date, $end_date]);
        }
        if ($request->client_id != ''){
            $visitFreshness = $visitFreshness->where('client_id', $request->client_id);
        }
        if ($request->brand_id != ''){
            $visitFreshness = $visitFreshness->where('brand_id', $request->brand_id);
        }
        if ($request->project_id != ''){
            $visitFreshness = $visitFreshness->where('project_id', $request->project_id);
        }

        return $visitFreshness;

    }

    private function getVisitfreshnessProductQtySum($visitFreshness){
        $max_date = $visitFreshness->max('created_at');
        return VisitFreshness::groupBy('outlet_id')->where('created_at' , $max_date)->sum('product_qty') ?? 0;
    }

    private function getReapeatPurchase($totalOutlets){
        $repeatedPurchase = 0;
        for($i=0; $i < count($totalOutlets); $i++){
            $ordersId = VisitOrder::select('id')->where('outlet_id',$totalOutlets[$i])->pluck('id')->toArray();
            $orderRepeatDetails =  VisitOrderDetail::whereIn('order_id',$ordersId )
                                    ->selectRaw('product_id,count(*) as totalRepeat')
                                    ->groupBy('product_id')
                                    ->cursor();
            foreach($orderRepeatDetails as $details){
                if($details->totalRepeat > 1){
                    $repeatedPurchase += $details->totalRepeat;
                }
            }
        }
        return $repeatedPurchase;
    }




}
