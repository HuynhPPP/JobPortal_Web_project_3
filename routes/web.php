<?php

use App\Http\Controllers\admin\AccountController as AdminAccountController;
use App\Http\Controllers\admin\EmployerController;
use App\Http\Controllers\admin\JobApplyController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\AccountController;
use App\Http\Controllers\user\JobsController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CareerController;
use App\Http\Controllers\admin\FileDownloadController;
use App\Http\Controllers\user\ApiController;
use Illuminate\Support\Facades\Route;



Route::get("/admin/home", [AdminController::class, "index"])->name('admin.home');

Route::get("/admin/career", [CareerController::class, "index"])->name('admin.career');

Route::post("/admin/create-career", [CareerController::class, "postCreateCareer"])->name('admin.create.career');
Route::post("/admin/edit-career/{id}", [CareerController::class, "postEditCareer"])->name('admin.postEditCareer.career');
Route::delete("/admin/delete-career/{id}", [CareerController::class, "deleteCareer"])->name('admin.deleteCareer.career');
Route::get("/admin/edit-career/{id}", [CareerController::class, "getEditCareer"])->name('admin.getEditCareer.career');

Route::get("/admin/job", [JobController::class, "index"])->name('admin.job');
Route::get("/admin/edit-job/{id}", [JobController::class, "editJob"])->name('admin.edit.job');
Route::post("/admin/update-job/{id}", [JobController::class, "updateJob"])->name('admin.update.job');

Route::get("/admin/user", [UserController::class, "getUser"])->name('admin.user');
Route::get("/admin/edit-user/{id}", [UserController::class, "editUser"])->name('admin.edit.user');
Route::post('/admin/update-user/{id}', [UserController::class, 'updateUser'])->name('admin.update.user');
Route::delete('/admin/delete-user/{id}', [UserController::class, 'deleteUser'])->name('admin.delete.user');

Route::get("/admin/employer", [EmployerController::class, "getEmployer"])->name('admin.employer');
Route::get('/admin/edit-employer/{id}', [EmployerController::class, 'editEmployer'])->name('admin.edit.employer');
Route::post('admin/update-employer/{id}', [EmployerController::class, 'updateEmployer'])->name('admin.update.employer');
Route::delete('admin/delete-employer/{id}', [EmployerController::class, 'deleteEmployer'])->name('admin.delete.employer');

Route::get('/admin/apply-job', [JobApplyController::class, 'index'])->name('admin.apply.job');
Route::delete('/admin/delete-apply-job/{id}', [JobApplyController::class, 'deleteApllyJob'])->name('admin.delete.applyjob');

Route::get('/admin/profile', [AdminAccountController::class, 'profile'])->name('admin.profile');
Route::put('/admin/profile/update', [AdminAccountController::class, 'updateProfile'])->name('admin.updateProfile');
Route::post('/admin/profile', [AdminAccountController::class, 'updateImageProfile'])->name('admin.updateImageProfile');
Route::post('/admin/change-password', [AdminAccountController::class, 'changePassword'])->name('admin.changePassword');
Route::get('/download/{filename}', [FileDownloadController::class, 'download'])->name('download');

Route::get('/api/proxy/provinces', [ApiController::class, 'getProvinces']);
Route::get('/api/proxy/districts/{provinceId}', [ApiController::class, 'getDistricts']);
Route::get('/api/proxy/wards/{districtId}', [ApiController::class, 'getWards']);



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
Route::get('/jobs/detail/{id}', [JobsController::class, 'detail'])->name('jobDetail');
Route::get('/jobs/detail-employer/{id}', [JobsController::class, 'detail_employer'])->name('JobDetail_employer');
Route::post('/apply-job', [JobsController::class, 'applyJob'])->name('applyJob');
Route::post('/save-job', [JobsController::class, 'saveJob'])->name('saveJob');

Route::get('/download-cv/{cvPath}', [JobsController::class, 'downloadCv'])->name('download-cv');
Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->name('account.forgotPassword');
Route::post('/process-forgot-password', [AccountController::class, 'processForgotPassword'])->name('account.processForgotPassword');
Route::get('/reset-password/{token}', [AccountController::class, 'resetPassword'])->name('account.resetPassword');
Route::post('/process-reset-password', [AccountController::class, 'processResetPassword'])->name('account.processResetPassword');


Route::group(['prefix' => 'account'], function () {

  // Guest Route
  Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AccountController::class, 'registration'])->name('account.registration');
    Route::post('/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
  });

  // Authenticated Routes
  Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::post('/update-profile-pic', [AccountController::class, 'updateProfilePicture'])->name('account.updateProfilePicture');
    Route::get('/create-job', [AccountController::class, 'createJob'])->name('account.createJob');
    Route::post('/save-job', [AccountController::class, 'saveJob'])->name('account.saveJob');
    Route::get('/my-job', [AccountController::class, 'myJobs'])->name('account.myJobs');
    Route::get('/my-job/edit/{jobId}', [AccountController::class, 'editJob'])->name('account.editJob');
    Route::post('/update-job/{jobId}', [AccountController::class, 'updateJob'])->name('account.updateJob');
    Route::post('/delete-job', [AccountController::class, 'deleteJob'])->name('account.deleteJob');
    Route::get('/my-job-application', [AccountController::class, 'myJobApplication'])->name('account.myJobApplication');

    Route::post('/remove-job-application', [AccountController::class, 'removeJobs'])->name('account.removeJobs');
    Route::get('/saved-job', [AccountController::class, 'savedJobs'])->name('account.savedJobs');
    Route::post('/remove-saved-job', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');
    Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
  });
});
