<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelpers;
use App\helpers\NumberConverter;
use Exception;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Log;

class ManualAttendanceController extends Controller
{


    //get all employees of a project
    // public function getMembers($id)
    // {
    //     $project = Project::find($id);
    //     $members = $project->users;
    //     return view('attendance.manual_attendance_form', ['members' => $members, 'project' => $project]);
    // }


    // Helper function to calculate total time
    // private function calculateTotalTime($startTime, $endTime)
    // {
    //     $start = Carbon::createFromFormat('H:i', $startTime);
    //     $end = Carbon::createFromFormat('H:i', $endTime);
    //     $formatedTotalTime=number_format($start->diffInMinutes($end) / 60,2);
    //     return $formatedTotalTime;
    // }


    //get all user that member in active projects
    public function getActiveProjectMembers(Request $request)
    {
        $activeProject = Project::where('status', 0)->with('users')->get();
        $activeUsers = $activeProject->flatMap(function ($project) {
            return $project->users;
        })->unique('id');

        return view("attendance.manual_active_members", ["activeUsers" => $activeUsers]);
    }

    //get list of projects that user is member of
    public function getActiveProjects($user_id)
    {

        try {
            $user = User::find($user_id);

            $activeProjects = Project::getActiveProjects($user->id);



            return view("attendance.manual_active_projects", ["projects" => $activeProjects, 'user' => $user]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    //show attendance details list
    public function attendanceDetails($project_id, $user_id, $task_id)

    {

        try {
            $intUser_id = (int)$user_id;
            $intProject_id = (int)$project_id;
            $intTask_id = (int)$task_id;

            $detials = Attendance::getAttendanceDetails($intUser_id, $intProject_id, $intTask_id);
            if ($detials->count() == 0) {
                return redirect()->route("manual-attendance.addForm", [
                    "project_id" => $project_id,
                    "user_id" => $user_id,
                    "task_id" => $task_id,
                ])->with(
                    "success",
                    "لطفا حضور و غیاب جدید برای کار مورد نظر وارد نمایید."
                );
            }

            return view("attendance.manual_attendance_details", ["details" => $detials]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    //edit attendnance details form
    public function attendanceEditDetails($attendance_id)
    {

        try {
            $attendance = Attendance::find($attendance_id);



            $attendance['work_date'] = DateHelpers::gregorianToPersianDate($attendance->work_date);
            $formatted_attendance['start_time'] = NumberConverter::englishToPersianNumber($attendance->start_time);
            $attendance['end_time'] = NumberConverter::englishToPersianNumber($attendance->end_time);
            dd($attendance);
            return view('attendance.manual_edit_details', ['attendance' =>  $formatted_attendance]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateAttendanceDetails(Request $request, $id)
    {

        try {
            $validated = $request->validate([
                'work_date' => 'nullable|string',
                'start_time' => 'nullable|string',
                'end_time' => 'required|string'
            ]);
            //Convert strinf date,start time and end time to gergorian date format
            $attendanceDetails = Attendance::findOrFail($id);
            $workDate = DateHelpers::persianToEnglishDate($validated['work_date'])->format('Y-m-d');
            $startTime = Carbon::parse(NumberConverter::persianToEnglishNumber($validated['start_time']));
            $endTime = Carbon::parse(NumberConverter::persianToEnglishNumber($validated['end_time']));
            $totalTime = $startTime->diffInMinutes($endTime) / 60;
            $formatedTotalTime = Number_format($totalTime, 2);
            if (!empty($attendanceDetails)) {
                $attendanceDetails->update([
                    'work_date' => $workDate,
                    'start_time' => $startTime->format('H:i'),
                    'end_time' => $endTime->format('H:i'),
                    'total_time' =>  $formatedTotalTime,
                ]);

                return redirect()->route('manual-attendance.details', ['project_id' => $attendanceDetails->project_id, 'user_id' => $attendanceDetails->user_id, 'task_id' => $attendanceDetails->task_id])->with('success', 'تغییرات با موفقیت ثبت شد');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //Add new attendance details manually
    public function addNewAttendanceManully($project_id, $user_id, $task_id)

    {

        try {
            return view('attendance.new_attendance_form', ['user_id' => $user_id, 'project_id' => $project_id, 'task_id' => $task_id]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    //store new attendance details
    public function createManualAttendance(Request $request)
    {
        try {
            $validated = $request->validate([
                'work_date' => 'required|string',
                'start_time' => 'required|string',
                'end_time' => 'required|string',
                'project_id' => 'required|integer',
                'user_id' => 'required|integer',
                'task_id' => 'required|integer',
            ]);

            //Convert work_date string to gergorian date
            $workDate = DateHelpers::persianToEnglishDate($request->work_date);
            $startTime = Carbon::parse(NumberConverter::persianToEnglishNumber($request->start_time));
            $endtTime = Carbon::parse(NumberConverter::persianToEnglishNumber($request->end_time));
            $totalTime = $startTime->diffInMinutes($endtTime) / 60;
            $attendance = Attendance::create([
                'work_date' => $workDate->format('Y-m-d'),
                'start_time' => $startTime->format('H:i'),
                'end_time' => $endtTime->format('H:i'),
                'total_time' => Number_format($totalTime, 2),
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'task_id' => $request->task_id,
            ]);
            return redirect()->route('manual-attendance.details', ['project_id' => $request->project_id, 'user_id' => $request->user_id, $request->task_id])->with('success', 'حضورو غیاب جدید با موفقیت ثبت شد.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    //update attendance details

}//end  class 
