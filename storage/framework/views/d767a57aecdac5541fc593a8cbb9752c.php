<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập- TopWork - Việc làm hàng đầu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/user/css/toastr.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/user/css/login_style.css')); ?>">
</head>

<body>
    <div class="form-wrapper">
        <main class="form-side">
            <a href="<?php echo e(route('home')); ?>" title="Logo">
                <img src="<?php echo e(asset('assets/user/images/login/logo_web.png')); ?>" alt="Laplace Logo" class="logo">
            </a>
            <form class="my-form" action="<?php echo e(route('account.authenticate')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-welcome-row">
                    <h1>Đăng nhập</h1>
                </div>
                <div class="socials-row">
                    <a href="<?php echo e(route('google-auth')); ?>" title="Use Github">
                        <img src="<?php echo e(asset('assets/user/images/login/google.png')); ?>" alt="Google">
                        Đăng nhập bằng Google
                    </a>
                </div>
                <div class="divider">
                    <div class="divider-line"></div>
                    Hoặc
                    <div class="divider-line"></div>
                </div>
                <div class="text-field">
                    <label for="email">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           autocomplete="off" 
                           value="<?php echo e(old('email')); ?>"
                           placeholder="Ví dụ: you@example.com" 
                    >
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="invalid-feedback" style="color: red"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="text-field">
                    <label for="password">Mật khẩu</label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           placeholder="Nhập mật khẩu..." 
                    >
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="invalid-feedback" style="color: red"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button class="my-form__button" type="submit">
                    Đăng nhập
                </button>
                <p class="forgotPass">
                    <a href="<?php echo e(route("account.forgotPassword")); ?>" 
                        class="linkForgotPass">Quên mật khẩu?
                    </a>
                </p>
                <div class="my-form__actions">
                    <div class="my-form__row">
                        <span>Bạn chưa có tài khoản?</span>
                        <a href="<?php echo e(route("account.registration")); ?>" title="Reset Password">
                            Đăng ký ngay
                        </a>
                    </div>
                </div>
            </form>
        </main>
        <aside class="info-side">
            <div class="blockquote-wrapper">
                <h1>
                    &#128079; Chào mừng bạn đến với website tìm kiếm việc làm - <span style="color: red">TopWork</span>
                </h1>
            </div>
        </aside>
    </div>

    <script src="<?php echo e(asset('assets/user/js/jquery-3.6.0.min.js')); ?>"></script>
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
    
    
</body>

</html><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/account/login_2.blade.php ENDPATH**/ ?>