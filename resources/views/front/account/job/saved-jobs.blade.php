@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Công việc yêu thích</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Quản lý công việc yêu thích </h3>
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
                                        <th scope="col">Số lượng ứng viên đã nộp</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Các tuỳ chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($savedJobs->isNotEmpty())
                                        @foreach ($savedJobs as $savedJob)
                                        <form action="{{ route('account.removeSavedJob') }}" method="POST">
                                            @csrf 
                                            <tr id="saved-job-{{ $savedJob->id }}" class="active">
                                                <td style="display: none"><input type="hidden" name="id" value="{{ $savedJob->id }}"></td>
                                                <td>
                                                    <div class="job-name fw-500">{{ Str::words(strip_tags($savedJob->job->title), 5)  }}</div>
                                                    <div class="info1 fst-italic">{{ $savedJob->job->jobType->name }} . {{ $savedJob->job->province }}</div>
                                                </td>
                                                <td>{{ $savedJob->job->applications->count() }} ứng viên</td>
                                                <td>
                                                    @if ($savedJob->job->status == 1)
                                                        <div class="job-status text-capitalize text-success">Hoạt động</div>
                                                    @elseif ($savedJob->job->status == 2)
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
                                                            <li><a class="dropdown-item" href="{{ route("jobDetail", $savedJob->job_id) }}"> 
                                                                <i class="fa fa-eye" aria-hidden="true"></i> Xem
                                                            </a></li>
                                                            <li>
                                                                <button type="submit" class="dropdown-item" onclick="return confirm('Bạn chắc chắn muốn huỷ yêu thích công việc này không?')">
                                                                    <i class="fa fa-trash me-3" aria-hidden="true"></i> Huỷ yêu thích
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
    $("#searchForm").submit(function(e){
        e.preventDefault();

        var url = '{{ route("account.savedJobs") }}?';

        var keyword = $("#keyword").val();
        
        // If keyword has a value
        if (keyword != ""){
            url += '&keyword='+keyword;
        }
        window.location.href=url;
    });
</script>
@endsection