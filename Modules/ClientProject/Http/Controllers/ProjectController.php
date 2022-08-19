<?php

namespace Modules\ClientProject\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\ClientProject\Entities\Project;
use Illuminate\Contracts\Support\Renderable;
use Modules\ClientProject\Entities\ClientProject;

class ProjectController extends Controller
{
    
    public function index()
    {
        $client = Client::get(['client_name','id']);
        return view('clientproject::__project',[
            'ptitle' => 'Projects',
            'client'=>$client
        ]);

    }

    
    public function create()
    {
        return view('clientproject::create');
    }

    
    public function store(Request $request)
    {
        
        $storedata['project_name'] = $request->project_name;
        $project = Project::create($storedata);
        
        $clientproject['project_id'] = $project->id;
        $clientproject['client_id'] = $request->client_id;

        ClientProject::create($clientproject);

        $response = array(
            'success'  =>true,
            'message'  => 'Add successfully'
        );
        return json_encode($response);
        
    }

    
    public function show($id)
    {
        return view('clientproject::show');
    }

    
    public function edit($id)
    {
            $sql = Project::select("projects.*","client_projects.client_id");
            $sql->join("client_projects","client_projects.project_id","=","projects.id");
            $sql->join("clients","clients.id","=","client_projects.client_id");
            $sql->where('projects.id',$id);
            $data = $sql->first();

        return response()->json([
            'data'=>$data
        ]);
    }

    
    public function update(Request $request, $id)
    {

        $storedata['project_name'] = $request->project_name;
        Project::where('id',$id)->update($storedata);
        
        $clientproject['client_id'] = $request->client_id;
        ClientProject::where('project_id',$id)->update($clientproject);

        $response = array(
            'success'  =>true,
            'message'  => 'Update successfully'
        );
        return json_encode($response);

    }

    
    public function destroy($id)
    {

        if(Project::where('id',$id)->delete()){

            ClientProject::where('project_id',$id)->delete();
            $response = array(
                'success'  =>true,
                'message'  => 'Delete successfully'
            );
            return json_encode($response);

        }

    }

    
    public function get_project_list(Request $request)
    {
        
        $client_id = $request->client_id;
        
        $i=1;
        if ($request->ajax()) {

            $sql = Project::select("projects.*","client_projects.client_id","clients.client_name");
            $sql->join("client_projects","client_projects.project_id","=","projects.id");
            $sql->join("clients","clients.id","=","client_projects.client_id");
            $data = $sql->get();
            
            if(!empty($client_id)){
                $sql->where('client_id', $client_id);
            }
            $data = $sql->get();

            return DataTables::of($data)->addIndexColumn()
            
                ->addColumn('project_name', function ($data) {
                    return $data->project_name;
                })

                ->addColumn('client_name', function ($data) {
                    return $data->client_name;
                })

                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('status', function ($data) {
                    if($data->status==0){
                        $status = '<span class="badge bg-danger">Not Active</span>';
                    }else{
                        $status = '<span class="badge bg-success">Active</span>';
                    }
                    return $status;
                })

                ->addColumn('action', function($data){
                    $actionBtn = '<a href="javascript:void(0)" id="editAction" data-update-route="'.route('projects.update',$data->id).'" data-edit-route="'.route('projects.edit',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> '; 
                    $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('projects.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    return $actionBtn;
                    
                })

            ->rawColumns(['project_name','client_name','status', 'action'])
            ->make(true);
        }

    }
}
