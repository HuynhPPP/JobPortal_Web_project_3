<header>
  <nav class="navbar p-0 navbar-expand-lg navbar-light bg-white shadow-lg bg-body rounded">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('assets/user/images/logo_web.jpg') }}" alt="Logo" class="navbar-logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
              <li class="nav-item">
                <a class="nav-link fs-5" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
              </li>
              <li class="nav-divider"></li>
              @if (Auth::check() && Auth::user()->role === 'user')
                <li class="nav-item">
                  <a class="nav-link fs-5" aria-current="page" href="{{ route('jobs') }}">Tìm việc</a>
                </li>
              @else
                <li class="nav-item">
                  <a class="nav-link fs-5" aria-current="page" href="{{ route('jobs') }}">Trang việc làm</a>
                </li>
              @endif
              
              @if (Auth::check() && Auth::user()->role === 'user')
              <li class="nav-divider"></li>
              <li class="nav-item">
                <a class="nav-link fs-5" aria-current="page" href="{{ route('account.notification') }}">Thông báo việc làm</a>
              </li>
              @endif
              @if (Auth::check() && Auth::user()->role === 'employer')
              <li class="nav-divider"></li>
              <li class="nav-item">
                <a class="nav-link fs-5" aria-current="page" href="{{ route('account.notificationEmployer') }}">Thông báo việc làm</a>
              </li>
              @endif
          </ul>
          @if (Auth::check())
              @if (Auth::user()->role === 'user')
                <a class="btn btn-outline-primary me-3" href="{{ route('account.profile') }}" type="submit">Thông tin tài
                  khoản</a>
              @elseif (Auth::user()->role === 'admin')
                <a class="btn btn-outline-primary me-3" href="{{ route('admin.home') }}" type="submit">Trang quản trị viên</a>
              @endif
          @else
            <a class="btn btn-outline-primary me-3" href="{{ route('account.login') }}" type="submit">Đăng nhập</a>
          @endif
          @if (Auth::check() && Auth::user()->role === 'employer')
            <a class="btn btn-outline-primary me-3" href="{{ route('account.profile') }}" type="submit">Thông tin tài
            khoản</a>
            <a class="btn btn-primary" href="{{ route('account.createJob') }}" type="submit">Đăng bài tuyển dụng</a>
          @endif
      </div>
    </div>
  </nav>
  <div id="progressBarContainer" class="progress" style="height: 5px;">
    <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
</header>
