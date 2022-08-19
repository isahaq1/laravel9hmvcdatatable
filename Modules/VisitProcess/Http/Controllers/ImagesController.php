<?php

namespace Modules\VisitProcess\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\VisitProcess\Entities\VisitedImage;

class ImagesController extends Controller
{
    public function index()
    {
        return view('visitprocess::__visited_images',[
            'ptitle'=>'Outlet Visit Images'
        ]);
    }


    public function destroy($id)
    {
        if(VisitedImage::where('id',$id)->delete()){
            $response = array(
                'success'  =>true,
                'message'  => 'Delete successfully'
            );
        }
        return json_encode($response);
    }



    public function getVisitedImage(Request $request)
    {
        

        if ($request->ajax()) {

            return DataTables::of($data=VisitedImage::visitedImages($request))->addIndexColumn()

                ->addColumn('outlet_name', function ($data) {
                    return $data->outlet_name;
                })
                
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('created_at', function ($data) {
                    return $data->created_at;
                })

                ->addColumn('image', function ($data) {
                    if($data->images){
                        $imag = url('/public/'.$data->images);
                    }else{
                        $imag = url('public/assets/dist/img/avatar-1.jpg');
                    }
                    $image = '<img src="'.$imag.'" width="50">';
                    return $image;
                })
             
                ->addColumn('action', function($data){
                    $actionBtn = '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('visited-images.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    return $actionBtn;
                })

            ->rawColumns([ 'outlet_name', 'name','created_at','image','action'])
            ->make(true);
        }

    }


}
