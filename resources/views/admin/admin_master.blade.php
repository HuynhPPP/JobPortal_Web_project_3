<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <title>TopWork - Việc làm hàng đầu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset("admin/images/favicon.ico") }}">

    <!-- Theme Config Js -->
    <script src="{{ asset("admin/js/config.js") }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset("admin/css/vendor.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset("admin/css/app.min.css") }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset("admin/css/app.css") }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    {{-- <link href="{{ asset("admin/css/icons.min.css") }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
  </head>

  <body>
    <!-- Begin page -->
    <div class="wrapper">
      <!-- Sidenav Menu Start -->
      @include("admin.body.sidebar")
      <!-- Sidenav Menu End -->
      <!-- Topbar Start -->
      @include("admin.body.header")
      <!-- Topbar End -->

      <!-- Search Modal -->
      {{-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-transparent">
            <div class="card mb-1">
              <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                <i class="ti ti-search fs-22"></i>
                <input type="search" class="form-control border-0" id="search-modal-input"
                  placeholder="Search for actions, people,">
                <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
              </div>
            </div>
          </div>
        </div>
      </div> --}}

      <!-- ============================================================== -->
      <!-- Start Page Content here -->
      <!-- ============================================================== -->
      <div class="page-content">
        <div class="page-container">
          @yield("content")
        </div> <!-- container -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->


    <!-- Vendor js -->
    <script src="{{ asset("admin/js/vendor.min.js") }}"></script>

    <!-- App js -->
    <script src="{{ asset("admin/js/app.js") }}"></script>

    <!-- Apex Chart js -->
    <script src="{{ asset("admin/vendor/apexcharts/apexcharts.min.js") }}"></script>

    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    {{-- <script>
      toastr.success("demo");
    </script> --}}

  </body>

</html>
