<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\ProjectTaskUser;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{ //AttendanceController

   public function index()
   {
      $user_id = 1;

      // Retrieve the active project title for the given user
      $activeProject = ProjectTaskUser::where('user_id', $user_id)
         ->whereHas('project', function ($query) {
            $query->where('status', 0);
         })
         ->with(['project' => function ($query) {
            $query->select('id', 'title');
         }])->get()
         ->map(function ($projectTaskUser) {
            return [
               'project_id' => $projectTaskUser->project?->id,
               'project_title' => $projectTaskUser->project?->title,
            ];
         });
      return view('attendance.index', ['activeProject' => $activeProject, 'user_id' => $user_id]);
   }
}
