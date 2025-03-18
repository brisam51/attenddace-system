<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProjectUser;
use Exception;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
   public function fetchDataByProject_Id($project_id)
   {
      $allMembers = ProjectUser::where('project_id', $project_id)->get();
      if (!$allMembers) {
         return view('project_members.members', ['allmembers'=>$allMembers,'project_id'=>$project_id]);
      } else {
         return view('project_members.members',['project_id'=>$project_id])->with('error', 'No memebers found');
      }
   }

   public  function createMember($project_id)
   {
      $allMembers = User::all();
     return view('project_members.add_member', ['allMembers'=>$allMembers,'project_id'=>$project_id]);
   }
}
