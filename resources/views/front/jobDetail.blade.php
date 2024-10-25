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
                                            <p> <i class="fa fa-map-marker"></i> {{ $job->company_location }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $job->jobType->name }}</p>
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
                        <div class="border-bottom"></div>
                        
                        <!-- Employer -->
                        @if (Auth::check() && Auth::user()->role === 'employer')
                            <div class="pt-3 text-end">
                            </div>
                        @endif

                        <!-- User -->
                        @if (Auth::check() && Auth::user()->role === 'user')
                            <div class="pt-3 text-end">
                                
                                    {{-- <a href="#" 
                                        onclick="saveJob({{ $job->id }})" 
                                        class="btn btn-secondary {{ ($count == 1) ? 'disabled' : '' }}">
                                        {{ ($count == 1) ? 'Bạn đã lưu công việc này' : 'Lưu công việc' }}
                                    </a> --}}
                                
                                    <a href="#" 
                                        onclick="applyJob({{ $job->id }})" 
                                        class="btn btn-primary {{ ($userHasApplied == 1) ? 'disabled' : '' }}">
                                        {{ ($userHasApplied == 1) ? 'Bạn đã nộp đơn cho công việc này' : 'Xin việc'}}
                                    </a>
                               
                            </div>
                        @else
                            <div class="pt-3 text-end">
                                <a href="{{ route("account.login") }}" class="btn btn-primary">Đăng nhập để xin việc</a>       
                            </div>
                        @endif
                    </div>
                </div>

                @if (Auth::user())
                    @if (Auth::user()->id == $job->user_id)
                        <div class="card shadow border-0 mt-4">
                            <div class="job_details_header">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        
                                        <div class="jobs_conetent">
                                            <a href="#">
                                                <h4>Danh sách các ứng viên ứng tuyển</h4>
                                            </a>
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
                                                <td colspan="4">Chưa có ứng viên</td>
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
                                        Các công nghệ sử dụng: <span style="color: red">chưa cập nhật</span>
                                    @else
                                        Các công nghệ sử dụng: <a href="{{ route("jobs").'?keyword='.$job->keywords }}"> {{ $job->keywords }}</a>
                                    @endif
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

@if (Auth::check() && Auth::user()->role === 'user')
<!-- Bootstrap Modal -->
<div class="modal fade" id="applyJobModal" tabindex="-1" aria-labelledby="applyJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="applyJobModalLabel">Bạn đang ứng tuyển tại công ty {{ $job->company_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body: Form -->
            <div class="modal-body">
                <form id="applyJobForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ $job->id }}">
                    @csrf
                    <!-- Họ tên -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->fullname }}" readonly>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                    </div>
                    <!-- Số điện thoại -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        @if (Auth::user()->mobile)
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->mobile }}" readonly>
                        @else
                            <input type="text" class="form-control text-danger" id="phone" name="phone" value="Bạn chưa cập nhật số điện thoại" readonly>
                        @endif
                    </div>
                    <!-- Nộp CV -->
                    <div class="mb-3">
                        <label for="cv" class="form-label">Nộp CV</label>
                        <input type="file" class="form-control" id="cv" name="cv" required>
                        <p></p>
                    </div>
                    <!-- Thư giới thiệu -->
                    {{-- <div class="mb-3">
                        <label for="cover_letter" class="form-label">Thư giới thiệu</label>
                        <textarea class="textarea" id="cover_letter" name="cover_letter" rows="4"></textarea>
                    </div> --}}
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