<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjecttaskUser;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class ProjecttaskUserController extends Controller
{
    public function fetchMemberByProjectId($projectId)
    {
        $project_member = ProjecttaskUser::projectMemebers($projectId);


        if ($project_member->isNotEmpty()) {
            return view('project_members.members', ['members' => $project_member, 'project_id' => $projectId]);
        } else {
            return self::addMemberView($projectId);
        }
    }
    //call add new member view  
    public function addMemberView($projectId)
    {
        $members = User::select('id', 'first_name', 'last_name')
        ->where('work_status','=' ,'active')
        ->get();
       
        $tasks =Task::select('id', 'title')->get();
               return view('project_members.add_member', [
            'members' => $members,
            'tasks' => $tasks,
            'projectId' => $projectId
        ]);
    }
    //add new member to project
    public function addMember(Request $request)
    {
        //validate comming requeset data
        $validate = $request->validate([
            'user_id' => 'required',
            'task_id' => 'required',
            'project_id' => 'required',
        ]);
        try {
            $projectMember = ProjecttaskUser::create($request->all());
            //redirect to project members page
            return redirect()->route('projects.members', ['projectId' => $request->project_id]);
        } catch (\Exception $e) {

            Log::alert('Error in add member to project', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again later.');
    }
    //edit member  project
    public function editMember($id)
    {

        $singleMember = ProjecttaskUser::finSingleMemeber($id);
        
       if(!empty($singleMember)){
        return view('project_members.edit_member', ['member' => $singleMember]);
       }
           
        
    }
    //update project member
    // public function updateMember(Request $request, $id)
    // {
    //     $validate = $request->validate([
    //         'user_id' => 'required',
    //         'task_id' => 'required',
    //         'project_id' => 'required',
    //     ]);
    //     try {
    //  }catch (\Exception $e) {
    //         Log::alert('Error in update member to project', [
    //             'message' => $e->getMessage(),
    //             'code' => $e->getCode(),
    //             'trace' => $e->getTraceAsString(),
    //         ]);
    //  }


    // }
    //update project member
    public function updateMember(Request $request, $id)
    {
        $validate = $request->validate([
            'user_id' => 'required',
            'task_id' => 'required',
            'project_id' => 'required',
        ]);
        try {
            $projectMember = ProjecttaskUser::find($id);
            $projectMember->update($request->all());
            return redirect()->back()->with('success', 'Member updated succ');
        } catch (\Exception $e) {
            Log::alert('Error in edit member to project', ['message' => $e->getMessage(), 'code' => $e->getCode(), 'trace' => $e->getTraceAsString(),]);
        }
    }

    //delet project member
    public function deleteMember($id)
    {
        try {
            $projectMember = ProjecttaskUser::find($id);
            $projectMember->delete();
            return redirect()->back()->with('success', 'Member deleted successfully');
        } catch (\Exception $e) {
            Log::alert('Error in delete member from project', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}//end class
