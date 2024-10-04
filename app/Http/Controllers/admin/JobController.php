<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
  public function index()
  {
    $jobs = Job::orderBy('created_at', 'DESC')->with('career')->paginate(7);
    return view('admin.job.list', compact('jobs'));
  }
}
