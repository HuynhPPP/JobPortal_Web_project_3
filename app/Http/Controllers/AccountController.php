<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('front.account.profile', [
            'user' => $user,
        ]);
    }

    public function updateProfile(Request $request) {
        // Lấy thông tin người dùng hiện tại
        $id = Auth::user()->id;
        $currentEmail = Auth::user()->email;
    
        // Khởi tạo mảng quy tắc xác thực
        $rules = [
            'name' => 'required|min:5|max:20',
        ];
    
        // Nếu email mới khác email hiện tại, áp dụng quy tắc unique
        if ($request->email !== $currentEmail) {
            $rules['email'] = 'required|email|unique:users,email,' . $id . ',id';
        } else {
            $rules['email'] = 'required|email';
        }
    
        // Tùy chỉnh thông báo lỗi bằng tiếng Việt
        $messages = [
            'name.required' => 'Trường tên không được để trống.',
            'name.min' => 'Tên phải có ít nhất 5 ký tự.',
            'name.max' => 'Tên không được vượt quá 20 ký tự.',
            'email.required' => 'Trường email không được để trống.',
            'email.email' => 'Email phải đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
        ];
    
        // Tiến hành xác thực dữ liệu
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // Nếu xác thực thành công
        if ($validator->passes()) {
            // Tìm người dùng theo ID và cập nhật thông tin
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();
    
            // Đặt thông báo thành công và trả về JSON
            session()->flash('success', 'Cập nhật thành công.');
    
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
    
        } else {
            // Nếu xác thực thất bại, trả về lỗi
            session()->flash('error', 'Cập nhật không thành công! Có lỗi xảy ra.');
    
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    

    public function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function updateProfilePicture(Request $request) {
        // dd($request->all());

        $id = Auth::user()->id;

        $messages = [
            'image.required' => 'Vui lòng chọn ảnh để tải lên.',
            'image.image' => 'Định dạng tệp phải là một hình ảnh (jpeg, png, bmp, gif, hoặc svg).',
        ];
        
        $validator = Validator::make($request->all(),[
            'image' => 'required|image',
        ], $messages);
        

        if ($validator->passes()) {

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time().'.'.$ext; 
            $image->move(public_path('/profile_picture/'), $imageName);

            // Create a small thumbnail
            $sourcePath = public_path('/profile_picture/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);

            // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
            $image->cover(150, 150);
            $image->toPng()->save(public_path('/profile_picture/thumb/'.$imageName));

            // Delete Old Profile Pic
            File::delete(public_path('/profile_picture/thumb/'.Auth::user()->image));
            File::delete(public_path('/profile_picture/'.Auth::user()->image));

            User::where('id',$id)->update(['image' => $imageName]);

            session()->flash('success','Đăng ảnh đại diện thành công.');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function createJob() {

       $careers = Category::orderby('name', 'ASC')->where('status', 1)->get();

       $jobtype = JobType::orderby('name', 'ASC')->where('status', 1)->get();
        return view('front.account.job.create', [
            'careers' => $careers,
            'jobtypes' => $jobtype,
        ]);
    }

    public function saveJob(Request $request) {

        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'keywords' => 'required',
            'company_name' => 'required|min:3|max:75',
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống.',
            'title.min' => 'Tiêu đề phải có ít nhất 5 ký tự.',
            'title.max' => 'Tiêu đề không được dài hơn 200 ký tự.',
            'category.required' => 'Ngành nghề không được bỏ trống.',
            'jobType.required' => 'Loại công việc không được bỏ trống.',
            'vacancy.required' => 'Số lượng tuyển không được bỏ trống.',
            'vacancy.integer' => 'Số lượng tuyển phải là một số nguyên.',
            'location.required' => 'Địa điểm không được để trống.',
            'location.max' => 'Địa điểm không được dài hơn 50 ký tự.',
            'description.required' => 'Mô tả công việc không được để trống.',
            'keywords.required' => 'Từ khóa không được để trống.',
            'company_name.required' => 'Tên công ty không được để trống.',
            'company_name.min' => 'Tên công ty phải có ít nhất 3 ký tự.',
            'company_name.max' => 'Tên công ty không được dài hơn 75 ký tự.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $job = new Job();
            $job->title = $request->title;
            $job->category_id  = $request->category;
            $job->job_type_id  = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->save();

            session()->flash('success','Thêm việc làm thành công');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function myJobs() {

        $jobs = Job::where('user_id', Auth::user()->id)
                ->with('jobType')
                ->orderBy('created_at','DESC')
                ->paginate(10);

        return view('front.account.job.my-jobs', [
            'jobs' => $jobs,
        ]);
    }

    public function editJob(Request $request, $id) {

        $careers = Category::orderby('name', 'ASC')->where('status', 1)->get();
        $jobtype = JobType::orderby('name', 'ASC')->where('status', 1)->get();

        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id,
        ])->first();

        if ($job == null) {
            abort(404);
        }

        return view('front.account.job.edit', [
            'careers' => $careers,
            'jobtypes' => $jobtype,
            'job' => $job,
        ]);
    }

    public function updateJob(Request $request, $id) {

        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'keywords' => 'required',
            'company_name' => 'required|min:3|max:75',
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống.',
            'title.min' => 'Tiêu đề phải có ít nhất 5 ký tự.',
            'title.max' => 'Tiêu đề không được dài hơn 200 ký tự.',
            'category.required' => 'Ngành nghề không được bỏ trống.',
            'jobType.required' => 'Loại công việc không được bỏ trống.',
            'vacancy.required' => 'Số lượng tuyển không được bỏ trống.',
            'vacancy.integer' => 'Số lượng tuyển phải là một số nguyên.',
            'location.required' => 'Địa điểm không được để trống.',
            'location.max' => 'Địa điểm không được dài hơn 50 ký tự.',
            'description.required' => 'Mô tả công việc không được để trống.',
            'keywords.required' => 'Từ khóa không được để trống.',
            'company_name.required' => 'Tên công ty không được để trống.',
            'company_name.min' => 'Tên công ty phải có ít nhất 3 ký tự.',
            'company_name.max' => 'Tên công ty không được dài hơn 75 ký tự.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $job = Job::find($id);
            $job->title = $request->title;
            $job->category_id  = $request->category;
            $job->job_type_id  = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->save();

            session()->flash('success','Việc làm đã được lưu');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function deleteJob(Request $request) {

        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $request->jobId,
        ])->first();

        if ($job == null) {
            session()->flash('error','Công việc không tìm thấy hoặc đã bị xoá');
            return response()->json([
                'status' => true,
            ]);
        }

        Job::where('id',$request->jobId)->delete();
        session()->flash('success','Xoá thành công');
        return response()->json([
            'status' => true,
        ]);
    }
}
