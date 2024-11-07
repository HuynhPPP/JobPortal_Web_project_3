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
          <li class="nav-item">
            <a class="nav-link fs-5" aria-current="page" href="{{ route('jobs') }}">Tìm việc</a>
          </li>
        </ul>
        @if (Auth::check())
        <!-- Biểu tượng thông báo -->
          <div class="nav-item dropdown me-3">
            <a href="#" class="nav-link position-relative" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-envelope fs-3"></i>
              <span class="position-absolute top-0 start-90 translate-middle badge rounded-pill bg-danger">
                3 <!-- Giả sử có 3 thông báo -->
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="notificationDropdown">
              <li class="dropdown-item">
                <a href="#" class="d-flex align-items-center">
                  <div class="me-3">
                    <i class="fa fa-user text-primary"></i>
                  </div>
                  <div>
                    <p class="mb-0">Một ứng viên mới vừa ứng tuyển</p>
                    <small class="text-muted">5 phút trước</small>
                  </div>
                </a>
              </li>
              <li class="dropdown-item">
                <a href="#" class="d-flex align-items-center">
                  <div class="me-3">
                    <i class="fa fa-clock-o text-warning"></i>
                  </div>
                  <div>
                    <p class="mb-0">Công việc sắp hết hạn ứng tuyển</p>
                    <small class="text-muted">2 ngày tới</small>
                  </div>
                </a>
              </li>
              <li class="dropdown-item text-center">
                <a href="#">Xem tất cả thông báo</a>
              </li>
            </ul>
          </div>

          <a class="btn btn-outline-primary me-3" href="{{ route('account.profile') }}" type="submit">Thông tin tài
            khoản</a>
        @else
          <a class="btn btn-outline-primary me-3" href="{{ route('account.login') }}" type="submit">Đăng nhập</a>
        @endif
        @if (Auth::check() && Auth::user()->role === 'employer')
          <a class="btn btn-primary" href="{{ route('account.createJob') }}" type="submit">Đăng bài tuyển dụng</a>
        @endif
      </div>
    </div>
  </nav>
</header>
