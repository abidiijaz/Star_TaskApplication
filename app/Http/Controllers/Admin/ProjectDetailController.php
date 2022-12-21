<?php

namespace App\Http\Controllers\Admin;

use App\Task;
use DateTime;
use App\Skill;
use App\Project;
use App\ProjectAssign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectDetailController extends Controller
{
    public function index(Request $req){
        $project = Project::where('id',$req->project_id)->with('projectcatagory','createproject','head')->first();
        // $date1 = new DateTime($project->start_date);
        $date1 = new DateTime();
        $date2 = new DateTime($project->deadline);
        $interval = $date1->diff($date2);
        $d_left = $interval->format('%a');
        $pending_tasks = Task::where('project_id',$req->project_id)->where('status','!=',4)->where('status','!=',5)->count();
        $complete_task = Task::where('project_id',$req->project_id)->where('status',5)->count();
        $assign_tables = ProjectAssign::where('project_id',$req->project_id)->with('Getusers')->get();
        $skills = [];
        $skills = Skill::where('user_id',$project->create_project)->get();
        if(count($skills) == 0){
            $skills = Skill::where('user_id',$project->project_head)->get();
        }
        $tasks = Task::where('project_id',$req->project_id)->get();
        $left_days=$d_left;
        $datecheck = ($date1>$date2 ?? "" );
        return view('admin.projectdetails',compact('project','left_days','pending_tasks','complete_task','assign_tables','skills','tasks','datecheck'));
    }
}
