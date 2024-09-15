<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // Show user registration page
    public function registration() {
        return view('front.account.registration');
    }

    // Save a user
    public function processRegistration(Request $request)
{
    $messages = [
        'name.required' => 'Trường name không được để trống.',
        'email.required' => 'Trường email không được để trống.',
        'email.email' => 'Email không hợp lệ.',
        'email.unique' => 'Email đã tồn tại.',
        'password.required' => 'Trường mật khẩu không được để trống.',
        'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        'password.same' => 'Mật khẩu xác nhận không khớp.',
        'confirm_password.required' => 'Trường xác nhận mật khẩu không được để trống.',
    ];

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:5|same:confirm_password',
        'confirm_password' => 'required',
    ], $messages);

    if ($validator->passes()) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success', 'Bạn đã đăng ký thành công.');

        return response()->json([
            'status' => true,
            'errors' => []
        ]);
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
}


    // Show user login page
    public function login() {
        return view('front.account.login');
    }

    public function authenticate(Request $request) {
        $messages = [
            'email.required' => 'Trường email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Trường mật khẩu không được để trống.',
        ];

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ],$messages);

        if ($validator->passes()) {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')->with('error','Email hoặc mật khẩu không chính xác');
            }

        } else {
            return redirect()->route('account.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }

    public function profile() {
        return view('front.account.profile');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
