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
                                <h3 class="fs-4 mb-1">Công việc của tôi</h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <a href="{{ route("account.createJob") }}" class="btn btn-primary">Đăng việc làm</a>
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Ngày tạo</th>
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
                                            <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</td>
                                            <td>{{ $job->vacancy }} người</td>
                                            <td>
                                                @if ($job->status == 1)
                                                    <div class="job-status text-capitalize text-success">Hoạt động</div>
                                                @elseif ($job->status == 2)
                                                    <div class="job-status text-capitalize text-warning">Đang xử lý</div>
                                                @else
                                                    <div class="job-status text-capitalize text-danger">Hết hạn</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-dots float-end">
                                                    <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="job-detail.html"> <i class="fa fa-eye" aria-hidden="true"></i> Xem</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="fa fa-edit" aria-hidden="true"></i> Chỉnh sửa</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Xoá</a></li>
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
@endsection