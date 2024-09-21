<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view('admin.index');
  }
  public function getCareer()
  {
    $careers = Career::orderBy('created_at', 'DESC')->paginate(3);
    return view('admin.career.list', compact('careers'));
  }
  public function getJob()
  {
    return view('admin.job.list');
  }
  public function getUser()
  {
    return view('admin.user.list');
  }
  public function getEmployer()
  {
    return view('admin.employer.list');
  }
}
