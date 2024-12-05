<div class="card border-0 shadow mb-4 p-3">
    <div class="card-body text-center mt-3">

        <?php if(Auth::user()->image != ''): ?>
            <img src="<?php echo e(asset('assets/user/profile_picture/thumb/'.Auth::user()->image)); ?>" alt="avatar"  class="img-fluid rounded-circle" style="width: 150px; height: 150xp">
        <?php else: ?>
            <img src="<?php echo e(asset('assets/user/images/avatar7.png')); ?>" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
        <?php endif; ?>
        
        <h5 class="mt-3 pb-0"><?php echo e(Auth::user()->fullname); ?></h5>
        <p class="text-muted mb-1 fs-6"><?php echo e(Auth::user()->designation); ?></p>
        <div class="d-flex justify-content-center mb-2 mt-3">
            <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Đổi ảnh đại diện</button>
            <?php endif; ?>
            <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Đổi logo công ty</button>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="<?php echo e(route("account.profile")); ?>">Thông tin tài khoản</a>
            </li>
            <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="<?php echo e(route("account.createJob")); ?>">Đăng bài tuyển dụng</a>
            </li>
            <?php endif; ?>
            <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="<?php echo e(route("account.myJobs")); ?>">Công việc đã đăng</a>
            </li>
            <?php endif; ?>
            <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="<?php echo e(route("account.myJobApplication")); ?>">Công việc đã ứng tuyển</a>
            </li>
            <?php endif; ?>
            <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="<?php echo e(route("account.savedJobs")); ?>">Công việc yêu thích</a>
            </li>   
            <?php endif; ?>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="<?php echo e(route('account.logout')); ?>">Đăng xuất</a>
            </li>                                                         
        </ul>
    </div>
</div><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/account/sidebar.blade.php ENDPATH**/ ?>