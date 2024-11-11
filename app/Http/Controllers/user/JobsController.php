<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use App\Mail\JobNotificationEmail;
use Illuminate\Http\Request;
use App\Models\Careers;
use App\Models\JobType;
use App\Models\Job;
use App\Models\SavedJob;
use App\Models\User;
use App\Models\NotificationUser;
use App\Models\NotificationEmployer;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{
    
    public function index(Request $request) {

        $careers = Careers::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();

        $jobs = Job::where('status', 1);

        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function($query) use ($request) {
                $query->orwhere('title','like','%'.$request->keyword.'%');
                $query->orwhere('keywords','like','%'.$request->keyword.'%');
            });
        }

        if (!empty($request->province)) {
            $jobs = $jobs->where('province',$request->province);
        }

        if (!empty($request->career)) {
            $jobs = $jobs->where('career_id',$request->career);
        }

        $jobTypeArray = [];
        if (!empty($request->jobType)) {
            $jobTypeArray = explode(',',$request->jobType);
            $jobs = $jobs->whereIn('job_type_id',$jobTypeArray);
        }

        if (!empty($request->experience)) {
            $jobs = $jobs->where('experience',$request->experience);
        }


        $jobs = $jobs->with(['jobType','career']);

        if($request->sort == '0') {
            $jobs = $jobs->orderBy('created_at','ASC');
        } else {
            $jobs = $jobs->orderBy('created_at','DESC');
        }

        $jobs = $jobs->paginate(9);

        return view('front.jobs', [
            'careers' => $careers,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs,
            'jobTypeArray' => $jobTypeArray,
        ]);
    }

   
    public function detail($id) {
        

        $job = Job::where([
            'id' => $id, 
            'status' => 1,
        ])->with(['jobType','career','user'])->first();

        if ($job == null) {
            abort(404);
        }

        $count = 0; 
        if (Auth::check()) {
            $count = SavedJob::where([
                'user_id' => Auth::user()->id,
                'job_id' => $id,
            ])->count();
        }

        $userHasApplied = false;  
        if (Auth::check()) {
            $userHasApplied = JobApplication::where([
                'user_id' => Auth::user()->id,
                'job_id' => $id
            ])->count();
        }

        $applications = JobApplication::where('job_id',$id)->with('user')->get();

        

        return view('front.jobDetail',[
            'job' => $job,
            'count' => $count,
            'applications' => $applications,
            'userHasApplied' => $userHasApplied,
        ]);
    }

    public function detail_employer($id) {
        $job = Job::where([
            'id' => $id, 
        ])->with(['jobType','career'])->first();

        if ($job == null) {
            abort(404);
        }

        $applicationCount = JobApplication::where('job_id', $id)->count();

        $isApplicationFull = $applicationCount == $job->vacancy;

        $applications = JobApplication::where('job_id',$id)->with('user')->get();

        

        return view('front.jobDetail_employer',[
            'job' => $job,
            'applications' => $applications,
            'isApplicationFull' => $isApplicationFull,
        ]);
    }

    public function applyJob(Request $request) {

        $rules = [
            'cv' => 'required|file|mimes:pdf,doc,docx',
        ];
        
        $messages = [
            'cv.required' => 'Bạn phải nộp CV.',
            'cv.file' => 'CV phải là một tệp tin hợp lệ.',
            'cv.mimes' => 'CV phải có định dạng .pdf, .doc hoặc .docx.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $id = $request->id;
        
            $job = Job::where('id', $id)->first();
        
            
            if ($job == null) {
                $message = "Không tìm thấy công việc";
                return response()->json([
                    'status' => false,
                    'message' => $message,
                ]);
            }
        
            
            $employer_id = $job->user_id;
        
            if ($employer_id == Auth::user()->id) {
                $message = "Bạn không thể nộp đơn vào công việc của riêng bạn";
                return response()->json([
                    'status' => false,
                    'message' => $message,
                ]);
            }
        
            
            $jobApplicationCount = JobApplication::where([
                'user_id' => Auth::user()->id,
                'job_id' => $id
            ])->count();
        
            if ($jobApplicationCount > 0) {
                $message = "Bạn đã nộp đơn công việc này";
                return response()->json([
                    'status' => false,
                    'message' => $message,
                ]);
            }

            if ($request->hasFile('cv')) {          
                $file = $request->file('cv');          
                $filename = Auth::user()->email . '_' . time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('/assets/user/CV'); 
                $file->move($destinationPath, $filename);
            }

            $application = new JobApplication();
            $application->job_id = $id;
            $application->user_id = Auth::user()->id;
            $application->employer_id = $employer_id;
            $application->applied_date = now();
            $application->cv_path = $filename ?? null;
            $application->status = "0";
            $application->save();

            NotificationEmployer::create([
                'employer_id' => $employer_id,
                'job_notification_id' => $id,
                'user_id' => Auth::user()->id,
                'type' => 'applied',
            ]);
            
            $employer = User::where('id',$employer_id)->first();
            $mailData = [
                'employer' => $employer,
                'user' => Auth::user(),
                'job' => $job,
            ];
            Mail::to($employer->email)->send(new JobNotificationEmail($mailData));
        
            $message = "Nộp đơn thành công";
        
            return response()->json([
                'status' => true,
                'message' => $message,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function saveJob(Request $request) {
        if (!Auth::check()) {
            $message = "Bạn cần đăng nhập để thực hiện chức năng này.";
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        $id = $request->id;

        $job = Job::find($id);

        if ($job == null) {
            $message = "Không tìm thấy công việc";
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        // Check if user already saved the job
        $savedJob = SavedJob::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id,
        ])->first();

        if ($savedJob) {
            // Nếu đã lưu thì xóa công việc khỏi danh sách yêu thích
            $savedJob->delete();
            $message = "Đã hủy yêu thích";
            return response()->json([
                'status' => true,
                'action' => 'unsaved',
                'message' => $message,
            ]);
        } else {
            // Nếu chưa lưu thì thêm vào danh sách yêu thích
            $newSavedJob = new SavedJob;
            $newSavedJob->job_id = $id;
            $newSavedJob->user_id = Auth::user()->id;
            $newSavedJob->save();

            $message = "Đã thêm vào mục công việc yêu thích";
            return response()->json([
                'status' => true,
                'action' => 'saved',
                'message' => $message,
            ]);
        }
    }

    public function downloadCv($cvPath)
    {
        $file = public_path('assets/user/CV/'.$cvPath);

        if (!file_exists($file)) {
            return session()->flash('toastr', ['error' => 'File không tồn tại']);
        }

        return response()->download($file);
    }

    public function processApplication(Request $request)
    {
        $application = JobApplication::find($request->id);

        if ($application) {
            // Xử lý phê duyệt/hủy phê duyệt
            if ($request->has('approval_status')) {
                if ($request->approval_status == 1) {
                    $application->status = 1;
                    $type = 'approved';
                } else {
                    $application->status = 0;
                    $type = 'rejected';
                }

                \DB::table('notifications_user')->insert([
                    'user_id' => $application->user_id, 
                    'job_notification_id' => $application->id,
                    'type' => $type, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }

            if ($request->has('message')) {
                $application->message = $request->message;
            }

            $application->save();

            return redirect()->route('JobDetail_employer', ['id' => $application->job_id])
                            ->with('toastr', ['success' => 'Thông báo đã được gửi đi']);
        }

        return redirect()->route('JobDetail_employer', ['id' => $request->job_id])
                        ->with('toastr', ['error' => 'Có lỗi xảy ra, hãy thử lại!']);
    }

    public function destroy($id)
    {
        $notification = NotificationUser::find($id);
        if ($notification && $notification->user_id == auth()->id()) {
            $notification->delete();
            return redirect()->back();
        }
        return redirect()->back()->with('toastr', ['error' => 'Có lỗi xảy ra. Vui lòng thử lại.']);
    }

    public function delete_notification_Employer($id)
    {
        $notification = NotificationEmployer::find($id);
        if ($notification && $notification->user_id == auth()->id()) {
            $notification->delete();
            return redirect()->back();
        }
        return redirect()->back()->with('toastr', ['error' => 'Có lỗi xảy ra. Vui lòng thử lại.']);
    } 
}
