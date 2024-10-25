<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
  public function __construct()
  {
    // Kiểm tra xem người dùng có phải là admin không
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
      if (Auth::user()->role !== 'admin') {
        return redirect()->route('account.profile');  // Hoặc trang khác nếu không phải admin
      }
      return $next($request);
    });
  }

  public function index()
  {
    $totalJobs = Job::count();
    $totalUsers = User::where('role', 'user')->count();
    $totalEmployers = User::where('role', 'employer')->count();
    $totalApplications = JobApplication::count();
    $totalSavedJobs = SavedJob::count();
    $totalCareers = Career::count();
    $featuredJobs = Job::where('isFeatured', 1)->take(5)->get();
    return view('admin.index', compact(
      'totalJobs',
      'totalUsers',
      'totalEmployers',
      'totalApplications',
      'totalSavedJobs',
      'totalCareers',
      'featuredJobs',
    ));
  }
}
