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
         'project_id' => 'required|exists:projects,id',
      ]);
      try {
         //check if the user has already active attendance (starte
         $activeAttendance = Attendance::where('user_id', $validated['user_id'])
            ->whereNull('end_time')
            ->first();
         if ($activeAttendance) {
            return response()->json([
               'success' => false,
               'message' => 'لطفا به فعالیت های خود در پروژه های دیگر پایان دهید'
            ], 400);
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
         return response()->json(
            [
               'success' => true,
               'message' => 'حضور شما در پروژه با موفقیت ثبت شد!',
               'data' => $attendance
            ],
            200
         );
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
      ]);

      try {
         $user_id = $request->user_id;
         $project_id = $request->project_id;
         $attendance =  Attendance::where('user_id', $user_id)
            ->where('project_id', $project_id)
            ->whereNull('end_time')
            ->latest('start_time')
            ->first();
         if (!$attendance) {
            return response()->json([
               'success' => false,
               'message' => 'ثبت حضوری برای شما یافت نشد لطفا در ابتدا ثبت حضور بنمایید'
            ], 404);
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
         $workTime = $startTime->floatDiffInMinutes($endTime);
         $attendance->update([
            'end_time' =>  $endTime->format('H:i:s'),
            'total_time' =>  $workTime,
         ]);
         return response()->json([
            'success' => true,
            'message' => 'خروج از پروژه با موفقیت ثبت شد',
            'data' => [
               'start_time' => $startTime->format('H:i:s'),
               'end_time' => $endTime->format('H:i:s'),
               'total_time' => $workTime
            ]
         ]);
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
   public function storeManual(Request $request)
   {

    
      try {
         $validated = $request->validate([
            'user_ids.*' => 'required|exists:users,id',
            'user_ids' => 'required|array',
            'project_id' => 'required|exists:projects,id',
            'work_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

         ]);
         $workDate = $request->input('work_date');
         $startTime = $request->input('start_time');
         $endTime = $request->input('end_time');
         $projectId = $request->input('project_id');
         $userIds = $request->input('user_ids');
         //Convert persian Date to Gregorian
         $gWorkDate = Jalalian::fromFormat('Y/m/d', $workDate)->toCarbon();
         //Convert persian Time to Gregorian
         $gStartTime = Jalalian::fromFormat('H:i', $startTime)->toCarbon();
         $gEndTime = Jalalian::fromFormat('H:i', $endTime)->toCarbon();
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
                  'work_date' => $gWorkDate,

               ], [
                  'start_time' => $gStartTime,
                  'end_time' => $gEndTime,
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
            $response['warning']=$errors;
            if($createdCount+$updatedCount===0){
               $response['success']=false;
               $response['message']='No attendance added';

            }
         }
         return response()->json($response,$response['success']?200:400);
      } catch (\Illuminate\Validation\ValidationException $e) {
         Log::error($e->getMessage());
         return response()->json([
            'success' => false,
            'message' => 'Vaildation failed',
            'data' => $e->getMessage(),
            'errors' => $e->errors(),
         ],422);
      }catch (\Exception $e) {
         Log::error('Attendance store error:'.$e->getMessage()."\n".$e->getTraceAsString());
         return response()->json([
            'success' => false,
            'message' => 'Attendance store error',
            'data' => $e->getMessage()
            ],500);

      }
   } //end of manal store attendance
}
