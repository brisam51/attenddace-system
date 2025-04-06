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
   //show attendance form

   public function storeManual(Request $request)
   {

      try {
         $validated = $request->validate([
            'user_ids.*' => 'required|exists:users,id',
            'user_ids' => 'required|array',
            'project_id' => 'required|exists:projects,id',
            'work_date' => 'required',
            'start_time' => 'nullable',
            'end_time' => 'nullable',

         ]);

         $workDate = $request->input('work_date');
         $startTime = $request->input('start_time');
         $endTime = $request->input('end_time');
         $projectId = $request->input('project_id');
         $userIds = $request->input('user_ids');
$user_attendance= Attendance::where('user_id', $userIds)->where('work_date', $workDate)->first();
         //convert persian  Date and Time to Gregorian
         $work_date = DateHeplers::persianToEnglishDate($workDate)->format('Y-m-d');
         if (!empty($startTime)) {
            $Start_time = Carbon::createFromFormat('H:i', NumberConverter::persianToEnglishNumber($startTime))->format('H:i');
         } else {
            $Start_time = $user_attendance->start_time;
         }
         if (!empty($endTime)) {
            $end_time = Carbon::createFromFormat('H:i', NumberConverter::persianToEnglishNumber($endTime))->format('H:i');
         } else {
            $end_time = $user_attendance->end_time;
         }


         $createdCount = 0;
         $updatedCount = 0;
         $skippedCount = 0;
         $errors = [];

         foreach ($userIds as $userId) {
            try {
               //check if user has already attendance for this date
               $existingRecord = Attendance::where('user_id', $userId)
                  ->where('work_date', $workDate)
                  ->whereNotNull('start_time')
                  ->first();
               if ($existingRecord) {
                  $user = User::findOrFail($userId);
                  $skippedCount++;
                  $errors[] = "User {$user->first_name} has already attendance for this date for {$workDate}";
                  continue;
               }
               $attendance = Attendance::updateOrCreate([
                  'user_id' => $userId,
                  'project_id' => $projectId,
                  'work_date' => $work_date,

               ], [

                  'start_time' => $Start_time,
                  'end_time' => $end_time,
               ]);
               $attendance->wasRecentlyCreated() ? $createdCount++ : $updatedCount++;
            } catch (Exception $e) {
               Log::error("Error proccessing attendance for user {$userId}:" . $e->getMessage());
               $errors[] = "Error proccessing attendance for user {$userId}: " . $e->getMessage();
            }
         }
         //create proper response
         $response = [
            'success' => true,
            'message' => 'Attendance added successfully',
            'data' => [
               'created' => $createdCount,
               'updated' => $updatedCount,
               'skipped' => $skippedCount,
               // 'errors' => $errors,
            ],

         ];

         if (!empty($errors)) {
            $response['warning'] = $errors;
            if ($createdCount + $updatedCount === 0) {
               $response['success'] = false;
               $response['message'] = 'No attendance added';
            }
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
            'message' => 'Attendance store error' . $e->getMessage(),
            'data' => $e->getMessage()
         ], 500);
      }
   } //end of manal store attendance
}
