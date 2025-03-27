<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectTaskUser;
use GuzzleHttp\Psr7\Query;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ProjectTaskUserController extends Controller
{
    public function fetchMemberByProjectId($projectId)
    {
        $project_member = ProjectTaskUser::projectMemebers($projectId);
        $projectTitle = Project::where('id', $projectId)->pluck('title')->first();

        if (!empty($project_member) ) {
          
            if(!empty($projectTitle)){
                return view('project_members.members', ['members' => $project_member, 'project_id' => $projectId, 'projectTitle' => $projectTitle]);
            }
           
        } else {
            return self::addMemberView($projectId);
        }
    }
    //call add new member view  
    public function addMemberView($projectId)
    {
        $members = User::select('id', 'first_name', 'last_name')
            ->where('work_status', '=', 'active')
            ->get();

        $tasks = Task::select('id', 'title')->get();
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
            'user_id' => ['required',Rule::unique('project_task_user')->where(function($query)use($request){
                return$query->where('project_id',$request->project_id)
                    ->where('user_id',$request->user_id);
            })],
            'task_id' => 'required',
            'project_id' => 'required',
        ]);
        try {
            if ($request->hasFile('file_contract')) {
                $validated = $request->validated(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048 ']);
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images'), $imageName);

                $request['file_contract'] = $imageName;
            }
            $projectMember = ProjectTaskUser::create($request->all());
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
        $tasks=Task::all();
        $singleMember = ProjectTaskUser::finSingleMemeber($id);

        if (!empty($singleMember)) {
            return view('project_members.edit_member', ['member' => $singleMember,'tasks'=>$tasks]);
        }
    }



    //update project member
    public function updateMember(Request $request, $id)
    {
     
        $dataToUpdate= [];
        try {
            $validated = $request->validate([
                'file_contract' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048  ',
                'task_id' => 'required',
            ]);
            $projectMember = ProjectTaskUser::find($id);
            
            if ($request->hasFile('file_contract')) {
                $image = $request->file('file_contract');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images'), $imageName);
                if (!empty($projectMember->file_contract)) {
                    unlink(public_path('assets/images/' . $projectMember->file_contract));
                }
                $dataToUpdate['file_contract'] = $imageName;
            }
            $dataToUpdate['task_id'] = $request->task_id;
            $projectMember->update($dataToUpdate);  
           

            return redirect()->route('projects.members', $projectMember->project_id)->with('success', 'Member updated successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    //delet project member
    public function deleteMember($id)
    {
        try {
            $projectMember = ProjectTaskUser::find($id);
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
