@extends('front.layouts.app')

@section('main')
<section class="section-50">
    <div class="container">
        <h3 class="m-b-50 heading-line">Thông báo</h3>
    
        <div class="notification-ui_dd-content">
            @forelse($notifications as $notification)
            <div class="notification-list notification-list--unread position-relative">
                <!-- Nút xóa ở góc phải -->
                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="position: absolute; top: 10px; right: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </form>

                <div class="notification-list_content">
                    <div class="notification-list_img">
                        <img src="{{ asset('assets/user/profile_picture/thumb/' . ($notification->employer_image ?? 'logo-page.png')) }}" alt="{{ $notification->employer_name }}">
                    </div>
                    <div class="notification-list_detail">
                        @if ($notification->type == 'approved')
                            <p>Nhà tuyển dụng <b>{{ $notification->employer_name }}</b> đã phê duyệt công việc bạn đã ứng tuyển - <b>{{ $notification->job_title }}</b></p>
                            <p class="text-muted">{{ $notification->message }}</p>
                        @elseif ($notification->type == 'rejected')
                            <p>Nhà tuyển dụng <b>{{ $notification->employer_name }}</b> đã từ chối công việc bạn đã ứng tuyển - <b>{{ $notification->job_title }}</b></p>
                            <p class="text-danger">{{ $notification->message }}</p>
                        @elseif ($notification->type == 'job_reached')
                            <p><b>{{ $notification->job_title }}</b> đã đủ số lượng ứng tuyển. Không thể ứng tuyển thêm.</p>
                            <p class="text-warning">{{ $notification->message }}</p>
                        @elseif ($notification->type == 'expired')
                            <p><b>{{ $notification->job_title }}</b> đã hết hạn ứng tuyển.</p>
                            <p class="text-muted">{{ $notification->message }}</p>
                        @elseif ($notification->type == 'deleted')
                            <p><b>{{ $notification->employer_name }}</b> đã xóa công việc <b>{{ $notification->job_title }}</b>.</p>
                            <p class="text-danger">{{ $notification->message }}</p>
                        @else
                            <p><b>{{ $notification->employer_name }}</b> đã thay đổi thông tin công việc <b>{{ $notification->job_title }}</b></p>
                            <p class="text-muted">{{ $notification->message }}</p>
                        @endif
                        
                        <p class="text-muted text-time"><small>{{ \Carbon\Carbon::parse($notification->updated_at)->diffForHumans() }}</small></p>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-md-12">
                    <div class="card-error-find">
                        <div class="card-body-error-find">
                            <img alt="Illustration of a piggy bank with a magnifying glass" height="100"
                                src="https://storage.googleapis.com/a1aa/image/wbdDxuRHo2aDNtL5eFnlzmLSJ5fXAOdRDeHnXiZSLwjffvSdC.jpg"
                                width="100" />
                            <div class="text-content">
                                <h5 class="mt-3">
                                    Oops! Không có thông báo mới !
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    
    
    
</section>
@endsection

@section('customJs')

@endsection