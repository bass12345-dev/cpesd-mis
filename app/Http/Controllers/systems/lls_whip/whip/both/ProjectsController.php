<?php

namespace App\Http\Controllers\systems\lls_whip\whip\both;

use App\Http\Controllers\Controller;
use App\Repositories\CustomRepository;
use App\Services\whip\ContractorsService;
use App\Services\whip\ProjectsService;
use App\Http\Requests\whip\ProjectStoreRequest;
use App\Repositories\whip\ContractorQuery;
use App\Repositories\whip\ProjectQuery;
use App\Services\CustomService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    protected $conn;
    protected $Contractorquery;
    protected $projectQuery;
    protected $projectService;
    protected $contractorService;
    protected $customService;
    protected $customRepository;
    protected $projects_table;
    protected $status_table;
    protected $order_by_asc = 'asc';
    protected $order_by_key = 'project_id';
    protected $position_table;
    protected $nature_table;

    public function __construct(CustomRepository $customRepository, ProjectsService $projectService, ContractorsService $contractorsService, ContractorQuery $Contractorquery, ProjectQuery $projectQuery,CustomService $customService){
        $this->conn                 = config('custom_config.database.lls_whip');
        $this->customRepository     = $customRepository;
        $this->projectQuery         = $projectQuery;
        $this->projectService       = $projectService;
        $this->contractorService    = $contractorsService;
        $this->customService        = $customService;
        $this->projects_table       = 'projects';
        $this->position_table       = 'positions';
        $this->status_table         = 'employment_status';
        $this->nature_table         = 'project_nature';
        $this->Contractorquery      = $Contractorquery;
    }

    
    public function projects_list(){
        $data['title'] = 'Projects List';
        return view('systems.lls_whip.whip.both.projects.lists.lists')->with($data);
    }

    public function add_new_project(){
        $data['title'] = 'Add New Project';
        $data['barangay']   = config('custom_config.barangay');
        $data['project_nature']  = $this->customRepository->q_get_order($this->conn,$this->nature_table,'project_nature','asc')->get();
        return view('systems.lls_whip.whip.both.projects.add_new.add_new')->with($data);
    }
    //CREATE
    public function insert_project(ProjectStoreRequest $request){

        $validatedData = $request->validated();
        $insert = $this->projectService->registerProj($validatedData);
        
        if ($insert) {
            // Registration successful
            return response()->json([
                'message' => 'Project Added Successfully', 
                'response' => true
            ], 201);
        }else {
            return response()->json([
                'message' => 'Something Wrong', 
                'response' => false
            ], 422);
        }
    }
    //READ
    public function get_all_projects(){
        $query_row = $this->projectQuery->QueryAllProjects();
        $items = [];
        foreach ($query_row as $row) {
            $items[] = array(
                        'project_id'        => $row->project_id,
                        'project_title'     => $row->project_title,
                        'project_cost'      => $row->project_cost,
                        'project_status'    => $row->project_status,
                        'contractor'        => $row->contractor_name,
                        'project_location'  => $row->barangay.' , '.$row->street,
                        'date_started'      => Carbon::parse($row->date_started)->format('M d Y') ,
                        'monitoring_count'  => $row->monitoring_count,
                        'project_nature'    => $row->project_nature
            );
        }
        return response()->json($items);

    }
    //UPDATE
    //DELETE
    public function delete_projects(Request $request){

        $id = $request->input('id')['id'];
        if (is_array($id)) {
            foreach ($id as $row) {
               $where = array('project_id' => $row);
               $this->customRepository->delete_item($this->conn,$this->projects_table,$where);
            }

            $data = array('message' => 'Deleted Succesfully', 'response' => true);
        } else {
            $data = array('message' => 'Error', 'response' => false);
        }



        return response()->json($data);
    }

    //SEARCH
    public function search_project(){
        $q = trim($_GET['key']);
        $items = $this->projectQuery->q_search($this->conn,$q);
        $data = [];
        foreach ($items as $row) {
            $data[] = array(
                'project_id'        => $row->project_id,
                'project_title'     => $row->project_title,
                
            );
        }
        return response()->json($data);
    }
}
