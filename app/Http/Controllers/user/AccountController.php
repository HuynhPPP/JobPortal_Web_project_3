<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Careers;
use App\Models\JobType;
use App\Models\JobApplication;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class AccountController extends Controller
{
    public function registration() {
        return view('front.account.registration');
    }

    public function processRegistration(Request $request){
        $request->merge([
            'name' => preg_replace('/\s+/', ' ', trim($request->input('name'))),
        ]);

        $messages = [
            'name.required' => 'Trường họ và tên không được để trống.',
            'name.min' => 'Tên người dùng phải chứa ít nhất 6 ký tự.',
            'name.max' => 'Tên người dùng chỉ chứa tối đa 18 ký tự.',
            'name.regex' => 'Tên người dùng không hợp lệ.',
            'email.required' => 'Trường email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã được đăng ký.',
            'password.required' => 'Trường mật khẩu không được để trống.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 6 ký tự, có ít nhất 1 chữ cái in hoa, 1 số, và 1 ký tự đặc biệt.',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp.',
            'confirm_password.required' => 'Trường xác nhận mật khẩu không được để trống.',
        ];
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6|max:18|regex:/^(?!\s)(?!.*\s{2,})(?<!\s)/',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'regex:/^(?!.*\s)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/'
            ],
            'confirm_password' => 'required|same:password',
        ], $messages);

        if ($validator->passes()) {
            $user = new User();
            $user->fullname = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->input('role', 'user');
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
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                if ($user->role === 'admin') {
                    // Nếu là admin, chuyển hướng đến trang admin
                    return redirect()->route('admin.dashboard');
                } else
                    session()->flash('toastr', ['success' => 'Chào mừng bạn đến với website tìm kiếm việc làm']);
                    // toastr()->success('Chào mừng bạn đến với website tìm kiếm việc làm');
                    return redirect()->route('account.profile');
            } else {
                session()->flash('toastr', ['error' => 'Email hoặc mật khẩu không chính xác']);
                return redirect()->route('account.login');
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

        $id = Auth::user()->id;
        $currentEmail = Auth::user()->email;
        $currentMobile = Auth::user()->mobile;

        $request->merge([
            'name' => preg_replace('/\s+/', ' ', trim($request->input('name'))),
        ]);
    
        $rules = [
            'name.required' => 'Trường họ và tên không được để trống.',
            'name.min' => 'Tên người dùng phải chứa ít nhất 6 ký tự.',
            'name.max' => 'Tên người dùng chỉ chứa tối đa 18 ký tự.',
            'name.regex' => 'Tên người dùng không hợp lệ.',
        ];
    
        
        if ($request->email !== $currentEmail) {
            $rules['email'] = 'required|email|unique:users,email,' . $id . ',id';
        } else {
            $rules['email'] = 'required|email';
        }

        if ($request->mobile !== $currentMobile) {
            $rules['mobile'] = 'numeric|unique:users,mobile,' . $id . ',id';
        } else {
            $rules['mobile'] = 'numeric';
        }
    
        $messages = [
            'name.required' => 'Trường họ và tên không được để trống.',
            'name.min' => 'Tên người dùng phải chứa ít nhất 6 ký tự.',
            'name.max' => 'Tên người dùng chỉ chứa tối đa 18 ký tự.',
            'name.regex' => 'Tên người dùng không hợp lệ.',
            'email.required' => 'Trường email không được để trống.',
            'email.email' => 'Email phải đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
            'mobile.numeric' => 'Số điện thoại phải là số.',
            'mobile.unique' => 'Số điện thoại này đã được sử dụng.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->passes()) {
            $user = User::find($id);
            $user->fullname = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();
    
            session()->flash('toastr', ['success' => 'Cập nhật thành công']);
    
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
    
        } else {
            session()->flash('toastr', value: ['warning' => 'Cập nhật chưa được thay đổi !']);
    
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

            $profilePicturePath = public_path('/assets/user/profile_picture/');
            $thumbPath = public_path('/assets/user/profile_picture/thumb/');

             $image->move($profilePicturePath, $imageName);

            // Create a small thumbnail
            $sourcePath = public_path('/assets/user/profile_picture/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);

            // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
            $image->cover(150, 150);
            $image->toPng()->save($thumbPath . $imageName);

            // Delete Old Profile Pic
            File::delete(public_path('/assets/user/profile_picture/thumb/'.Auth::user()->image));
            File::delete(public_path('/assets/user/profile_picture/'.Auth::user()->image));

            User::where('id',$id)->update(['image' => $imageName]);

            session()->flash('toastr', ['success' => 'Đăng ảnh đại diện thành công']);
            // session()->flash('success','Đăng ảnh đại diện thành công.');

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

       $careers = Careers::orderby('name', 'ASC')->where('status', 1)->get();

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
            'level' => 'required|max:50',
            'description' => 'required',
            'keywords' => 'required',
            'company_name' => 'required|min:3|max:75',
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống.',
            'title.min' => 'Tiêu đề phải có ít nhất 5 ký tự.',
            'title.max' => 'Tiêu đề không được dài hơn 200 ký tự.',
            'category.required' => 'Ngành nghề không được bỏ trống.',
            'jobType.required' => 'hình thức làm việc không được bỏ trống.',
            'vacancy.required' => 'Số lượng tuyển không được bỏ trống.',
            'vacancy.integer' => 'Số lượng tuyển phải là một số nguyên.',
            'level.required' => 'Vị trí cần tuyển không được để trống.',
            'level.max' => 'Vị trí cần tuyển không được dài hơn 50 ký tự.',
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
            $job->career_id   = $request->category;
            $job->job_type_id  = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->job_level = $request->level;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->status = "0";
            $job->save();

            session()->flash('toastr', ['success' => 'Thêm việc làm thành công']);
            // session()->flash('success','Thêm việc làm thành công');

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

        $careers = Careers::orderby('name', 'ASC')->where('status', 1)->get();
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
            'level' => 'required|max:50',
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
            'level.required' => 'Vị trí cần tuyển không được để trống.',
            'level.max' => 'Vị trí cần tuyển không được dài hơn 50 ký tự.',
            'keywords.required' => 'Từ khóa không được để trống.',
            'company_name.required' => 'Tên công ty không được để trống.',
            'company_name.min' => 'Tên công ty phải có ít nhất 3 ký tự.',
            'company_name.max' => 'Tên công ty không được dài hơn 75 ký tự.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $job = Job::find($id);
            $job->title = $request->title;
            $job->career_id  = $request->category;
            $job->job_type_id  = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->job_level = $request->level;
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


            session()->flash('toastr', ['success' => 'Việc làm đã được lưu']);
            // session()->flash('success','Việc làm đã được lưu');

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
            session()->flash('toastr', ['error' => 'Công việc không tìm thấy hoặc đã bị xoá']);
            return response()->json([
                'status' => true,
            ]);
        }

        Job::where('id',$request->jobId)->delete();

        session()->flash('toastr', ['success' => 'Xoá thành công']);
        return response()->json([
            'status' => true,
        ]);
    }

    public function myJobApplication(Request $request) {
        $jobApplicationsQuery = JobApplication::where('user_id', Auth::user()->id)
                            ->with(['job', 'job.jobType', 'job.applications'])
                            ->orderBy('created_at', 'DESC');
                            
        // Nếu người dùng nhập từ khóa tìm kiếm
        if (!empty($request->keyword)) {
            // Kết hợp với bảng jobs để tìm theo tiêu đề công việc
            $jobApplicationsQuery->whereHas('job', function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->keyword . '%');
            });
        }
            
        $jobApplications = $jobApplicationsQuery->paginate(10);
        
        return view('front.account.job.my-job-application', [
            'jobApplications' => $jobApplications
        ]);
    }
    

    public function removeJobs(Request $request) {
        $jobApplication = JobApplication::where([
                'id' => $request->id, 
                'user_id' => Auth::user()->id
            ])->first();
    
        if ($jobApplication == null) {
            return redirect()->route('account.myJobApplication')->with('toastr', ['error' => 'Không tìm thấy công việc']);
        }
    
        $jobApplication->delete();
        return redirect()->route('account.myJobApplication')->with('toastr', ['success' => 'Huỷ ứng tuyển công việc thành công']);
    }
    

    public function savedJobs(Request $request) {
        // $jobApplications = JobApplication::where('user_id', Auth::user()->id)
        //                 ->with(['job','job.jobType','job.applications'])
        //                 ->paginate(10);

        $savedJobsQuery = SavedJob::where('user_id', Auth::user()->id)
                        ->with(['job', 'job.jobType', 'job.applications'])
                        ->orderBy('created_at', 'DESC');
    
        // Nếu người dùng nhập từ khóa tìm kiếm
        if (!empty($request->keyword)) {
            // Kết hợp với bảng jobs để tìm theo tiêu đề công việc
            $savedJobsQuery->whereHas('job', function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->keyword . '%');
            });
        }
        
        // Phân trang kết quả tìm kiếm
        $savedJobs = $savedJobsQuery->paginate(8);
        
        // Trả về view với kết quả tìm kiếm
        return view('front.account.job.saved-jobs', [
            'savedJobs' => $savedJobs,
        ]);
    }

    public function removeSavedJob(Request $request) {
        $savedJob = SavedJob::where([
                'id' => $request->id, 
                'user_id' => Auth::user()->id] 
            )->first();
        if ($savedJob == null) {
            return redirect()->route('account.savedJobs')->with('toastr', ['error' => 'Không tìm thấy công việc']);
        }
    
        $savedJob->delete();
        return redirect()->route('account.savedJobs')->with('toastr', ['success' => 'Huỷ yêu thích công việc thành công']);
    }

    public function updatePassword(Request $request) {
        $rules = [
            'old_password' => 'required',
            'new_password' => [
                'required',
                'regex:/^(?!.*\s)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/'
            ],
            'confirm_password' => 'required|same:new_password',
        ];
        
        $messages = [
            'old_password.required' => 'Bạn chưa nhập mật khẩu cũ.',
            'new_password.required' => 'Bạn chưa nhập mật khẩu mới.',
            'new_password.regex' => 'Mật khẩu phải tối thiểu 6 ký tự và chứa ít nhất 1 chữ cái in hoa, 1 số, và 1 ký tự đặc biệt.',
            'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu mới.',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp với mật khẩu mới.',
        ];
        
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        if (Hash::check($request->old_password,Auth::user()->password) == false) {
            session()->flash('toastr', ['error' => 'Mật khẩu cũ không chính xác.']);
            return response()->json([
                'status' => true,
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        session()->flash('toastr', ['success' => 'Đổi mật khẩu thành công.']);
            return response()->json([
                'status' => true,
            ]);
    }
}
