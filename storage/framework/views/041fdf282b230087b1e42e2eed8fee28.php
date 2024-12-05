<?php $__env->startSection('main'); ?>
  <section class="section-3 py-5 bg-2 ">
    <div class="container">
      <div class="row">
        <div class="col-6 col-md-10 ">
          <h2>Tìm việc</h2>
        </div>
        <div class="col-6 col-md-2">
          <div class="align-end">
            <select name="sort" id="sort" class="form-control">
              <option value="1" <?php echo e(Request::get('sort') == '1' ? 'selected' : ''); ?>>Mới nhất</option>
              <option value="0" <?php echo e(Request::get('sort') == '0' ? 'selected' : ''); ?>>Cũ nhất</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row pt-5">
        <div class="col-md-4 col-lg-3 sidebar mb-4">
          <form action="" name="searchForm" id="searchForm">
            <div class="card border-0 shadow p-4">
              <div class="mb-4">
                <h2>Từ khoá</h2>
                <input value="<?php echo e(Request::get('keyword')); ?>" type="text" name="keyword" id="keyword"
                  placeholder="Nhập từ khoá..." class="form-control">
              </div>

              <div class="mb-4">
                <h2>Tỉnh / thành phố</h2>
                <select class="form-select" id="province" name="province">
                  <option value="" <?php echo e(Request::get('province') ? '' : 'selected'); ?>>Chọn tỉnh / thành</option>
                </select>
                <input type="hidden" id="province_name" name="province_name" value="<?php echo e(Request::get('province_name')); ?>">
              </div>

              <div class="mb-4">
                <h2>Ngành nghề</h2>
                <select name="career" id="career" class="form-select">
                  <option value="">Chọn ngành nghề</option>
                  <?php if($careers->isNotEmpty()): ?>
                    <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php echo e(Request::get('career') == $career->id ? 'selected' : ''); ?> value="<?php echo e($career->id); ?>">
                        <?php echo e($career->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </select>
              </div>

              <div class="mb-4">
                <h2>Loại công việc</h2>

                <?php if($jobTypes->isNotEmpty()): ?>
                  <?php $__currentLoopData = $jobTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check mb-2">
                      <input <?php echo e(in_array($jobType->id, $jobTypeArray) ? 'checked' : ''); ?> class="form-check-input "
                        name="job_type" type="checkbox" value="<?php echo e($jobType->id); ?>" id="job-type-<?php echo e($jobType->id); ?>">
                      <label class="form-check-label " for="job-type-<?php echo e($jobType->id); ?>"><?php echo e($jobType->name); ?></label>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </div>

              <div class="mb-4">
                <h2>Kinh nghiệm</h2>
                <select name="experience" id="experience" class="form-select">
                  <option value="">Chọn kinh nghiệm</option>
                  <option value="1" <?php echo e(Request::get('experience') == 1 ? 'selected' : ''); ?>>1 Năm</option>
                  <option value="2" <?php echo e(Request::get('experience') == 2 ? 'selected' : ''); ?>>2 Năm</option>
                  <option value="3" <?php echo e(Request::get('experience') == 3 ? 'selected' : ''); ?>>3 Năm</option>
                  <option value="4" <?php echo e(Request::get('experience') == 4 ? 'selected' : ''); ?>>4 Năm</option>
                  <option value="5" <?php echo e(Request::get('experience') == 5 ? 'selected' : ''); ?>>5 Năm</option>
                  <option value="6" <?php echo e(Request::get('experience') == 6 ? 'selected' : ''); ?>>6 Năm</option>
                  <option value="7" <?php echo e(Request::get('experience') == 7 ? 'selected' : ''); ?>>7 Năm</option>
                  <option value="8" <?php echo e(Request::get('experience') == 8 ? 'selected' : ''); ?>>8 Năm</option>
                  <option value="9" <?php echo e(Request::get('experience') == 9 ? 'selected' : ''); ?>>9 Năm</option>
                  <option value="10" <?php echo e(Request::get('experience') == 10 ? 'selected' : ''); ?>>10 Năm</option>
                  <option value="10_plus" <?php echo e(Request::get('experience') == '10_plus' ? 'selected' : ''); ?>>Hơn 10 Năm
                  </option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Tìm kiếm</button>
              <a href="<?php echo e(route('jobs')); ?>" class="btn btn-secondary mt-3">Làm mới</a>
            </div>
          </form>
        </div>
        <div class="col-md-8 col-lg-9">
          <div class="job_listing_area">
            <div class="job_lists">
              <div class="row">
                <?php if($jobs->isNotEmpty()): ?>
                  <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6">
                      <div class="card border-0 p-3 shadow mb-4" style="height: 400px">
                        <?php if($job->isFeatured === 1): ?>
                          <div class="ilabel position-absolute ilabel-warning end-0">
                            HOT
                          </div>
                        <?php endif; ?>
                        <div class="card-body mt-4">
                          <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
                            <a href="<?php echo e(route('JobDetail_employer', $job->id)); ?>" class="text-dark">
                              <h3 class="border-0 fs-5 pb-2 mb-0 d-inline"><?php echo e($job->title); ?></h3>
                            </a>
                          <?php else: ?>
                            <a href="<?php echo e(route('jobDetail', $job->id)); ?>" class="text-dark">
                              <h3 class="border-0 fs-5 pb-2 mb-0 d-inline"><?php echo e($job->title); ?></h3>
                            </a>
                          <?php endif; ?>
                          <p><?php echo e($job->company_name); ?></p>
                          <div class="bg-light p-3 border">
                            <?php if(empty($job->province) && empty($job->district)): ?>
                              <p class="mb-0">
                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                <span class="ps-1" style="color: red">Chưa cập nhật</span>
                              </p>
                            <?php else: ?>
                              <p class="mb-0">
                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                <span class="ps-1"><?php echo e($job->district); ?>, <?php echo e($job->province); ?></span>
                              </p>
                            <?php endif; ?>

                            <?php if(empty($job->jobType->name)): ?>
                              <p class="mb-0">
                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                <span class="ps-1" style="color: red">Chưa cập nhật</span>
                              </p>
                            <?php else: ?>
                              <p class="mb-0">
                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                <span class="ps-1"><?php echo e($job->jobType->name); ?></span>
                              </p>
                            <?php endif; ?>

                            <?php if(!is_null($job->salary)): ?>
                              <p class="mb-0">
                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                <span class="ps-1"><?php echo e($job->salary); ?></span>
                              </p>
                            <?php else: ?>
                              <p class="mb-0">
                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                <span class="ps-1" style="color: red">Chưa cập nhật</span>
                              </p>
                            <?php endif; ?>
                          </div>

                          <div class="d-grid">
                            <hr>
                            <?php if(empty($job->keywords)): ?>
                              <p>Từ khoá: <span style="color: red">Chưa cập nhật</span></p>
                            <?php else: ?>
                              <div class="keywords-section">
                                <div class="d-flex flex-wrap gap-2">
                                  <?php
                                    $keywords = explode(',', $job->keywords);
                                  ?>
                                  <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($index < 4): ?>
                                      <a href="<?php echo e(route('jobs', ['keyword' => trim($keyword)])); ?>"
                                        class="keyword-badge">
                                        <?php echo e(trim($keyword)); ?>

                                      </a>
                                    <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php if(count($keywords) > 4): ?>
                                    <span>...</span>
                                  <?php endif; ?>
                                </div>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <div class="col-md-12">
                    <div class="card-error-find">
                      <div class="card-body-error-find">
                        <img alt="Illustration of a piggy bank with a magnifying glass" height="100"
                          src="https://storage.googleapis.com/a1aa/image/wbdDxuRHo2aDNtL5eFnlzmLSJ5fXAOdRDeHnXiZSLwjffvSdC.jpg"
                          width="100" />
                        <div class="text-content">
                          <h5 class="mt-3">
                            Oops! Không tìm thấy công việc phù hợp
                          </h5>
                          <p>
                            TopWork chưa tìm thấy công việc bạn tìm kiếm vào lúc này.
                            <br />
                            Thử lại bằng cách áp dụng từ khóa và bộ lọc khác.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php echo e($jobs->links()); ?>

        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customJs'); ?>
  <script>
    $("#searchForm").submit(function(e) {
      e.preventDefault();

      var url = '<?php echo e(route('jobs')); ?>?';

      var keyword = $("#keyword").val();
      var province = $("#province").val();
      var provinceName = $("#province_name").val();
      var career = $("#career").val();
      var experience = $("#experience").val();
      var sort = $("#sort").val();

      var checkedJobTypes = $("input:checkbox[name='job_type']:checked").map(function() {
        return $(this).val();
      }).get();


      if (keyword != "") {
        url += '&keyword=' + keyword;
      }

      if (province != "") {
        url += '&province=' + encodeURIComponent(provinceName);
      } else if (province == "") {
        url += '&province=' + 'notfound';
      }

      if (career != "") {
        url += '&career=' + career;
      }

      if (experience != "") {
        url += '&experience=' + experience;
      }

      if (checkedJobTypes.length > 0) {
        url += '&jobType=' + checkedJobTypes;
      }

      url += '&sort=' + sort

      window.location.href = url;
    });

    $("sort").change(function() {
      $("#searchForm").submit();
    });
  </script>

  <script>
    $(document).ready(function() {
      // Lấy giá trị `province` từ server
      var selectedProvinceId = "<?php echo e(Request::get('province')); ?>";

      // Gọi API để lấy danh sách tỉnh
      $.getJSON('/api/proxy/provinces', function(data_tinh) {
        if (data_tinh.error === 0) {
          $.each(data_tinh.data, function(key_tinh, val_tinh) {
            // Kiểm tra nếu id tỉnh trùng với giá trị từ request
            var isSelected = val_tinh.id == selectedProvinceId ? 'selected' : '';
            $("#province").append('<option value="' + val_tinh.id + '" ' + isSelected + '>' + val_tinh
              .full_name + '</option>');
          });
        }
      });

      // Cập nhật hidden input khi chọn tỉnh
      $("#province").change(function() {
        var selectedOption = $(this).find("option:selected");
        $("#province_name").val(selectedOption.text());
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/jobs.blade.php ENDPATH**/ ?>