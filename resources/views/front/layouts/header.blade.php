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
              <i class="fa fa-bell fs-3"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-lg p-3" style="width: 600px; max-height: 600px; overflow-y: auto;" aria-labelledby="notificationDropdown">
              <li class="dropdown-header text-muted d-flex justify-content-between align-items-center fs-4">
                  Thông báo mới
              </li>
              <li class="dropdown-divider"></li>
      
              <!-- Thông báo 1 -->
              <li class="dropdown-item" style="background: #fffaef">
                <a href="#" class="d-flex align-items-start">
                    <img style="width: 15%;" src="{{ asset('assets/user/images/logo_web.jpg') }}" alt="User Image" class="rounded-circle" width="10" height="10">
                    <div style="margin-left: 15px">
                        <p class="mb-1 mt-3 font-weight-normal" style="color: #414042;">Bạn có thông báo đến từ nhà tuyển dụng <span style="color: red">Employer_6</span></p>
                        <small class="text-muted">1 tiếng trước</small>
                    </div>
                </a>
              </li>
              <br>
      
              <!-- Thông báo 2 -->
              <li class="dropdown-item" style="background: #fffaef">
                <a href="#" class="d-flex align-items-start">
                    <img style="width: 15%;" src="{{ asset('assets/user/images/logo_web.jpg') }}" alt="User Image" class="rounded-circle" width="10" height="10">
                    <div style="margin-left: 15px">
                        <p class="mb-1 mt-3 font-weight-normal" style="color: #414042;">Bạn có thông báo đến từ nhà tuyển dụng <span style="color: red">Employer_6</span></p>
                        <small class="text-muted">1 tiếng trước</small>
                    </div>
                </a>
              </li>
      
              <li class="dropdown-divider"></li>
              <li class="text-center">
                  <a href="{{ route('account.notification') }}" class="text-primary">Xem tất cả</a>
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
