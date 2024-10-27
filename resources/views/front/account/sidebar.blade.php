<div class="card border-0 shadow mb-4 p-3">
    <div class="s-body text-center mt-3">

        @if (Auth::user()->image != '')
            <img src="{{ asset('assets/user/profile_picture/thumb/'.Auth::user()->image) }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px; height:150px;">
        @else
            <img src="{{ asset('assets/user/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
        @endif
        
        <h5 class="mt-3 pb-0">{{ Auth::user()->fullname }}</h5>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}</p>
        <div class="d-flex justify-content-center mb-2 mt-3">
            @if (Auth::check() && Auth::user()->role === 'user')
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Đổi ảnh đại diện</button>
            @endif
            @if (Auth::check() && Auth::user()->role === 'employer')
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Đổi logo công ty</button>
            @endif
        </div>
    </div>
</div>
<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route("account.profile") }}">Thiết lập tài khoản</a>
            </li>
            @if (Auth::check() && Auth::user()->role === 'employer')
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route("account.createJob") }}">Đăng công việc</a>
            </li>
            @endif
            @if (Auth::check() && Auth::user()->role === 'employer')
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route("account.myJobs") }}">Công việc đã đăng</a>
            </li>
            @endif
            @if (Auth::check() && Auth::user()->role === 'user')
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route("account.myJobApplication") }}">Công việc đã ứng tuyển</a>
            </li>
            @endif
            @if (Auth::check() && Auth::user()->role === 'user')
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route("account.savedJobs") }}">Công việc yêu thích</a>
            </li>   
            @endif
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.logout') }}">Đăng xuất</a>
            </li>                                                         
        </ul>
    </div>
</div>