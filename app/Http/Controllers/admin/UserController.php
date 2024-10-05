<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function getUser()
  {
    $users = User::where('role', 'user')->orderBy('name', 'ASC')->paginate(5);
    return view('admin.user.list', compact('users'));
  }
}
