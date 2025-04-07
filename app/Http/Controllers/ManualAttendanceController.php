<?php

namespace App\Http\Controllers;

use App\helpers\DateHeplers;
use App\helpers\NumberConverter;
use Exception;
use App\Models\User;
use App\Models\Project;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Log;

class ManualAttendanceController extends Controller
{
   //show all projects
   public function index()
   {
      $activeProjects = Project::where('status', 0)->get();

      return view('attendance.manual_index', ['activeProjects' => $activeProjects]);
   }

   //get all employees of a project
   public function getMembers($id)
   {
      $project = Project::find($id);
      $members = $project->users;
      return view('attendance.manual_attendance_form', ['members' => $members, 'project' => $project]);
   }


   public function storeManual(Request $request)
   {

      try {
         //Valid
         $validated = $request->validate([
            'user_ids.*' => 'required|exists:users,id',
            'user_ids' => 'required|array',
            'project_id' => 'required|exists:projects,id',
            'work_date' => 'required',
            'start_time' => 'nullable',
            'end_time' => 'nullable',

         ]);
         //che if exist at least one of strt time or end time
         if ($request->input('start_time') == null && $request->input('end_time') == null) {
            throw new \Illuminate\Validation\ValidationException('At least one of start time or end time is required');
         }

         $workDate = $request->input('work_date');
         $startTime = $request->input('start_time');
         $endTime = $request->input('end_time');
         $projectId = $request->input('project_id');
         $userIds = $request->input('user_ids');
         $user_attendance = Attendance::where('user_id', $userIds)->where('work_date', $workDate)->first();
         //convert persian  Date  to Gregorian
         $work_date = DateHeplers::persianToEnglishDate($workDate)->format('Y-m-d');
         //Fetch all users
         $users = User::whereIn('id', $userIds)->get()->keyBy('id');
         //check if user has already attendance for this date
         $createdCount = 0;
         $updatedCount = 0;
         $skippedCount = 0;
         $errors = [];

         foreach ($userIds as $userId) {
            try {
               //check if user exist
               if (!isset($users[$userId])) {
                  $skippedCount++;
                  $errors[] = "User with id {$userId}not found";
                  continue;
               }
               //check if user has already attendance for this date
               $userExist = Attendance::where('user_id', $userId)->where('work_date', $work_date)->first();
               //prepar start time and end time
               $start_time = $startTime ? Carbon::createFromFormat('H:i', NumberConverter::persianToEnglishNumber($startTime))->format('H:i')
                  : ($userExist ? $userExist->start_time : null);
               $end_time = $endTime ? Carbon::createFromFormat('H:i', NumberConverter::persianToEnglishNumber($endTime))->format('H:i')
                  : ($userExist ? $userExist->end_time : null);
               // calculate total time
               $total_time = null;
               if ($start_time && $end_time) {
                  $start = Carbon::createFromFormat('H:i', $start_time);
                 $end=Carbon::createFromFormat('H:i', $end_time); 
                 $total_time=$start->diffInMinutes($end) / 60;
               }



               $attendance = Attendance::updateOrCreate([
                  'user_id' => $userId,
                  'project_id' => $projectId,
                  'work_date' => $work_date,

               ], [

                  'start_time' => $start_time,
                  'end_time' => $end_time,
                  'total_time' => $total_time,
               ]);
               $attendance->wasRecentlyCreated() ? $createdCount++ : $updatedCount++;
            } catch (Exception $e) {
               Log::error("Error proccessing attendance for user {$userId}:" . $e->getMessage());
               $errors[] = "Error proccessing attendance for user {$userId}: " . $e->getMessage();
            }
         }
         //Build response
         $response = [
            'success' => true,
            'message' => 'Attendance added successfully',
            'data' => [
               'created' => $createdCount,
               'updated' => $updatedCount,
               'skipped' => $skippedCount,
               'errors' => $errors,
            ],

         ];
         //Improve prtial success
         if ($createdCount == 0 && $updatedCount == 0) {
            $response['success'] = false;
            $response['message'] = 'No attendance records were created or updated.';
         }

         return response()->json($response, $response['success'] ? 200 : 400);
      } catch (\Illuminate\Validation\ValidationException $e) {
         Log::error($e->getMessage());
         return response()->json([
            'success' => false,
            'message' => 'Vaildation failed',
            'data' => $e->getMessage(),
            'errors' => $e->errors(),
         ], 422);
      } catch (\Exception $e) {
         Log::error('Attendance store error:' . $e->getMessage() . "\n" . $e->getTraceAsString());
         return response()->json([
            'success' => false,
            'message' => 'An unexpected error occurred while processing attendance.' . $e->getMessage(),
            'errors' => $e->getMessage()
         ], 500);
      }
   } //end of manal store attendance
}
