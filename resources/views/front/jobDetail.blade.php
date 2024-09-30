@extends('front.layouts.app')

@section('main')
<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
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
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $job->jobType->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now  {{ ($count == 1) ? 'saved-job' : '' }}">
                                    <a class="heart_mark" href="javascript:void(0);" onclick="saveJobHeart({{ $job->id }})"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
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
                            <h4>Trách nhiệm</h4>
                            @if (empty($job->responsibility))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->responsibility) !!}
                        </div>
                        <div class="single_wrap">
                            <h4>Trình độ chuyên môn</h4>
                            @if (empty($job->qualifications))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->qualifications) !!}
                        </div>
                        <div class="single_wrap">
                            <h4>Phúc lợi</h4>
                            @if (empty($job->benefits))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->benefits) !!}
                        </div>
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">

                            @if (Auth::check())
                                <a href="#" onclick="saveJob({{ $job->id }})" class="btn btn-secondary">Lưu công việc</a>
                            @else
                                <a href="javascript:void(0);" class="btn btn-secondary disabled">Đăng nhập để lưu công việc</a>
                            @endif
                            

                            @if (Auth::check())
                                <a href="#" onclick="applyJob({{ $job->id }})" class="btn btn-primary">Xin việc</a>
                            @else
                                <a href="javascript:void(0);" class="btn btn-primary disabled">Đăng nhập để xin việc</a>
                            @endif
                           


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Tóm tắt công việc</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Thời điểm đăng: <span>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</span></li>
                                <li>
                                    @if (empty($job->vacancy))
                                        Vị trí còn trống: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Vị trí còn trống: <span>{{ $job->vacancy }}</span>
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
                                    @if (empty($job->location))
                                        Nơi làm việc: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Nơi làm việc: <span>{{ $job->location }}</span>
                                    @endif
                                </li>
                                <li>
                                    @if (empty($job->jobType->name))
                                        Hình thức làm việc: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Hình thức làm việc: <span> {{ $job->jobType->name }}</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Chi tiết công ty</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Tên công ty: <span>{{ $job->company_name }}</span></li>
                                <li>
                                    @if (empty($job->company_location))
                                        Địa chỉ: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Địa chỉ: <span> {{ $job->company_location }}</span>
                                    @endif
                                </li>
                                <li>
                                    
                                    @if (empty($job->company_website))
                                        Webite: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Webite: <span><a href="{{ $job->company_website }}">{{ $job->company_website }}</a></span>
                                    @endif
                                </li>
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
<script type="text/javascript">
    function applyJob(id) {
        event.preventDefault();
        if (confirm("Bạn chắc chắn muốn xin công việc này?")) {
            $.ajax({
                url: '{{ route("applyJob") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    // Hiển thị Toastr dựa trên phản hồi
                    if (response.status === true) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error("Có lỗi xảy ra, vui lòng thử lại.");
                }
            });
        }
    }

    function saveJob(id) {
        event.preventDefault();
        $.ajax({
                url: '{{ route("saveJob") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    // Hiển thị Toastr dựa trên phản hồi
                    if (response.status === true) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error("Có lỗi xảy ra, vui lòng thử lại.");
                }
            });
    }

    function saveJobHeart(id) {
        event.preventDefault();
        $.ajax({
                url: '{{ route("saveJob") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    window.location.href = "{{ url()->current() }}";
                }
            });
    }
</script>
@endsection