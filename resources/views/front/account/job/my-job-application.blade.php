@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Cài đặt tài khoản</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Quản lý công việc đã ứng tuyển </h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <div class="input-group">
                                    <form action="" name="searchForm" id="searchForm" class="d-flex">
                                        <input value="" type="text" name="keyword" id="keyword" placeholder="Nhập tiêu đề..." class="form-control me-2">
                                        <button type="submit" class="btn btn-primary w-50">Tìm kiếm</button>
                                      </form>                                      
                                  </div>
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Ngày nộp</th>
                                        <th scope="col">Số lượng ứng viên đã nộp</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Các tuỳ chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($jobApplications->isNotEmpty())
                                        @foreach ($jobApplications as $jobApplication)
                                        <form action="{{ route('account.removeJobs') }}" method="POST">
                                            @csrf
                                            <tr class="active">
                                                <td style="display: none"><input type="hidden" name="id" value="{{ $jobApplication->id }}"></td>
                                                <td>
                                                    <div class="job-name fw-500">{{ $jobApplication->job->title }}</div>
                                                    <div class="info1">{{ $jobApplication->job->jobType->name }} . {{ $jobApplication->job->location }}</div>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($jobApplication->applied_date)->locale('vi')->translatedFormat('d F, Y') }}</td>
                                                <td>{{ $jobApplication->job->applications->count() }} ứng tuyển</td>
                                                <td>
                                                    @if ($jobApplication->job->status == 1)
                                                        <div class="job-status text-capitalize text-success">Đã phê duyệt</div>
                                                    @elseif ($jobApplication->job->status == 0)
                                                        <div class="job-status text-capitalize text-warning">Đang chờ phê duyệt</div>
                                                    @elseif ($jobApplication->job->status == 2)
                                                        <div class="job-status text-capitalize text-danger">Hết hạn</div>
                                                    @else
                                                        <div class="job-status text-warning">Công việc đã đủ số lượng ứng tuyển</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-dots float-end">
                                                        <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{ route("jobDetail",$jobApplication->job_id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> Xem</a></li>
                                                            
                                                            <li>
                                                                <button type="submit" class="dropdown-item" onclick="return confirm('Bạn chắc chắn muốn huỷ ứng tuyển công việc này không?')">
                                                                    <i class="fa fa-trash me-3" aria-hidden="true"></i> Huỷ ứng tuyển
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </form>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">
                                                <div class="card-error-find">
                                                    <div class="card-body-error-find">
                                                     <img alt="Illustration of a piggy bank with a magnifying glass" 
                                                       height="100" 
                                                       src="https://storage.googleapis.com/a1aa/image/wbdDxuRHo2aDNtL5eFnlzmLSJ5fXAOdRDeHnXiZSLwjffvSdC.jpg" 
                                                       width="100"/>
                                                     <div class="text-content">
                                                      <h5 class="mt-3">
                                                       Oops! Không tìm thấy công việc
                                                      </h5>
                                                      <p>
                                                       TopWork chưa tìm thấy công việc bạn tìm kiếm vào lúc này.
                                                      </p>
                                                     </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>                               
                            </table>
                        </div>
                        <div>
                            {{ $jobApplications->links() }}
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
    $("#searchForm").submit(function(e){
        e.preventDefault();

        var url = '{{ route("account.myJobApplication") }}?';

        var keyword = $("#keyword").val();
        
        if (keyword != ""){
            url += '&keyword='+keyword;
        }
        window.location.href=url;
    });
</script>
@endsection