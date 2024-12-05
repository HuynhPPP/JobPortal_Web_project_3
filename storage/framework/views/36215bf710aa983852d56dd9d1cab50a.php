<header>
  <nav class="navbar p-0 navbar-expand-lg navbar-light bg-white shadow-lg bg-body rounded">
    <div class="container">
      <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
        <img src="<?php echo e(asset('assets/user/images/logo_web.jpg')); ?>" alt="Logo" class="navbar-logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
              <li class="nav-item">
                <a class="nav-link fs-5" aria-current="page" href="<?php echo e(route('home')); ?>">Trang chủ</a>
              </li>
              <li class="nav-divider"></li>
              <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
                <li class="nav-item">
                  <a class="nav-link fs-5" aria-current="page" href="<?php echo e(route('jobs')); ?>">Tìm việc</a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link fs-5" aria-current="page" href="<?php echo e(route('jobs')); ?>">Trang việc làm</a>
                </li>
              <?php endif; ?>
              
              <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
              <li class="nav-divider"></li>
              <li class="nav-item">
                <a class="nav-link fs-5" aria-current="page" href="<?php echo e(route('account.notification')); ?>">Thông báo việc làm</a>
              </li>
              <?php endif; ?>
              <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
              <li class="nav-divider"></li>
              <li class="nav-item">
                <a class="nav-link fs-5" aria-current="page" href="<?php echo e(route('account.notificationEmployer')); ?>">Thông báo việc làm</a>
              </li>
              <?php endif; ?>
          </ul>
          <?php if(Auth::check()): ?>
            <a class="btn btn-outline-primary me-3" href="<?php echo e(route('account.profile')); ?>" type="submit">Thông tin tài
              khoản</a>
          <?php else: ?>
            <a class="btn btn-outline-primary me-3" href="<?php echo e(route('account.login')); ?>" type="submit">Đăng nhập</a>
          <?php endif; ?>
          <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
            <a class="btn btn-primary" href="<?php echo e(route('account.createJob')); ?>" type="submit">Đăng bài tuyển dụng</a>
          <?php endif; ?>
      </div>
    </div>
  </nav>
  <div id="progressBarContainer" class="progress" style="height: 5px;">
    <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
</header>
<?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/layouts/header.blade.php ENDPATH**/ ?>