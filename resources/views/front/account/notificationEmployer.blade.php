@extends('front.layouts.app')

@section('main')
<head>
    <style>
        .welcome-container {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .welcome-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<section class="section-50">
    <div class="container" style="min-height: 80vh;">
        @if ($notifications_employer->count())
            <h3 class="mb-5 heading-line">Thông báo</h3>
            <div class="notification-ui_dd-content">
                @foreach($notifications_employer as $notification)
                    <div class="notification-list notification-list--unread position-relative">
                        <form action="{{ route('notifications.destroyEmployer', $notification->id) }}" method="POST" style="position: absolute; top: 10px; right: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" aria-label="Xóa thông báo này">Xóa</button>
                        </form>

                        <div class="notification-list_content">
                            <div class="notification-list_img">
                                <img src="{{ asset('assets/user/profile_picture/thumb/' . ($notification->users->image ?? 'logo-page.png')) }}" 
                                    alt="{{ $notification->users->fullname ?? 'Ảnh đại diện mặc định' }}">
                            </div>

                            <div class="notification-list_detail">
                                @if ($notification->type == 'applied')
                                    <p style="word-wrap: break-word; white-space: normal">
                                        Người ứng tuyển <span style="font-weight: 600; font-style: italic">{{ $notification->users->fullname ?? 'N/A' }}</span> 
                                        đã nộp đơn ứng tuyển vào công việc bạn - <span style="font-weight: 600; font-style: italic">{{ $notification->jobs->title ?? 'N/A' }}</span>
                                    </p>
                                @elseif ($notification->type == 'canceled')
                                    <p style="word-wrap: break-word; white-space: normal;">
                                        Người ứng tuyển <span style="font-weight: 600; font-style: italic">{{ $notification->users->fullname ?? 'N/A' }}</span> 
                                        đã huỷ ứng tuyển công việc của bạn - <span style="font-weight: 600; font-style: italic">{{ $notification->jobs->title ?? 'N/A' }}</span>
                                    </p>
                                @endif
                                <p class="text-muted">
                                    <small>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $notifications_employer->links() }}
        @else
            <div class="container welcome-container">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ asset('assets/user/images/notification_empty.png') }}" alt="Illustration" class="welcome-image mb-4">
                        <h2 class="mb-3">Chào mừng bạn đến với phần thông báo</h2>
                        <p class="mb-4">Khi người dùng ứng tuyển việc làm của bạn, bạn sẽ thấy thông báo ở đây</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@section('customJs')

@endsection