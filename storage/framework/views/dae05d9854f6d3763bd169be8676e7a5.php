<!DOCTYPE html>
<html class="no-js" lang="vi" />

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>TopWork - Việc làm hàng đầu</title>
  <meta name="description" content="" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
  <meta name="HandheldFriendly" content="True" />
  <meta name="pinterest" content="nopin" />
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('assets/user/css/font-awesome.css')); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('assets/user/trumbowyg/trumbowyg.min.css')); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/user/css/style.css')); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/user/css/message.css')); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('assets/user/choices/public/assets/styles/choices.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/user/css/toastr.min.css')); ?>" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/user/images/logo_web.jpg')); ?>" />
  <link href="<?php echo e(asset('assets/user/css/select2.min.css')); ?>" rel="stylesheet" />
</head>

<body data-instant-intensity="mousedown">

  <?php echo $__env->make('front.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('main'); ?>
  <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
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
  <?php endif; ?>

  <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
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
  <?php endif; ?>

  <?php echo $__env->make('front.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <script src="<?php echo e(asset('assets/user/js/jquery-3.6.0.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/jquery.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/select2.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/sweetalert.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/choices/public/assets/scripts/choices.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/bootstrap.bundle.5.1.3.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/instantpages.5.1.0.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/lazyload.17.6.0.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/custom.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/datepicker.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/trumbowyg/trumbowyg.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/js/toastr.min.js')); ?>"></script>

  <?php if(session()->has('toastr')): ?>
    <script>
      toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "6000"
      };

      <?php $__currentLoopData = session('toastr'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.<?php echo e($type); ?>('<?php echo e($message); ?>');
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
  <?php endif; ?>

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
        url: '<?php echo e(route('account.updateProfilePicture')); ?>',
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
            window.location.href = '<?php echo e(url()->current()); ?>';
          }
        }
      })
    });
  </script>

  <script>
    window.addEventListener('beforeunload', function () {
      var progressBar = document.getElementById('progressBar');
      var progressContainer = document.getElementById('progressBarContainer');

      // Hiển thị thanh tiến trình khi trang bắt đầu chuyển
      progressContainer.style.display = 'block';
      progressBar.style.width = '0%';
      progressBar.setAttribute('aria-valuenow', 0);

      var progress = 0;
      var interval = setInterval(function () {
        if (progress < 90) {
          progress += 2; // Tăng chiều rộng dần lên 90% khi đang chuyển trang
          progressBar.style.width = progress + '%';
          progressBar.setAttribute('aria-valuenow', progress);
        } else {
          clearInterval(interval); // Dừng tăng khi đạt đến 90%
        }
      }, 50); // Điều chỉnh tốc độ tăng (ms)
    });

    document.addEventListener('readystatechange', function () {
      var progressBar = document.getElementById('progressBar');
      var progressContainer = document.getElementById('progressBarContainer');

      if (document.readyState === 'complete') {
        // Khi trang tải hoàn tất, hoàn thành thanh tiến trình
        progressBar.style.width = '100%';
        progressBar.setAttribute('aria-valuenow', 100);
        setTimeout(function () {
          progressContainer.style.display = 'none'; // Ẩn sau khi tải xong
        }, 500); // Ẩn sau 0.5 giây
      }
    });
  </script>

  <?php echo $__env->yieldContent('customJs'); ?>
</body>

</html>
<?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/layouts/app.blade.php ENDPATH**/ ?>