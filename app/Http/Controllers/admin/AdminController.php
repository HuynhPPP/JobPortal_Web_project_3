<?php

namespace App\Http\Controllers\admin;

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

    public function AdminDashboard()
    {
        return view('admin.AdminPage');
    }

}
