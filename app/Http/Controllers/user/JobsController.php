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
use App\Models\JobApplication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{
  // Show find job page
  public function index(Request $request)
  {

    $careers = Careers::where('status', 1)->get();
    $jobTypes = JobType::where('status', 1)->get();

    $jobs = Job::where('status', 1);

    // Search using keyword
    if (!empty($request->keyword)) {
      $jobs = $jobs->where(function ($query) use ($request) {
        $query->orwhere('title', 'like', '%' . $request->keyword . '%');
        $query->orwhere('keywords', 'like', '%' . $request->keyword . '%');
      });
    }

    // Search using location
    if (!empty($request->location)) {
      $jobs = $jobs->where('company_location', $request->location);
    }

    // Search using careers
    if (!empty($request->career)) {
      $jobs = $jobs->where('career_id', $request->career);
    }

    $jobTypeArray = [];
    // Search using jobType
    if (!empty($request->jobType)) {
      $jobTypeArray = explode(',', $request->jobType);
      $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
    }

    // Search using experience
    if (!empty($request->experience)) {
      $jobs = $jobs->where('experience', $request->experience);
    }


    $jobs = $jobs->with(['jobType', 'career']);

    if ($request->sort == '0') {
      $jobs = $jobs->orderBy('created_at', 'ASC');
    } else {
      $jobs = $jobs->orderBy('created_at', 'DESC');
    }

    $jobs = $jobs->paginate(9);

    return view('front.jobs', [
      'careers' => $careers,
      'jobTypes' => $jobTypes,
      'jobs' => $jobs,
      'jobTypeArray' => $jobTypeArray,
    ]);
  }

  // Show job detail page
  public function detail($id)
  {


    $job = Job::where([
      'id' => $id,
      'status' => 1,
    ])->with(['jobType', 'career'])->first();

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
      // Kiểm tra xem người dùng đã nộp đơn xin việc chưa
      $userHasApplied = JobApplication::where([
        'user_id' => Auth::user()->id,
        'job_id' => $id
      ])->count();
    }

    // Fetch applications
    $applications = JobApplication::where('job_id', $id)->with('user')->get();



    return view('front.jobDetail', [
      'job' => $job,
      'count' => $count,
      'applications' => $applications,
      'userHasApplied' => $userHasApplied,
    ]);
  }

  public function detail_employer($id)
  {
    $job = Job::where([
      'id' => $id,
      'status' => 1,
    ])->with(['jobType', 'career'])->first();

    if ($job == null) {
      abort(404);
    }

    // Fetch applications
    $applications = JobApplication::where('job_id', $id)->with('user')->get();



    return view('front.jobDetail_employer', [
      'job' => $job,
      'applications' => $applications,
    ]);
  }

  public function applyJob(Request $request)
  {

    $rules = [
      'cv' => 'required|file|mimes:pdf,doc,docx', // CV phải là file .pdf, .doc, .docx và không quá 2MB
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

      // If job not found in db
      if ($job == null) {
        $message = "Không tìm thấy công việc";
        return response()->json([
          'status' => false,
          'message' => $message,
        ]);
      }

      // You can't apply on your own job
      $employer_id = $job->user_id;

      if ($employer_id == Auth::user()->id) {
        $message = "Bạn không thể nộp đơn vào công việc của riêng bạn";
        return response()->json([
          'status' => false,
          'message' => $message,
        ]);
      }

      // You can't apply on a job twice
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

      // Xử lý file CV (nếu được upload)
      if ($request->hasFile('cv')) {
        // Lấy file từ request
        $file = $request->file('cv');

        // Tạo tên file duy nhất, sử dụng email của người dùng và thời gian hiện tại
        $filename = Auth::user()->email . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Đường dẫn lưu file
        $destinationPath = public_path('/assets/user/CV');

        // Di chuyển file tới thư mục đã chỉ định
        $file->move($destinationPath, $filename);
      }


      $application = new JobApplication();
      $application->job_id = $id;
      $application->user_id = Auth::user()->id;
      $application->employer_id = $employer_id;
      $application->applied_date = now();
      $application->cv_path = $filename ?? null;
      $application->save();

      // Send Notification Email to Employer
      $employer = User::where('id', $employer_id)->first();

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

  public function saveJob(Request $request)
  {
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
    $filePath = storage_path('public/CV/' . $cvPath); // Đường dẫn tới file

    if (!file_exists($filePath)) {
      return session()->flash('toastr', ['error' => 'File không tồn tại']);
    }

    return Storage::download($filePath); // Tải file
  }
}
