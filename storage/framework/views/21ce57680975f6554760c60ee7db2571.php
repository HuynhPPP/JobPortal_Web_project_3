<?php $__env->startSection('main'); ?>
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>

        <?php if(Session::has('success')): ?>
        <div class="alert alert-success">
            <p class="mb-0 pb-0"><?php echo e(Session::get('success')); ?></p>
        </div>
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
        <div class="alert alert-danger">
            <p class="mb-0 pb-0"><?php echo e(Session::get('error')); ?></p>
        </div>
        <?php endif; ?>

        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Đăng nhập</h1>
                    <form action="<?php echo e(route('account.authenticate')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="" class="mb-2">Email <span style="color: red">*</span></label>
                            <input type="text" 
                                    name="email" id="email" 
                                    value="<?php echo e(old('email')); ?>"
                                    class="form-control  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    placeholder="Ví dụ: example@example.com">

                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="invalid-feedback"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Mật khẩu <span style="color: red">*</span></label>
                            <input type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    placeholder="Nhập mật khẩu...">

                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="invalid-feedback"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div> 
                        <div class="justify-content-between d-flex">
                        <button class="btn btn-primary mt-2">Đăng nhập</button>
                            <a href="<?php echo e(route("account.forgotPassword")); ?>" class="mt-3">Quên mật khẩu?</a>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Bạn muốn tìm một công việc? <a  href="<?php echo e(route("account.registration")); ?>">Đăng ký</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/account/login.blade.php ENDPATH**/ ?>