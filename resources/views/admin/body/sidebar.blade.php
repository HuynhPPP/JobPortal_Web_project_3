<div class="sidenav-menu">
  <!-- Brand Logo -->
  <a href="index.html" class="logo">
    <span class="logo-light">
      <span class="logo-lg"><img src="{{ asset("admin/images/logo.png") }}" alt="logo"></span>
      <span class="logo-sm"><img src="{{ asset("admin/images/logo-sm.png") }}" alt="small logo"></span>
    </span>
    <span class="logo-dark">
      <span class="logo-lg"><img src="{{ asset("admin/images/logo-dark.png") }}" alt="dark logo"></span>
      <span class="logo-sm"><img src="{{ asset("admin/images/logo-sm.png") }}" alt="small logo"></span>
    </span>
  </a>
  <!-- Sidebar Hover Menu Toggle Button -->
  <button class="button-sm-hover">
    <i class="ti ti-circle align-middle"></i>
  </button>
  <!-- Full Sidebar Menu Close Button -->
  <button class="button-close-fullsidebar">
    <i class="ti ti-x align-middle"></i>
  </button>
  <div data-simplebar>
    <!--- Sidenav Menu -->
    <ul class="side-nav">
      <li class="side-nav-title">Dash</li>
      <li class="side-nav-item">
        <a href="index.html" class="side-nav-link">
          <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
          <span class="menu-text"> Sales </span>
          <span class="badge bg-success rounded-pill">5</span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="dashboard-clinic.html" class="side-nav-link">
          <span class="menu-icon"><i class="ti ti-building-hospital"></i></span>
          <span class="menu-text"> Clinic </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="dashboard-wallet.html" class="side-nav-link">
          <span class="menu-icon"><i class="ti ti-wallet"></i></span>
          <span class="menu-text"> eWallet </span>
          <span class="badge p-0 menu-alert fs-16 text-danger">
            <i class="ti ti-info-triangle" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="tooltip-warning" data-bs-title="Your wallet balance is <b>low!</b>"></i>
          </span>
        </a>
      </li>
      <li class="side-nav-title mt-2">Apps & Pages</li>
      <li class="side-nav-item">
        <a href="apps-chat.html" class="side-nav-link">
          <span class="menu-icon"><i class="ti ti-message"></i></span>
          <span class="menu-text"> Chat </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a href="apps-calendar.html" class="side-nav-link">
          <span class="menu-icon"><i class="ti ti-calendar"></i></span>
          <span class="menu-text"> Calendar </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarHospital" aria-expanded="false" aria-controls="sidebarHospital"
          class="side-nav-link">
          <span class="menu-icon"><i class="ti ti-medical-cross"></i></span>
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
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
</div>
