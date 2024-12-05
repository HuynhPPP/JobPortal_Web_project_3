<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <title>TopWork - Việc làm hàng đầu</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('admin/images/favicon.ico')); ?>">

    <!-- Theme Config Js -->
    <script src="<?php echo e(asset('admin/js/config.js')); ?>"></script>

    <!-- Vendor css -->
    <link href="<?php echo e(asset('admin/css/vendor.min.css')); ?>" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?php echo e(asset('admin/css/app.min.css')); ?>" rel="stylesheet" type="text/css" id="app-style" />
    <link href="<?php echo e(asset('admin/css/app.css')); ?>" rel="stylesheet" type="text/css" id="app-style" />

    <link href="<?php echo e(asset('admin/vendor/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css"
      id="app-style" />

    <link rel="stylesheet" href="<?php echo e(asset('assets/user/trumbowyg/trumbowyg.min.css')); ?>" />
  </head>

  <body>
    <!-- Begin page -->
    <div class="wrapper">
      <!-- Sidenav Menu Start -->
      <?php echo $__env->make('admin.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Sidenav Menu End -->
      <!-- Topbar Start -->
      <?php echo $__env->make('admin.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Topbar End -->
      <div class="page-content">
        <div class="page-container">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
    </div>
    <script src="<?php echo e(asset('admin/js/jquery-3.6.0.min.js')); ?>"></script>
    <script>
      // $.ajaxSetup({
      //   headers: {
      //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      // });
    </script>
    <script src="<?php echo e(asset('admin/js/vendor.min.js')); ?>"></script>

    <!-- App js -->
    <script src="<?php echo e(asset('admin/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/extended-sweetalerts.js')); ?>"></script>

    <!-- Apex Chart js -->
    <script src="<?php echo e(asset('admin/vendor/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendor/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/user/trumbowyg/trumbowyg.min.js')); ?>"></script>
    <script>
      $('.textarea').trumbowyg({
        btns: [
          ['viewHTML'],
          ['undo', 'redo'],
          ['formatting'],
          ['strong', 'em', 'del'],
          ['superscript', 'subscript'],
          ['link'],
          ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
          ['unorderedList', 'orderedList'],
          ['horizontalRule'],
          ['removeformat'],
          ['fullscreen']
        ]
      });
    </script>
    <?php echo $__env->yieldContent('customJs'); ?>
  </body>

</html>
<?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/admin/admin_master.blade.php ENDPATH**/ ?>