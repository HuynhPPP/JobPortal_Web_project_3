<?php $__env->startSection('content'); ?>
  <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
    <div class="flex-grow-1">
      <h4 class="fs-18 fw-semibold mb-0">Quản lý tin việc làm</h4>
    </div>
    <form action="<?php echo e(route('admin.job')); ?>" class="row row-cols-lg-auto g-2 align-items-center">
      <div class="col">
        <input type="text" class="form-control" name="keyword" placeholder="Tên việc cần tìm ?"
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
        <div class="d-flex card-header justify-content-between align-items-center">
          <h4 class="header-title">Danh sách</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <?php if($jobs->isNotEmpty()): ?>
            <table class="table table-striped mb-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tiêu đề</th>
                  <th>Trạng thái</th>
                  <th>Tên ngành nghề</th>
                  <th>Thời gian</th>
                  <th class="text-center">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td><?php echo e($item->title); ?></td>
                    <td>
                      <?php if($item->status == env('STATUS_APPROVED')): ?>
                        <span>Đã duyệt</span>
                      <?php elseif($item->status == env('STATUS_PENDING')): ?>
                        <span>Chờ duyệt</span>
                      <?php elseif($item->status == env('STATUS_LOCKED')): ?>
                        <span>Đã khóa</span>
                      <?php endif; ?>
                    </td>
                    <td><?php echo e($item->career->name); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')); ?></td>
                    <td class="text-muted text-center">
                      <a href="<?php echo e(route('admin.edit.job', $item->id)); ?>" class="link-reset fs-20 p-1">
                        <?php echo file_get_contents(public_path('admin/icon/pencil.svg')); ?></i></a>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php echo e($jobs->links()); ?>

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

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/admin/job/list.blade.php ENDPATH**/ ?>