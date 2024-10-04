<?php

namespace App\Http\Controllers;

use App\Models\Careers;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Show Home Page
    public function index() {

        $categories = Careers::where('status', 1)->orderBy('name','ASC')->take(8)->get();

        $newCategories = Careers::where('status', 1)->orderBy('name','ASC')->get();

        $featureJobs = Job::where('status', 1)
                       ->orderBy('created_at','DESC')
                       ->with('jobType')
                       ->where('isFeatured',1)->take(6)->get();

        $latesJobs = Job::where('status', 1)
                     ->with('jobType')
                     ->orderBy('created_at','DESC')
                     ->take(6)->get();

        return view('front.home', [
            'categories' => $categories,
            'featureJobs' => $featureJobs,
            'latesJobs' => $latesJobs,
            'newCategories' => $newCategories,
        ]);
    }
}
