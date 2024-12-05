<?php $__env->startSection('content'); ?>
  <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
    <div class="flex-grow-1">
      <h4 class="fs-18 fw-semibold mb-0">Quản lý ứng viên</h4>
    </div>
    <form action="<?php echo e(route('admin.user')); ?>" class="row row-cols-lg-auto g-2 align-items-center">
      <div class="col">
        <input type="text" class="form-control" name="keyword" placeholder="Họ tên ?"
          value="<?php echo e(Request::get('keyword')); ?>">
      </div>
      <div class="col">
        <input class="form-control" value="<?php echo e(Request::get('date')); ?>" id="example-date" type="date" name="date">
      </div>
      <div class="col">
        <button type="submit" class="btn btn-success">Tìm kiếm</button>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-bottom border-dashed">
          <div class="row d-flex align-items-center">
            <h4 class="header-title">Danh sách</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <?php if($users->isNotEmpty()): ?>
            <table class="table table-striped mb-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Họ tên</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Trạng thái</th>
                  <th>Ngày tạo</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td><?php echo e($user->fullname); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->mobile ? $user->mobile : '...'); ?></td>
                    <td>
                      <?php if($user->status == env('STATUS_ACTIVE')): ?>
                        <span>Hoạt động</span>
                      <?php elseif($user->status == env('STATUS_INACTIVE')): ?>
                        <span>Đã khóa</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php echo e(\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')); ?>

                    </td>
                    <td class="text-muted">
                      <a href="<?php echo e(route('admin.edit.user', $user->id)); ?>" class="link-reset fs-20 p-1">
                        <?php echo file_get_contents(public_path('admin/icon/pencil.svg')); ?></i></a>
                      <form id="deleteForm" class="d-inline" method="POST"
                        action="<?php echo e(route('admin.delete.user', $user->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="button" class="link-reset fs-20 p-1 border-0 bg-transparent delete">
                          <?php echo file_get_contents(public_path('admin/icon/trash.svg')); ?></button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php echo e($users->links()); ?>

          <?php else: ?>
            <div class="text-center">
              <span>Không có dữ liệu</span>
            </div>
          <?php endif; ?>
        </div> <!-- end table-responsive-->
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/admin/user/list.blade.php ENDPATH**/ ?>