<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\BankInfoController;
use App\Http\Controllers\ProjectTaskUserController;
use App\Http\Controllers\ManualAttendanceController;

Route::get('/', function () {
    return view('admin.user.dashboard');
});

//Personal Details
Route::get('user/index', [UserController::class, 'index']);

Route::get('user/show/{id}', [UserController::class, 'show'])->name("get.user.details");
Route::get('user/new', [UserController::class, 'newUserView']);
Route::post('user/store', [UserController::class, 'store'])->name('create.user');
Route::get('user/edit/{id}', [UserController::class, 'edit']);
Route::post('user/update/{id}', [UserController::class, 'update']);
Route::get('user/delete/{id}', [UserController::class, 'destroy']);
//Address routes
Route::get('user/address/{id}', [AddressController::class, 'fetchDataById'])->name('get.user.address');
Route::post('user/address/store', [AddressController::class, 'store'])->name('create.user.address');
Route::get('user/address/edit/{id}', [AddressController::class, 'edit']);
Route::put('user/address/update/{id}', [AddressController::class, 'update'])->name('update.user.address');
//bank details
Route::get('user/bank/index/{id}', [BankInfoController::class, 'fetchDataById'])->name('get.user.bank');
Route::post('user/bank/store', [BankInfoController::class, 'store']);
Route::put('user/bank/update/{id}', [BankInfoController::class, 'update'])->name('update.user.bank');
//task Details
Route::get('tasks/index', [taskController::class, 'index'])->name('all.tasks');
Route::get('tasks/create', [taskController::class, 'create'])->name('create.task');
Route::post('tasks/store', [taskController::class, 'store'])->name('store.task');
Route::get('tasks/edit/{id}', [taskController::class, 'edit'])->name('edit.task');
Route::post('tasks/update/{id}', [taskController::class, 'update'])->name('update.task');
Route::get('tasks/delete/{id}', [taskController::class, 'destroy'])->name('delete.task');

//Project
Route::get("projects/index", [ProjectController::class, 'index'])->name('projects.index');
Route::get("projects/create", [ProjectController::class, 'create'])->name('projects.create');
Route::post("projects/store", [ProjectController::class, 'store'])->name('projects.store');
Route::get("projects/edit/{id}", [ProjectController::class, 'edit'])->name('projects.edit');
Route::post("projects/update/{id}", [ProjectController::class, 'update'])->name('projects.update');
Route::get("projects/delete/{id}", [ProjectController::class, 'destroy'])->name('projects.delete');

//Project task User
Route::get("project/member/index/{projectId}", [ProjectTaskUserController::class, 'fetchMemberByProjectId'])->name('projects.members');
Route::get("project/member/create/{projectId}", [ProjectTaskUserController::class, 'addMemberView'])->name('project-member.create');
Route::post("project/member/store", [ProjectTaskUserController::class, 'addMember'])->name('project-member.store');
Route::get("project/member/edit/{id}", [ProjectTaskUserController::class, 'editMember'])->name('project-member.edit');
Route::post("project/member/update/{id}", [ProjectTaskUserController::class, 'updateMember'])->name('project-member.update');
Route::get("project/member/delete/{id}", [ProjectTaskUserController::class, 'deleteMember'])->name('project-member.delete');
// Automatic attendance    
Route::get("attendance/index", [AttendanceController::class, 'index'])->name('attendance.index');
Route::get("attendance/daily/summary/{id}", [AttendanceController::class, 'dailySummery'])->name('attendance.daily.summery');
Route::post("attendance/start/time", [AttendanceController::class, 'startAttendance'])->name('attendance.start-time');
Route::post("attendance/end/time", [AttendanceController::class, 'endAttendance'])->name('attendance.end-time');
Route::get("attendance/edit/{id}", [AttendanceController::class, 'edit'])->name('attendance.edit');
Route::post("attendance/update/{id}", [AttendanceController::class, 'update'])->name('attendance.update');
//Manual attendance
Route::get("manual/attendance/index", [ManualAttendanceController::class, 'index'])->name('manual-attendance.index');
Route::get("manual/attendance/members/{id}", [ManualAttendanceController::class, 'getMembers'])->name('manual-attendance.members');
Route::post("/manual/attendance/store", [ManualAttendanceController::class, 'storeManual']);

Route::get("manual/attendance/edit/{id}", [ManualAttendanceController::class, 'editAttendance'])->name('manual-attendance.edit');
Route::post('manual/attendance/update', [ManualAttendanceController::class, 'updateAttendance'])->name('manual-attendance.update');
Route::get("manual/attendance/getMember", [ManualAttendanceController::class, 'getMembers']);
Route::get("manual/attendance/delete/{id}", [ManualAttendanceController::class, 'delete'])->name('manual-attendance.delete');
Route::get("manual/attendance/getActiveUsers", [ManualAttendanceController::class, 'getActiveProjectMembers'])->name("manual-attendance.activeUsers");
Route::get("manual/attendance/getActiveProjects/{id}", [ManualAttendanceController::class, 'getActiveProjects'])->name("manual-attendance.activeProjects");
Route::get('manual/attendance/details/{project_id}/{user_id}', [ManualAttendanceController::class, 'attendanceDetails'])->name('manual-attendance.details');
Route::get('manulal/add/attendance/{project_id}/{user_id}', [ManualAttendanceController::class, 'addNewAttendanceManully'])->name('manual-attendance.addForm');
Route::post('manual/attendance/create', [ManualAttendanceController::class, 'createManualAttendance'])->name('manual-attendance.createManualAttendance');
Route::get('attendance_edit/details/{id}', [ManualAttendanceController::class, 'attendanceEditDetails'])->name('attendance_edit.details');
Route::post('attendance_update/details/{id}', [ManualAttendanceController::class,'updateAttendanceDetails'])->name('attendance-details.update');