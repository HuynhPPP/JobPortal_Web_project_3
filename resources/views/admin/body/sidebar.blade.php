<div class="sidenav-menu">
  <!-- Brand Logo -->
  <a href="{{ route('admin.home') }}" class="logo">
    <span class="logo-light">
      <span class="logo-lg"><img src="{{ asset('admin/images/logo-sm.png') }}" alt="logo"></span>
      <span class="logo-sm"><img src="{{ asset('admin/images/logo-sm.png') }}" alt="small logo"></span>
    </span>
    <span class="logo-dark">
      <span class="logo-lg"><img src="{{ asset('admin/images/logo-dark.png') }}" alt="dark logo"></span>
      <span class="logo-sm"><img src="{{ asset('admin/images/logo-sm.png') }}" alt="small logo"></span>
    </span>
  </a>
  <!-- Sidebar Hover Menu Toggle Button -->
  <button class="button-sm-hover">
    {!! file_get_contents(public_path('admin/icon/circle-arrow-left.svg')) !!}
  </button>
  <!-- Full Sidebar Menu Close Button -->
  <button class="button-close-fullsidebar">
    <i class="ti ti-x align-middle"></i>
  </button>
  <div data-simplebar>
    <!--- Sidenav Menu -->
    <ul class="side-nav">
      <li class="side-nav-item">
        <a href="{{ route('admin.home') }}" class="side-nav-link">
          <span class="menu-icon">
            {!! file_get_contents(public_path('admin/icon/dashboard.svg')) !!}
          </span>
          <span class="menu-text"> Tổng quan </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="{{ route('admin.career') }}" class="side-nav-link">
          <span class="menu-icon">
            {!! file_get_contents(public_path('admin/icon/category.svg')) !!}
          </span>
          <span class="menu-text"> Ngành nghề </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="{{ route('admin.job') }}" class="side-nav-link">
          <span class="menu-icon">
            {!! file_get_contents(public_path('admin/icon/briefcase-2.svg')) !!}
          </span>
          <span class="menu-text"> Việc làm </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a href="{{ route('admin.user') }}" class="side-nav-link">
          <span class="menu-icon">
            {!! file_get_contents(public_path('admin/icon/users.svg')) !!}
          </span>
          <span class="menu-text"> Ứng viên </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="{{ route('admin.employer') }}" class="side-nav-link">
          <span class="menu-icon">
            {!! file_get_contents(public_path('admin/icon/building.svg')) !!}
          </span>
          <span class="menu-text"> Nhà tuyển dụng </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="{{ route('admin.apply.job') }}" class="side-nav-link">
          <span class="menu-icon">
            {!! file_get_contents(public_path('admin/icon/file-cv.svg')) !!}
          </span>
          <span class="menu-text"> Ứng tuyển </span>
        </a>
      </li>
      {{-- <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarHospital" aria-expanded="false" aria-controls="sidebarHospital"
          class="side-nav-link">
          <span class="menu-icon">
            {!! file_get_contents(public_path('admin/icon/dashboard.svg')) !!}
          </span>
          <span class="menu-text"> Hospital</span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarHospital">
          <ul class="sub-menu">
            <li class="side-nav-item">
              <a href="apps-hospital-doctors.html" class="side-nav-link">
                <span class="menu-text">Doctors</span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
    </ul>
    <div class="clearfix"></div>
  </div>
</div>
