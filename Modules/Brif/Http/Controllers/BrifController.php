<?php

namespace Modules\Brif\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\Brif\Entities\Brif;

class BrifController extends Controller
{


    public function index()
    {

        return view('brif::__brif',[
            'brifs'=>Brif::get()
        ]);
    }

 
    public function create()
    {

        return view('brif::create');
    }


    public function store(Request $request)
    {

        $validet = $request->validate(
            [
                'title' => 'required|string|max:20',
                'description' => 'required',
            ],
            [
                'title.required' => 'Please enter Title',
                'description.required' => 'Please enter description',
            ]
        );

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:20',
            'description' => 'required',
        ],
        [
            'title.required' => 'Please enter Title',
            'description.required' => 'Please enter description',
        ]);

        if ($validator->fails())
        {
            $response = array(
                'success'  =>false,
                'title'=>'Brife',
                'message'  => $validator->errors()->all()
            );
            return json_encode($response);
        }

        $data['title'] = $request->title;
        $data['description'] = $request->description;

        if ($request->file('file')) {
            $directory = '/uploads/brife-images/';
            $file = $request->file('file');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $data['file'] = $directory.$filename;
        }

        Brif::create($data);

        $response = array(
            'success'  =>true,
            'title'=>'Brife',
            'message'  => 'Added successfully'
        );
        return json_encode($response);



    }


    public function show($id)
    {
        return view('brif::show');
    }

    public function edit($id)
    {
        return view('brif::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {

        $data = Brif::where('id',$id)->delete();
        $response = array(
            'success'  =>true,
            'title'=>'Brif',
            'message'  => 'Delete successfully'
        );
        return json_encode($response);
        
    }
}
