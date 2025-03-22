<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\JobDetailsController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\BankInfoController;
use App\Http\Controllers\ProjectJobUserController;

Route::get('/', function () {
    return view('admin.user.dashboard');
});

//Personal Details
Route::get('user/index', [UserController::class, 'index']);
//Route::get('/', [UserController::class, 'dashboard']);
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
//Job Details
Route::get('jobs/index', [JobDetailsController::class, 'index'])->name('all.jobs');
Route::get('jobs/create', [JobDetailsController::class, 'create'])->name('create.job');
Route::post('jobs/store', [JobDetailsController::class, 'store'])->name('store.job');
Route::get('jobs/edit/{id}', [JobDetailsController::class, 'edit'])->name('edit.job');
Route::post('jobs/update/{id}', [JobDetailsController::class, 'update'])->name('update.job');
Route::get('jobs/delete/{id}', [JobDetailsController::class, 'destroy'])->name('delete.job');

//Project
Route::get("projects/index", [ProjectController::class, 'index'])->name('projects.index');
Route::get("projects/create", [ProjectController::class, 'create'])->name('projects.create');
Route::post("projects/store", [ProjectController::class, 'store'])->name('projects.store');
Route::get("projects/edit/{id}", [ProjectController::class, 'edit'])->name('projects.edit');
Route::post("projects/update/{id}", [ProjectController::class, 'update'])->name('projects.update');
Route::get("projects/delete/{id}", [ProjectController::class, 'destroy'])->name('projects.delete');

//Project Job User
Route::get("project/member/index/{projectId}", [ProjectJobUserController::class, 'fetchMemberByProjectId'])->name('projects.members');
Route::get("project/member/create/{projectId}", [ProjectJobUserController::class, 'addMemberView'])->name('project-member.create');
Route::post("project/member/store", [ProjectJobUserController::class, 'addMember'])->name('project-member.store');
Route::get("project/member/edit/{id}", [ProjectJobUserController::class, 'editMember'])->name('project-member.edit');
Route::post("project/member/update/{id}", [ProjectJobUserController::class, 'updateMember'])->name('project-member.update');
Route::get("project/member/delete/{id}", [ProjectJobUserController::class, 'deleteMember'])->name('project-member.delete');
