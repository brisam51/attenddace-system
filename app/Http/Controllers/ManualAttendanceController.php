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
    //register attendance manually
    public function storeManual(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'user_ids.*' => 'required|exists:users,id',
                'user_ids' => 'required|array',
                'project_id' => 'required|exists:projects,id',
                'work_date' => 'required',
                'start_time' => 'nullable',
                'end_time' => 'nullable',
            ]);

            // Check if at least one of start time or end time is provided
            if ($request->input('start_time') == null && $request->input('end_time') == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'At least one of start time or end time is required'
                ], 422);
            }

            // Prepare data
            $workDate = DateHeplers::persianToEnglishDate($request->input('work_date'))->format('Y-m-d');
            $startTime = $request->input('start_time')
                ? Carbon::createFromFormat('H:i', NumberConverter::persianToEnglishNumber($request->input('start_time')))->format('H:i')
                : null;
            $endTime = $request->input('end_time')
                ? Carbon::createFromFormat('H:i', NumberConverter::persianToEnglishNumber($request->input('end_time')))->format('H:i')
                : null;
            $projectId = $request->input('project_id');
            $userIds = $request->input('user_ids');

            // Fetch all users at once
            $users = User::whereIn('id', $userIds)->get()->keyBy('id');

            $createdCount = 0;
            $updatedCount = 0;
            $skippedCount = 0;
            $errors = [];

            foreach ($userIds as $userId) {
                try {
                    // Check if user exists
                    if (!isset($users[$userId])) {
                        $skippedCount++;
                        $errors[] = "User with id {$userId} not found";
                        continue;
                    }

                    // Find existing attendance record
                    $attendanceRecord = Attendance::where('user_id', $userId)
                        ->where('work_date', $workDate)
                        ->where('project_id', $projectId)
                        ->first();

                    // Handle end time only scenario
                    if (!$startTime && $endTime && $attendanceRecord) {
                        // Only update end time if there's an existing record with start time
                        if ($attendanceRecord->start_time) {
                            $attendanceRecord->end_time = $endTime;
                            $attendanceRecord->total_time = $this->calculateTotalTime($attendanceRecord->start_time, $endTime);
                            $attendanceRecord->save();
                            $updatedCount++;
                            continue;
                        } else {
                            $errors[] = "Cannot add end time without start time for user ID {$userId}";
                            continue;
                        }
                    }

                    // Validate time logic
                    if ($startTime && $endTime && Carbon::createFromFormat('H:i', $endTime)->lessThan(Carbon::createFromFormat('H:i', $startTime))) {
                        $errors[] = "End time cannot be earlier than start time for user ID {$userId}";
                        continue;
                    }

                    // Calculate total time if both times are provided
                    $totalTime = ($startTime && $endTime)
                        ? $this->calculateTotalTime($startTime, $endTime)
                        : null;

                    // Create or update attendance record
                    $attendance = Attendance::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'project_id' => $projectId,
                            'work_date' => $workDate,
                        ],
                        [
                            'start_time' => $startTime ?? ($attendanceRecord->start_time ?? null),
                            'end_time' => $endTime ?? ($attendanceRecord->end_time ?? null),
                            'total_time' => $totalTime ?? $attendanceRecord->total_time ?? null,
                        ]
                    );

                    $attendance->wasRecentlyCreated ? $createdCount++ : $updatedCount++;
                } catch (Exception $e) {
                    $errors[] = "Error processing attendance for user {$userId}: " . $e->getMessage();
                    Log::error("Attendance processing error for user {$userId}: " . $e->getMessage());
                }
            }

            // Build response
            $response = [
                'success' => true,
                'message' => 'حضور با موفقیت ثبت شد',
                'data' => [
                    'created' => $createdCount,
                    'updated' => $updatedCount,
                    'skipped' => $skippedCount,
                    'errors' => $errors,
                ],
            ];

            // Handle partial success cases
            if ($createdCount == 0 && $updatedCount == 0) {
                if ($skippedCount > 0) {
                    $response['message'] = 'No new attendance records were created or updated because they already exist.';
                } elseif (count($errors) > 0) {
                    $response['success'] = false;
                    $response['message'] = 'Failed to process attendance records.';
                }
            }

            return response()->json($response, $response['success'] ? 200 : 400);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Attendance store error:' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred while processing attendance.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Helper function to calculate total time
    private function calculateTotalTime($startTime, $endTime)
    {
        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = Carbon::createFromFormat('H:i', $endTime);
        return $start->diffInMinutes($end) / 60;
    }
   
   
//get all user that member in active projects
public function getActiveProjectMembers(Request $request){
    $activeProject = Project::where('status', 0)->with('users')->get();
    $activeUsers=$activeProject->flatMap(function($project){
        return $project->users;
    })->unique('id');
    //Log::info('all project', ['active-user' => $activeUsers])
    return view("attendance.active_members",["activeUsers"=> $activeUsers]);
}

 //get list of projects that user is member of
public function getActiveProjects($id){
    try{
        $user = User::find($id);
        if($user){
            $projects = $user->projects()->where('status', 0)->get();
            return view("attendance.project_list",["projects"=> $projects,"user_id"=> $user->id]);
        }
        return view("attendance.project_list",["projects"=> []]);
    }catch(Exception $e){
        
    }
   
}

//show attendance details list
public function attendanceDetails($project_id, $user_id){
    try{
        $user= User::find($user_id)->only('first_name','last_name');
  $project = Project::find($project_id)->only('id','title');
    $attendance = Attendance::getAttendanceDetails($user_id, $project_id);
   
    return view('attendance.attendance_details',
    ['attendance'=> $attendance,'user'=>$user,'project'=>$project]);
    }catch(Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
    }
  
}

//edit attendnance details form
public function attendanceEditDetails($attendance_id){
  try{
    $attendance = Attendance::find($attendance_id);
    $attendance['workDate'] =DateHeplers::gregorianToPersianDate($attendance->work_date) ;
    $attendance['startTime'] =NumberConverter::englishToPersianNumber($attendance->start_time);
    $attendance['endTime'] =NumberConverter::englishToPersianNumber($attendance->end_time);

    return view('attendance.edit_details_form',['attendance'=>$attendance]);
  }catch(Exception $e){
    return redirect()->back()->with('error', $e->getMessage());
  }
   
}
//update attendance details
public function updateAttendanceDetails(Request $request, $id){
    dd($request->all());
    $attendance = Attendance::find($request->attendance_id);
    
}
}//end  class 
