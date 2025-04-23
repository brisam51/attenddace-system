<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\ProjectTaskUser;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;

class AttendanceController extends Controller
{ //AttendanceController

   public function index()
   {
      $user_id = 3;
try{
  // Retrieve the active project title for the given user
  $activeProject = ProjectTaskUser::where('user_id', $user_id)
  ->whereHas('project', function ($query) {
     $query->where('status', 0); //filtter for get active projects
  })
  ->with(['project' => function ($query) {
     $query->select('id', 'title');
  }])->get()
  ->map(function ($projectTaskUser) {
     return [
        'project_id' => $projectTaskUser->project?->id,
        'project_title' => $projectTaskUser->project?->title,
        'task_id' => $projectTaskUser->task_id,
        'task_title' => $projectTaskUser->task?->title,
        'user_id' => $projectTaskUser->user_id,
     ];
  });


return view('attendance.list_projects_person', ['activeProject' => $activeProject]);
}catch(Exception $e) {
return back()->with('error', 'An error occurred while retrieving the active project title for the given user.');
}
    
   }

   //call the start attendance
   public function startAttendance(Request $request)
   {
     
      $validated = $request->validate([
         'user_id' => 'required|exists:users,id',
         'project_id' => 'required|exists:projects,id',
         'task_id' => 'required|exists:tasks,id',
      ]);
      try {
   
         //check if the user has already active attendance (starte
         $activeAttendance = Attendance::where('user_id', $validated['user_id'])
         
            ->whereNull('end_time')
            ->first();
         if ($activeAttendance) {
            return back()->with('error','زمان ورده شما قبلا ثبت شده است');
         }
         $intUser_id = intval($validated['user_id']);
         $intProject_id = intval($validated['project_id']);
         $intTask_id = intval($validated['task_id']);
         $workDate = Carbon::now()->format('Y-m-d');
         $startTime = Carbon::now()->format('H:i');
         $attendance = Attendance::create([
            'user_id' => $intUser_id,
            'project_id' => $intProject_id,
            'task_id' => $intTask_id,
            'work_date' => $workDate,
            'created_by' =>2,
            'updated_by' => 2,
            'start_time' =>  $startTime,
         ]);
         return back()->with('success','زمان ورود شما از پروژه با موفقیت ثبت شد');
      } catch (Exception $e) {
         Log::error($e->getMessage());
         return response()->json([
            'success' => false,
            'message' => 'خطایی رخ داده است. لطفا مجددا تلاش کنید ',
            'error' => $e->getMessage()
         ], 500);
      }
   }
   //call the end attendance  
   public function endAttendance(Request $request)
   {
      $validated = $request->validate([
         'user_id' => 'required|exists:users,id',
         'project_id' => 'required|exists:projects,id',
         'task_id' => 'required|exists:tasks,id',
      ]);

      try {
         $intUser_id = intval($validated['user_id']);
         $intProject_id = intval($validated['project_id']);
         $intTask_id = intval($validated['task_id']);
         $attendance =  Attendance::where('user_id',$intUser_id)
            ->where('project_id',  $intProject_id)
            ->where('task_id', $intTask_id)
            ->whereNull('end_time')
            ->latest('start_time')
            ->first();
         if (!$attendance) {
            return back()->with('error',' زمان ورودی برای شما در این پروژه ثبت نشده است  ');
         }
         $startTime = Carbon::parse($attendance->start_time);
         $endTime = Carbon::now();
         //prevent ending time  before start time
         if ($endTime->lt($startTime)) {
            return response()->json([
               'success' => false,
               'message' => 'ثبت پایان حضور نباید قبل از ثبت شروع حضور انجام گیرد.'
            ], 400);
         }
         $formatedTotalTime = Number_format($startTime->diffInMinutes($endTime) / 60, 2);
         $attendance->update([
            'end_time' =>  $endTime->format('H:i'),
            'total_time' => $formatedTotalTime,
         ]);
         return back()->with('success','.زمان  خروج شما با موفقیت ثبت شد');
            } catch (Exception $e) {
         Log::error($e->getMessage());
         return response()->json([
            'success' => false,
            'message' => 'خطایی رخ داده است. لطفا مجددا تلاش کنید.'
         ], 500);
      }
   } //end end time function
   //new methode to get user's daily  attendance summry
   public function dailySummery($usr_id)
   {
      $today = Carbon::today()->format('Y-m-d');
      $attendance = Attendance::where('user_id', $usr_id)->whereDate('work_date', $today)
         ->with('project:id,title')
         ->get();
      $totalMinutes = $attendance->sum('total_time');
      return response()->json([
         'success' => true,
         'message' => 'Attendance summery',
         'data' => [
            'attendance' => $attendance,
            'total_hours' => floor($totalMinutes / 60),
            'total_minutes' => $totalMinutes % 60,
            'total_projects' => $attendance->groupBy('project_id')->count()
         ]
      ]);
   }
   //Manual store attendance

}
