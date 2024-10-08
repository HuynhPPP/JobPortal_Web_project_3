<!DOCTYPE html>
<html class="no-js" lang="vi" />

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>JobEverywhere | Tìm việc làm tốt nhất</title>
  <meta name="description" content="" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
  <meta name="HandheldFriendly" content="True" />
  <meta name="pinterest" content="nopin" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/style.css") }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Fav Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>

<body data-instant-intensity="mousedown">

  @include('front.layouts.header')

  @yield("main")

  @if (Auth::check() && Auth::user()->role === 'user')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title pb-0" id="exampleModalLabel">Đổi ảnh đại diện</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="profilePicForm" name="profilePicForm" action="" method="post">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Chọn ảnh đại diện</label>
                <input type="file" class="form-control" id="image" name="image">
                <p class="text-danger" id="image-error"></p>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mx-3">Cập nhật</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endif

  @if (Auth::check() && Auth::user()->role === 'employer')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title pb-0" id="exampleModalLabel">Đổi ảnh logo công ty</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="profilePicForm" name="profilePicForm" action="" method="post">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Chọn logo</label>
                <input type="file" class="form-control" id="image" name="image">
                <p class="text-danger" id="image-error"></p>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mx-3">Cập nhật</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endif

  @include('front.layouts.footer')
  

  <script src="{{ asset("assets/js/jquery-3.6.0.min.js") }}"></script>
  <script src="{{ asset("assets/js/bootstrap.bundle.5.1.3.min.js") }}"></script>
  <script src="{{ asset("assets/js/instantpages.5.1.0.min.js") }}"></script>
  <script src="{{ asset("assets/js/lazyload.17.6.0.min.js") }}"></script>
  <script src="{{ asset("assets/js/custom.js") }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  @if (session()->has("toastr"))
    <script>
      toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "6000"
      };

      @foreach (session("toastr") as $type => $message)
        toastr.{{ $type }}('{{ $message }}');
      @endforeach
    </script>
  @endif

  <script>
    $('.textarea').trumbowyg();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#profilePicForm").submit(function(e) {
      e.preventDefault();

      var formData = new FormData(this);

      $.ajax({
        url: '{{ route("account.updateProfilePicture") }}',
        type: 'post',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
          if (response.status == false) {
            var errors = response.errors;
            if (errors.image) {
              $("#image-error").html(errors.image)
            }
          } else {
            window.location.href = '{{ url()->current() }}';
          }
        }
      })
    });
  </script>

  @yield("customJs")
</body>

</html>
