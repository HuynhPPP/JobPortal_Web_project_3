@extends('front.layouts.app')

@section('main')
<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0 fs-5">
                        <li class="breadcrumb-item"><a href="{{ route("jobs") }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Quay lại trang tìm việc</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                @include('front.message')
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $job->title }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location d-flex align-items-center">
                                            <i class="fa fa-map-marker" style="margin-right: 7px"></i> 
                                            @if (!empty($job->province) && !empty($job->district))
                                                <p>{{ $job->district }}, {{ $job->province }}</p>
                                            @else
                                                <p style="color: red">Chưa cập nhật</p>
                                            @endif
                                        </div>
                                        <div class="location d-flex align-items-center">
                                            <i class="fa fa-calendar-times-o" aria-hidden="true" style="margin-right: 7px"></i> 
                                            <p>{{ $job->jobType->name }}</p>
                                        </div>
                                        <div class="location d-flex align-items-center">
                                            <i class="fa fa-clock-o" style="margin-right: 7px"></i> 
                                            <p>{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Mô tả công việc</h4>
                            @if (empty($job->description))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->description) !!}
                            
                        </div>
                        <div class="single_wrap">
                            <h4>Trách nhiệm công việc</h4>
                            @if (empty($job->responsibility))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->responsibility) !!}
                        </div>
                        <div class="single_wrap">
                            <h4>Kỹ năng & Chuyên môn</h4>
                            @if (empty($job->qualifications))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->qualifications) !!}
                        </div>
                        <div class="single_wrap">
                            <h4>Phúc lợi dành cho bạn</h4>
                            @if (empty($job->benefits))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->benefits) !!}
                        </div>          
                    </div>
                </div>

                @if (Auth::user())
                    @if (Auth::user()->id == $job->user_id)
                        <div class="card shadow border-0 mt-4">
                            <div class="job_details_header">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        
                                        <div class="jobs_conetent">
                                            
                                                <h4>Danh sách các ứng viên ứng tuyển</h4>
                                                @if($isApplicationFull)
                                                    <p class="text-danger">Công việc này đã đủ số lượng ứng viên !</p>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="jobs_right"></div>
                                </div>
                            </div>
                            <div class="descript_wrap white-bg">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày ứng tuyển</th>
                                        <th>CV</th>
                                    </tr>
                                    @if ($applications->isNotEmpty())
                                        @foreach ($applications as $application)
                                            <tr>
                                                <td>{{ $application->user->fullname }}</td>
                                                <td>{{ $application->user->email }}</td>
                                                <td>{{ $application->user->mobile }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('download-cv', $application->cv_path) }}" class="btn btn-primary">Tải CV</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" ><p class="text-danger">Chưa có ứng viên</p></td>
                                            </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Thông tin chung</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Thời điểm đăng: <span>{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span></li>
                                <li>
                                    @if (empty($job->job_level))
                                        Cấp bậc: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Cấp bậc: <span>{{ $job->job_level }}</span>
                                    @endif
                                </li>
                                <li>
                                    @if (empty($job->salary))
                                        Mức lương: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Mức lương: <span>{{ $job->salary }}</span>
                                    @endif
                                </li>
                                <li>
                                    @if (empty($job->experience))
                                        Năm kinh nghiệm tối thiểu: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Năm kinh nghiệm tối thiểu: <span>{{ $job->experience }} năm</span>
                                    @endif
                                </li>
                                <li>
                                    @if (empty($job->jobType->name))
                                        Hình thức làm việc: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Hình thức làm việc: <span> {{ $job->jobType->name }}</span>
                                    @endif
                                </li>
                                <li>
                                    @if (empty($job->keywords))
                                        Từ khoá: <span style="color: red">chưa cập nhật</span>
                                    @else
                                    <div class="keywords-section-detail">
                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            @php
                                                $keywords = explode(',', $job->keywords);
                                            @endphp
                                            Từ khoá: 
                                            @foreach ($keywords as $index => $keyword)
                                                    <a href="{{ route('jobs', ['keyword' => trim($keyword)]) }}" class="keyword-badge-detail">{{ trim($keyword) }}</a>
                                                    
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Thông tin chi tiết công ty</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Tên công ty: <span>{{ $job->company_name }}</span></li>
                                <li>
                                    @if (!empty($job->location_detail))
                                        Địa chỉ: <span>{{ $job->location_detail }}</span>
                                    @elseif (!empty($job->district) && !empty($job->district))
                                        Địa chỉ: <span> {{ $job->district }}, {{ $job->province }}</span>
                                    @else
                                        Địa chỉ: <span>{{ $job->location_detail }}</span>
                                    @endif
                                </li>
                                <li>
                                    @if (empty($job->company_website))
                                        Webite: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Webite: <span><a href="{{ $job->company_website }}">{{ $job->company_website }}</a></span>
                                    @endif
                                </li>
                                <li>Nhà tuyển dụng: <span>{{ $job->user->fullname }}</span></li>
                                <li>Email liên hệ: <span>{{ $job->user->email }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('customJs')

@endsection