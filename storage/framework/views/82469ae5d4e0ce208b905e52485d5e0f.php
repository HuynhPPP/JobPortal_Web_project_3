<?php $__env->startSection('content'); ?>
  <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
    <div class="flex-grow-1">
      <h4 class="fs-18 fw-semibold mb-0">Quản lý ngành nghề</h4>
    </div>
    <form action="<?php echo e(route('admin.career')); ?>" class="row row-cols-lg-auto g-2 align-items-center">
      <div class="col">
        <input type="text" class="form-control" name="keyword" placeholder="Tên ngành nghề cần tìm ?"
          value="<?php echo e(Request::get('keyword')); ?>">
      </div>
      <div class="col">
        <input class="form-control" id="example-date" type="date" name="date" lang="vi-VN"
          value="<?php echo e(Request::get('date')); ?>">
      </div>
      <div class="col">
        <button type="submit" class="btn btn-success">Tìm kiếm</button>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-xl-5">
      <div class="card">
        <div class="d-flex card-header justify-content-between align-items-center">
          <h4 class="header-title">Thêm mới</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <form class="needs-validation" method="POST" action="<?php echo e(route('admin.create.career')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
              <label class="form-label" for="validationCustom01">Tên ngành nghề</label>
              <input type="text" placeholder="ví dụ: công nghệ thông tin"
                class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  is-invalid
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                value="<?php echo e(old('name')); ?>">
              <?php if($errors->has('name')): ?>
                <span class="invalid-feedback"><?php echo e($errors->first('name')); ?></span>
              <?php endif; ?>
            </div>
            <div class="mb-3">
              <label class="form-label" for="validationCustom02">Trạng thái</label>
              <select class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  is-invalid
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                name="status">
                <option value="" selected>---Vui lòng chọn---</option>
                <option value="1">Hoạt động</option>
                <option value="0">Tạm dừng</option>
              </select>
              <span class="invalid-feedback"><?php echo e($errors->first('status')); ?></span>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="isPopular" id="isPopular"
                  value="<?php echo e(env('POPULAR')); ?>">
                <label class="form-check-label" for="isPopular">Phổ biến</label>
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Xử lý</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-xl-7">
      <div class="card">
        <div class="d-flex card-header justify-content-between align-items-center">
          <h4 class="header-title">Danh sách</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <?php if($careers->isNotEmpty()): ?>
            <table class="table table-striped mb-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tên ngành nghề</th>
                  <th>Trạng thái</th>
                  <th>Thời gian</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td><?php echo e($item->name); ?></td>
                    <td>
                      <?php if($item->status == env('STATUS_ACTIVE')): ?>
                        <span>Hoạt động</span>
                      <?php elseif($item->status == env('STATUS_INACTIVE')): ?>
                        <span>Tạm dừng</span>
                      <?php endif; ?>
                    </td>
                    <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')); ?></td>
                    <td class="text-muted">
                      <a href="<?php echo e(route('admin.getEditCareer.career', ['id' => $item->id])); ?>"
                        class="link-reset fs-20 p-1">
                        <?php echo file_get_contents(public_path('admin/icon/pencil.svg')); ?></a>
                      <form id="deleteForm" class="d-inline" method="POST"
                        action="<?php echo e(route('admin.deleteCareer.career', $item->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="button"class="link-reset fs-20 p-1 border-0 bg-transparent delete">
                          <?php echo file_get_contents(public_path('admin/icon/trash.svg')); ?></button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php echo e($careers->links()); ?>

          <?php else: ?>
            <div class="text-center">
              <span>Không có dữ liệu</span>
            </div>
          <?php endif; ?>
        </div> <!-- end table-responsive-->
      </div>
    </div>
  </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/admin/career/list.blade.php ENDPATH**/ ?>