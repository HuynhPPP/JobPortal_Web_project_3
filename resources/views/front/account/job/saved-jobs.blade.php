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
                                <h3 class="fs-4 mb-1">Quản lý công việc yêu thích </h3>
                            </div>
                            
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Số lượng ứng viên đã nộp</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Các tuỳ chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($savedJobs->isNotEmpty())
                                        @foreach ($savedJobs as $savedJob)
                                        <tr class="active">
                                            <td>
                                                <div class="job-name fw-500">{{ $savedJob->job->title }}</div>
                                                <div class="info1">{{ $savedJob->job->jobType->name }} . {{ $savedJob->job->location }}</div>
                                            </td>
                                            <td>{{ $savedJob->job->applications->count() }} ứng tuyển</td>
                                            <td>
                                                @if ($savedJob->job->status == 1)
                                                    <div class="job-status text-capitalize text-success">Hoạt động</div>
                                                @elseif ($job->status == 2)
                                                    <div class="job-status text-capitalize text-warning">Đang xử lý</div>
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
                                                        <li><a class="dropdown-item" href="{{ route("jobDetail",$savedJob->job_id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> Xem</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="removeSavedJob({{ $savedJob->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Huỷ yêu thích</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-danger">Bạn chưa có công việc yêu thích</td>
                                        </tr>
                                    @endif
                                </tbody>                               
                            </table>
                        </div>
                        <div>
                            {{ $savedJobs->links() }}
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
    function removeSavedJob(id) {
        if (confirm("Bạn chắc chắn muốn huỷ yêu thích công việc này không ?")) {
            $.ajax({
                url: '{{ route("account.removeSavedJob") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    window.location.href='{{ route("account.savedJobs") }}';
                }
            });
        } else {

        }
    }
</script>
@endsection