<div class="sidenav-menu">
  <!-- Brand Logo -->
  <a href="<?php echo e(route('admin.home')); ?>" class="logo">
    <span class="logo-light">
      <span class="logo-lg"><img src="<?php echo e(asset('admin/images/logo-sm.png')); ?>" alt="logo"></span>
      <span class="logo-sm"><img src="<?php echo e(asset('admin/images/logo-sm.png')); ?>" alt="small logo"></span>
    </span>
    <span class="logo-dark">
      <span class="logo-lg"><img src="<?php echo e(asset('admin/images/logo-dark.png')); ?>" alt="dark logo"></span>
      <span class="logo-sm"><img src="<?php echo e(asset('admin/images/logo-sm.png')); ?>" alt="small logo"></span>
    </span>
  </a>
  <!-- Sidebar Hover Menu Toggle Button -->
  <button class="button-sm-hover">
    <?php echo file_get_contents(public_path('admin/icon/circle-arrow-left.svg')); ?>

  </button>
  <!-- Full Sidebar Menu Close Button -->
  <button class="button-close-fullsidebar">
    <i class="ti ti-x align-middle"></i>
  </button>
  <div data-simplebar>
    <!--- Sidenav Menu -->
    <ul class="side-nav">
      <li class="side-nav-item">
        <a href="<?php echo e(route('admin.home')); ?>" class="side-nav-link">
          <span class="menu-icon">
            <?php echo file_get_contents(public_path('admin/icon/dashboard.svg')); ?>

          </span>
          <span class="menu-text"> Tổng quan </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="<?php echo e(route('admin.career')); ?>" class="side-nav-link">
          <span class="menu-icon">
            <?php echo file_get_contents(public_path('admin/icon/category.svg')); ?>

          </span>
          <span class="menu-text"> Ngành nghề </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="<?php echo e(route('admin.job')); ?>" class="side-nav-link">
          <span class="menu-icon">
            <?php echo file_get_contents(public_path('admin/icon/briefcase-2.svg')); ?>

          </span>
          <span class="menu-text"> Việc làm </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a href="<?php echo e(route('admin.user')); ?>" class="side-nav-link">
          <span class="menu-icon">
            <?php echo file_get_contents(public_path('admin/icon/users.svg')); ?>

          </span>
          <span class="menu-text"> Ứng viên </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="<?php echo e(route('admin.employer')); ?>" class="side-nav-link">
          <span class="menu-icon">
            <?php echo file_get_contents(public_path('admin/icon/building.svg')); ?>

          </span>
          <span class="menu-text"> Nhà tuyển dụng </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="<?php echo e(route('admin.apply.job')); ?>" class="side-nav-link">
          <span class="menu-icon">
            <?php echo file_get_contents(public_path('admin/icon/file-cv.svg')); ?>

          </span>
          <span class="menu-text"> Ứng tuyển </span>
        </a>
      </li>
      
    </ul>
    <div class="clearfix"></div>
  </div>
</div>
<?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/admin/body/sidebar.blade.php ENDPATH**/ ?>