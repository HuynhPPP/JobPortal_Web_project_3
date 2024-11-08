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
                                            <i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 7px"></i> 
                                            <p>{{ $job->jobType->name }}</p>
                                        </div>
                                    </div>
                                    <div class="links_locat d-flex align-items-center mt-3">
                                        <div class="location d-flex align-items-center">
                                            <i class="fa fa-calendar" style="margin-right: 7px"></i>
                                            <p>
                                                Ngày đăng tuyển: {{ \Carbon\Carbon::parse($job->created_at)->format('d-m-Y') }} 
                                                @if ($job->expiration_date)
                                                    @php
                                                        $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($job->expiration_date), false);
                                                        if ($daysLeft < 1) {
                                                            $daysLeft = 1;
                                                        }
                                                        $textColor = '';
                                                        if ($daysLeft < 3) {
                                                            $textColor = 'color: red;';
                                                        } elseif ($daysLeft < 10) {
                                                            $textColor = 'color: yellow;';
                                                        }
                                                    @endphp
                                                    @if ($daysLeft >= 0)
                                                        - <span>Hết hạn trong: <span style="{{ $textColor }}">{{ $daysLeft }} ngày tới</span></span>
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="javascript:void(0);" onclick="saveJobHeart({{ $job->id }}, this)">
                                        <i class="fa {{ ($count == 1) ? 'fa-heart' : 'fa-heart-o' }}" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4 style="color: #a8df8e">Mô tả công việc</h4>
                            @if (empty($job->description))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->description) !!}
                            
                        </div>
                        <div class="single_wrap">
                            <h4 style="color: #a8df8e">Trách nhiệm công việc</h4>
                            @if (empty($job->responsibility))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->responsibility) !!}
                        </div>
                        <div class="single_wrap">
                            <h4 style="color: #a8df8e">Kỹ năng & Chuyên môn</h4>
                            @if (empty($job->qualifications))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->qualifications) !!}
                        </div>
                        <div class="single_wrap">
                            <h4 style="color: #a8df8e">Phúc lợi dành cho bạn</h4>
                            @if (empty($job->benefits))
                                <p>Chưa có thông tin</p>
                            @endif
                            {!! nl2br($job->benefits) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Employer -->
                @if (Auth::check() && Auth::user()->role === 'employer')
                    <div class="pt-3">
                    </div>
                @endif

                <!-- User -->
                @if (Auth::check() && Auth::user()->role === 'user')
                    <div class="pt-3">
                        <a href="#" 
                            onclick="applyJob({{ $job->id }})" 
                            class="btn btn-primary w-100 fs-5 {{ ($userHasApplied == 1) ? 'disabled' : '' }}">
                            {{ ($userHasApplied == 1) ? 'Bạn đã nộp đơn cho công việc này' : 'Xin việc ngay'}}
                        </a>
                    </div>
                @else
                    <div class="pt-3">
                        <a href="{{ route("account.login") }}" class="btn btn-primary">Đăng nhập để xin việc</a>       
                    </div>
                @endif
                <div class="card shadow border-0 my-4">
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
                                        Mức lương: <span style="color: #0069DB ">{{ $job->salary }}</span>
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
                                        Webite: <span><a href="{{ $job->company_website }}" style="color: #0069DB">{{ $job->company_website }}</a></span>
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

@if (Auth::check() && Auth::user()->role === 'user')
<div class="modal fade" id="applyJobModal" tabindex="-1" aria-labelledby="applyJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyJobModalLabel">Bạn đang ứng tuyển tại công ty {{ $job->company_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form id="applyJobForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ $job->id }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->fullname }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        @if (Auth::user()->mobile)
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->mobile }}" readonly>
                        @else
                            <input type="text" class="form-control text-danger" id="phone" name="phone" value="Bạn chưa cập nhật số điện thoại" readonly>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="cv" class="form-label">Nộp CV</label>
                        <input type="file" class="form-control" id="cv" name="cv" required>
                        <p></p>
                    </div>
                </form>
            </div>
            
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="submitApplication({{ $job->id }})">Nộp đơn</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Notification -->
<div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255, 255, 255, 0.7); z-index:9999; text-align:center;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="spinner-border" role="status">
            <span class="sr-only">Đang xử lý...</span>
        </div>
        <p>Đang xử lý, vui lòng đợi...</p>
    </div>
</div>

@endsection

@section('customJs')
<script type="text/javascript">
    function applyJob(id) {
        event.preventDefault();
        $('#applyJobModal').modal('show');
    }

    function submitApplication(id) {
        event.preventDefault();
        var formData = new FormData($('#applyJobForm')[0]);
        formData.append('id', id);

        $('#loading-overlay').show();

        $.ajax({
            url: '{{ route("applyJob") }}',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                $('#loading-overlay').hide();

                toastr.clear();

                if (response.status === true) {
                    $("#cv").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                            
                    toastr.success(response.message);
                    $('#applyJobModal').modal('hide');

                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    var errors = response.errors;
                    toastr.warning('Có lỗi xảy ra...');

                    if (errors.cv) {
                        $("#cv").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.cv);
                    } else {
                        $("#cv").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }
                }
            },
            error: function() {
                $('#loading-overlay').hide();
                toastr.clear();
                toastr.error('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
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

    function saveJobHeart(id, element) {
        event.preventDefault();
        $.ajax({
                url: '{{ route("saveJob") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    if (response.status === false) {
                        toastr.error(response.message);
                    } else {
                        if (response.action === 'saved') {
                            $(element).find('i').removeClass('fa-heart-o').addClass('fa-heart'); 
                            toastr.success('Đã thêm vào yêu thích');
                        } else {
                            $(element).find('i').removeClass('fa-heart').addClass('fa-heart-o'); 
                            toastr.warning('Đã hủy yêu thích');
                        }
                    }
                }
            });
    }
</script>
@endsection