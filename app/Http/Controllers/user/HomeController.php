<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Careers;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  // Show Home Page
  public function index()
  {

    $careers = Careers::where('status', 1)->orderBy('name', 'ASC')->take(8)->get();

    $newCareers = Careers::where('status', 1)->orderBy('name', 'ASC')->get();

    $featureJobs = Job::where('status', 1)
      ->orderBy('created_at', 'DESC')
      ->with('jobType')
      ->where('isFeatured', 1)->take(6)->get();

    $latesJobs = Job::where('status', 1)
      ->with('jobType')
      ->orderBy('created_at', 'DESC')
      ->take(6)->get();

    return view('front.home', [
      'careers' => $careers,
      'featureJobs' => $featureJobs,
      'latesJobs' => $latesJobs,
      'newCareers' => $newCareers,
    ]);
  }
}
