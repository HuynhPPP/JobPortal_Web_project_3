<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CareerController;
use App\Http\Controllers\admin\JobController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get("/admin/home", [DashboardController::class, "index"])->name('admin.home');

Route::get("/admin/career", [CareerController::class, "index"])->name('admin.career');

Route::post("/admin/create-career", [CareerController::class, "postCreateCareer"])->name('admin.create.career');

Route::post("/admin/edit-career/{id}", [CareerController::class, "postEditCareer"])->name('admin.postEditCareer.career');

Route::delete("/admin/delete-career/{id}", [CareerController::class, "deleteCareer"])->name('admin.deleteCareer.career');

Route::get("/admin/edit-career/{id}", [CareerController::class, "getEditCareer"])->name('admin.getEditCareer.career');

Route::get("/admin/job", [JobController::class, "index"])->name('admin.job');

Route::get("/admin/edit-job/{id}", [JobController::class, "editJob"])->name('admin.edit.job');
Route::post("/admin/update-job/{id}", [JobController::class, "updateJob"])->name('admin.update.job');

Route::get("/admin/user", [DashboardController::class, "getUser"])->name('admin.user');

Route::get("/admin/employer", [DashboardController::class, "getEmployer"])->name('admin.employer');
