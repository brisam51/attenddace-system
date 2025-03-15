<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\BankInfoController;
use App\Http\Controllers\Admin\JobDetailsController;

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
Route::get('user/job/index/{id}', [JobDetailsController::class, 'fetchDataById'])->name('get.user.job');
Route::post('user/job/create', [JobDetailsController::class, 'store']);
Route::put('user/job/update/{id}', [JobDetailsController::class, 'update'])->name('update.user.job');
//Project
Route::get("projects/index", [ProjectController::class, 'index'])->name('projects.index');
Route::get("projects/create", [ProjectController::class, 'create'])->name('projects.create');
Route::post("projects/store", [ProjectController::class, 'store'])->name('projects.store');
Route::get("projects/edit/{id}", [ProjectController::class, 'edit'])->name('projects.edit');
Route::post("projects/update/{id}", [ProjectController::class, 'update'])->name('projects.update');
Route::get("projects/delete/{id}", [ProjectController::class, 'destroy'])->name('projects.delete');

//Project User
Route::get("project-user/index/{id}", [ProjectUserController::class, 'fetchDataById'])->name('projects.members');
Route::get("project-user/create", [ProjectUserController::class, 'create'])->name('project-user.create');
Route::post("project-user/store", [ProjectUserController::class, 'store'])->name('project-user.store');
Route::get("project-user/edit/{id}", [ProjectUserController::class, 'edit'])->name('project-user.edit');
Route::post("project-user/update/{id}", [ProjectUserController::class, 'update'])->name('project-user.update');
Route::get("project-user/delete/{id}", [ProjectUserController::class, 'destroy'])->name('project-user.delete');
