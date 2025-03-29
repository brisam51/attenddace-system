<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Project;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\ProjectTaskUser;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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

   //call the start attendance
   public function startAttendance(Request $request)
   {
      $validated = $request->validate([
         'user_id' => 'required|exists:users,id',
         'project_id' => 'required|accepted|exists:projects,id',
      ]);
      try {
         //check if the user has already started attendance for the current day
         $ExistAttendance = Attendance::where('user_id', $validated['user_id'])
            ->whereDate('created_at', Carbon::today())
            ->first();
         if ($ExistAttendance) {
            return response()->json([
               'success' => false,
               'message' => 'You have already started attendance for the current day'], 400);
         }
         $workDate = Carbon::now()->format('Y-m-d');
         $startTime = Carbon::now()->format('H:i:s');
         $attendance = Attendance::create([
            'user_id' => $validated['user_id'],
            'project_id' => $validated['project_id'],
            'work_date' => $workDate,
            'created_by' => $validated['user_id'],
            'start_time' =>  $startTime,
         ]);
         return response()->json([
            'success' => true, 'message' => 'Attendance started successfully',
             'data' => $attendance],
              200);
      } catch (Exception $e) {
         Log::error($e->getMessage());
         return response()->json([
            'success' => false,
            'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
      }
   }
   //call the end attendance  
   public function endAttendance(Request $request)
   {
      $validated = $request->validate([
         'user_id' => 'required|exists:users,id',
         'project_id' => 'required|accepted|exists:projects,id',
      ]);
      try {
         $user_id = $request->user_id;
     
         $attendance =  Attendance::where('user_id', $user_id)->whereNull('end_time')->first();
         //check if attendance is already started  
         $startTimeExist = Attendance::where('user_id', $user_id)->whereNull('end_time')->exists();
         if ($startTimeExist) {
            //check if attendance is already ended
            $endTimeExist = Attendance::where('user_id', $user_id)->whereNotNull('end_time')->exists();
            if ($endTimeExist) {
               return response()->json([
                  'success' => false,
                  'message' => 'Attendance already ended.']);
            } else {
               $startTime = $attendance->start_time;
               $endTime = Carbon::now()->format(' H:i:s');
               $pars_startTime = Carbon::parse($startTime);
               $parsedEndTime = Carbon::parse($endTime);
               $workTime = $pars_startTime->diffInMinutes($parsedEndTime);
               $attendance->update([
                  'end_time' =>  $endTime,
                  'total_time' =>  $workTime,
               ]);
               return response()->json([
                  'success' => true,
                  'message' => 'Attendance ended successfully.']);
            }
         } else {

            return response()->json([
               'success' => false,
               'message' => 'Attendance not started.']);
         }
      } catch (Exception $e) {
         Log::error($e->getMessage());
         return response()->json([
            'success' => false,
            'message' => 'Something went wrong'], 500);
      }
   }

//   public function endAttendance(Request $request)
//    {
//       try {
//          $attendance = Attendance::where('user_id', Auth::user()->id)->where('end_time', null)->first();
//          if ($attendance) {
//             if ($attendance->end_time != null) {
//                return response()->json([
//                   'success' => false,
//             'm essage' => 'Something went wrong'], 500);
//       }
//    }
   
      }
