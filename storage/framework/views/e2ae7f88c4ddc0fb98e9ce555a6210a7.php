<?php $__env->startSection('main'); ?>
<head>
    <style>
        .welcome-container {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .welcome-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<section class="section-50">
    <div class="container" style="min-height: 80vh;">
        <?php if($notifications->count()): ?>
            <h3 class="mb-5 heading-line">Thông báo - Công việc bạn đã ứng tuyển</h3>
            <div class="notification-ui_dd-content">
                <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="notification-list notification-list--unread position-relative">
                        <form action="<?php echo e(route('notifications.destroy', $notification->id)); ?>" method="POST" style="position: absolute; top: 10px; right: 10px;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" aria-label="Xóa thông báo này">Xóa</button>
                        </form>
    
                        <div class="notification-list_content">
                            <div class="notification-list_img">
                                <img src="<?php echo e(asset('assets/user/profile_picture/thumb/' . ($notification->employer_image ?? 'notification_empty.png'))); ?>" 
                                     alt="<?php echo e($notification->employer_name ?? 'logo'); ?>">
                            </div>
                            <div class="notification-list_detail">
                                <?php if($notification->type == 'approved'): ?>
                                    <p>Nhà tuyển dụng <span style="font-weight: 600; font-style :italic"><?php echo e($notification->employer_name); ?></span> 
                                        đã phê duyệt công việc bạn đã ứng tuyển - <span style="font-weight: 600; font-style :italic"><?php echo e($notification->job_title); ?></span></p>
                                    <p class="text-muted"><?php echo e($notification->message); ?></p>
                                <?php elseif($notification->type == 'rejected'): ?>
                                    <p>Nhà tuyển dụng <span style="font-weight: 600; font-style :italic"><?php echo e($notification->employer_name); ?></span> 
                                        đã từ chối đơn xin ứng tuyển của bạn tại công việc - <span style="font-weight: 600; font-style :italic"><?php echo e($notification->job_title); ?></span></p>
                                    <p class="text-danger"><?php echo e($notification->message); ?></p>
                                <?php elseif($notification->type == 'job_reached'): ?>
                                    <p>Công việc <span style="font-weight: 600; font-style :italic"><?php echo e($notification->job_title); ?></span> 
                                        đã đủ số lượng ứng tuyển. <span style="color: red">Không thể ứng tuyển thêm.</span></p>
                                    <p class="text-warning"><?php echo e($notification->message); ?></p>
                                <?php elseif($notification->type == 'expired'): ?>
                                    <p>Công việc <span style="font-weight: 600; font-style :italic"><?php echo e($notification->job_title); ?></span> đã hết hạn ứng tuyển.</p>
                                <?php elseif($notification->type == 'job_near_expiration'): ?>
                                    <p>Công việc <span style="font-weight: 600; font-style: italic"><?php echo e($notification->job_title); ?></span> sẽ hết hạn trong <span style="color: red">3 ngày tới!</span></p>
                                <?php elseif($notification->type == 'deleted'): ?>
                                    <p>Nhà tuyển dụng <span style="font-weight: 600; font-style :italic"><?php echo e($notification->employer_name); ?></span> 
                                        đã xóa công việc <span style="font-weight: 600; font-style :italic"><?php echo e($notification->job_title); ?> mà bạn đã ứng tuyển</span></p>
                                <?php endif; ?>
                                <p class="text-muted">
                                    <small><?php echo e(\Carbon\Carbon::parse($notification->created_at)->diffForHumans()); ?></small>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </div>
            <?php echo e($notifications->links()); ?>

        <?php else: ?>
            <div class="container welcome-container">
                <div class="row">
                    <div class="col-12">
                        <img src="<?php echo e(asset('assets/user/images/notification_empty.png')); ?>" alt="Illustration" class="welcome-image mb-4">
                        <h2 class="mb-3">Chào mừng bạn đến với phần thông báo</h2>
                        <p class="mb-4">Khi nhà tuyển dụng liên hệ với bạn, bạn sẽ thấy thông báo ở đây</p>
                        <button class="btn btn-primary mb-2"><a href="<?php echo e(route('jobs')); ?>" style="color: white">Tìm việc làm</a></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customJs'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/account/notification.blade.php ENDPATH**/ ?>