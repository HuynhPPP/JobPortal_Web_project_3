<header class="app-topbar">
  <div class="page-container topbar-menu">
    <div class="d-flex align-items-center gap-2">

      <!-- Brand Logo -->
      <a href="index.html" class="logo">
        <span class="logo-light">
          <span class="logo-lg"><img src="assets/images/logo.png" alt="logo"></span>
          <span class="logo-sm"><img src="assets/images/logo-sm.png" alt="small logo"></span>
        </span>

        <span class="logo-dark">
          <span class="logo-lg"><img src="assets/images/logo-dark.png" alt="dark logo"></span>
          <span class="logo-sm"><img src="assets/images/logo-sm.png" alt="small logo"></span>
        </span>
      </a>

      <!-- Sidebar Menu Toggle Button -->
      <button class="sidenav-toggle-button px-2">
        <i class="ti ti-menu-deep fs-24"></i>
      </button>

      <!-- Horizontal Menu Toggle Button -->
      <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
        <i class="ti ti-menu-deep fs-22"></i>
      </button>

      <!-- Button Trigger Search Modal -->



    </div>

    <div class="d-flex align-items-center gap-2">

      <!-- Search for small devices -->
      <div class="topbar-item d-flex d-xl-none">
        <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
          <i class="ti ti-search fs-22"></i>
        </button>
      </div>
      <!-- Notification Dropdown -->
      <div class="topbar-item">
        <div class="dropdown">
          <button class="topbar-link dropdown-toggle drop-arrow-none position-relative" data-bs-toggle="dropdown"
            data-bs-offset="0,25" type="button" data-bs-auto-close="outside" aria-haspopup="false"
            aria-expanded="false">
            <i class="ti ti-bell animate-ring fs-22"></i>
            <?php echo file_get_contents(public_path('admin/icon/bell.svg')); ?>

            <?php if(auth()->user()->unreadNotifications->count()): ?>
              <span class="alert-count position-absolute"><?php echo e(auth()->user()->unreadNotifications->count()); ?></span>
            <?php endif; ?>
          </button>
          <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
            <div class="p-3 border-bottom border-dashed">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="m-0 fs-16 fw-semibold"> Thông báo</h6>
                </div>
                <div class="col-auto">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle drop-arrow-none link-dark" data-bs-toggle="dropdown"
                      data-bs-offset="0,15" aria-expanded="false">
                      <i class="ti ti-settings fs-22 align-middle"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative z-2 card shadow-none rounded-0" style="max-height: 300px;" data-simplebar>
              <?php if(auth()->user()->unreadNotifications->isEmpty()): ?>
                <div class="dropdown-item notification-item py-2 text-wrap" id="notification-5">
                  <span class="d-flex align-items-center">
                    <span class="me-3 position-relative flex-shrink-0">
                    </span>
                    <span class="flex-grow-1 text-muted">
                      <div class="text-center">
                        <iconify-icon icon="line-md:bell-twotone-alert-loop"
                          class="fs-80 text-secondary mt-2"></iconify-icon>
                        <h4 class="fw-semibold mb-0 fst-italic lh-base mt-3"> <br>Không có thông báo!
                        </h4>
                      </div>
                    </span>
                  </span>
                </div>
              <?php else: ?>
                <?php $__currentLoopData = auth()->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
                  
                  
                  <a class="text-muted dropdown-item notification-item py-2 text-wrap"
                    href="<?php echo e(route('admin.notifications.markAsRead', $notification->id)); ?>">
                    
                    <span class="flex-grow-1">
                      <b class="text-primary"><?php echo e($notification->data['employer_name']); ?></b>
                      vừa thêm công việc mới.
                    </span>
                    <br />
                    <span class="fs-12"><?php echo e($notification->created_at->format('d/m/Y')); ?></span>
                  </a>
                  
                  
                  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- User Dropdown -->
      <div class="topbar-item nav-user">
        <div class="dropdown">
          <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown" data-bs-offset="0,19"
            type="button" aria-haspopup="false" aria-expanded="false">
            <img
              src="<?php echo e(Auth::user()->image ? asset('admin/upload/profile/' . Auth::user()->image) : asset('admin/images/avatar-default.png')); ?>"
              width="32" class="rounded-circle me-lg-2 d-flex" alt="user-image">
            <span class="d-lg-flex flex-column gap-1 d-none">
              <h5 class="my-0"><?php echo e(Auth::user()->fullname); ?></h5>
              <h6 class="my-0 fw-normal text-capitalize"><?php echo e(Auth::user()->role); ?></h6>
            </span>
            <i class="ti ti-chevron-down d-none d-lg-block align-middle ms-2"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a href="<?php echo e(route('admin.profile')); ?>" class="dropdown-item">
              <i class="ti ti-user-hexagon me-1 fs-17 align-middle"></i>
              <span class="align-middle">Tài khoản</span>
            </a>

            <!-- item-->
            

            <!-- item-->
            <a href="<?php echo e(route('account.logout')); ?>" class="dropdown-item active fw-semibold text-danger">
              <i class="ti ti-logout me-1 fs-17 align-middle"></i>
              <span class="align-middle">Đăng xuất</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/admin/body/header.blade.php ENDPATH**/ ?>