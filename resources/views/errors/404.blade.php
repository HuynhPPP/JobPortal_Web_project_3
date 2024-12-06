<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <title>Error 404 | TopWork - Việc làm hàng đầu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('admin/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('admin/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  </head>

  <body class="h-100">

    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
      <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
        <div class="col-xl-4 col-lg-5 col-md-6">
          <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
            <div class="mx-auto text-center">
              <h3 class="fw-semibold mb-2">Ooop's ! </h3>
              <img src="{{ asset('admin/images/error/error-404.png') }}" alt="error 403 img" height="180"
                class="my-3">
              <h2 class="fw-bold mt-3 text-primary lh-base">Không tìm thấy trang !</h2>
              <h4 class="fw-bold mt-2 text-dark lh-base">Trang này không có sẵn</h4>
              <a href="#"onclick="window.history.back();" class="btn btn-primary">Trở về<i
                  class="ti ti-arrow ms-1"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('admin/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/js/app.js') }}"></script>

  </body>

</html>
