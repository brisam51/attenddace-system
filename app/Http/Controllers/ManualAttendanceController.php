<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ManualAttendanceController extends Controller
{
    //show all projects
    public function index()
    {
        $activeProjects =Project::where('status', 0)->get();
           
        return view('attendance.manual_index',['activeProjects'=>$activeProjects]); 
    }

    //get all employees of a project
    public function getMembers($id)
    {
        $project = Project::find($id);
        $members = $project->users;
        return view('attendance.manual_attendance_form',['members'=>$members, 'project'=>$project]); 
    }
    //show attendance form
    
}
