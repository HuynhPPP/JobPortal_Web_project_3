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
                                <h3 class="fs-4 mb-1">Quản lý công việc của bạn</h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <div class="input-group">
                                    <form action="" class="d-flex">
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
                                        <th scope="col">Ngày đăng</th>
                                        <th scope="col">Số lượng ứng tuyển</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Các tuỳ chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($jobs->isNotEmpty())
                                        @foreach ($jobs as $job)
                                        <tr class="active">
                                            <td>
                                                <div class="job-name fw-500">{{ $job->title }}</div>
                                                <div class="info1">{{ $job->jobType->name }} . {{ $job->location }}</div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($job->created_at)->locale('vi')->translatedFormat('d F, Y') }}</td>
                                            <td>{{ $job->vacancy }}</td>
                                            <td>
                                                @if ($job->status == 1)
                                                    <div class="job-status text-capitalize text-success">Đã phê duyệt</div>
                                                @elseif ($job->status == 0)
                                                    <div class="job-status text-capitalize text-warning">Đang chờ phê duyệt</div>
                                                @else
                                                    <div class="job-status text-capitalize text-danger">Hết hạn</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-dots float-end">
                                                    <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        @if ($job->status == 1)
                                                            <li><a class="dropdown-item" href="{{ route("JobDetail_employer",$job->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> Xem</a></li>
                                                        @else
                                                            <li><a class="dropdown-item disabled" href="{{ route("JobDetail_employer",$job->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> Xem</a></li>
                                                        @endif
                                                        <li><a class="dropdown-item" href="{{ route("account.editJob", $job->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Chỉnh sửa</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="deleteJob({{ $job->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Xoá</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>                               
                            </table>
                        </div>
                        <div>
                            {{ $jobs->links() }}
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
    function deleteJob(jobId) {
        if (confirm("Bạn muốn xoá công việc này không ?")) {
            $.ajax({
                url: '{{ route("account.deleteJob") }}',
                type: 'post',
                data: {jobId: jobId},
                dataType: 'json',
                success: function(response) {
                    window.location.href='{{ route("account.myJobs") }}'
                }
            })
        } else {

        }
    }
</script>
@endsection