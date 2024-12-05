<?php $__env->startSection('main'); ?>
  <section class="section-4 bg-2">
    <div class="container pt-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Trang chủ</a></li>
              <li class="breadcrumb-item active">Chi tiết việc làm</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="container job_details_area">
      <div class="row pb-5">
        <div class="col-md-8">
          <div class="card shadow border-0">
            <div class="job_details_header">
              <div class="single_jobs white-bg d-flex justify-content-between">
                <div class="jobs_left d-flex align-items-center">
                  <div class="jobs_conetent">
                    <div class="d-flex align-items-center mb-3 me-md-auto text-dark">
                      <img src="<?php echo e(asset('assets/user/profile_picture/thumb/' . $job->user->image)); ?>" class="bi me-2"
                        alt="logo" width="40" height="32"
                        style="width: 15%;
                                                                                                      background: #fff;
                                                                                                      border-radius: 8px;
                                                                                                      box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.08);">
                      <span class="fs-4" style="margin-left: 10px; color: #212529"><?php echo e($job->title); ?></span>
                    </div>

                    <div class="links_locat d-flex align-items-center">
                      <div class="location d-flex align-items-center">
                        <i class="fa fa-map-marker" style="margin-right: 7px"></i>
                        <?php if(!empty($job->province) && !empty($job->district)): ?>
                          <p><?php echo e($job->district); ?>, <?php echo e($job->province); ?></p>
                        <?php else: ?>
                          <p style="color: red">Chưa cập nhật</p>
                        <?php endif; ?>
                      </div>
                      <div class="location d-flex align-items-center">
                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 7px"></i>
                        <p><?php echo e($job->jobType->name); ?></p>
                      </div>
                    </div>
                    <div class="links_locat d-flex align-items-center mt-3">
                      <div class="location d-flex align-items-center">
                        <i class="fa fa-calendar" style="margin-right: 7px"></i>
                        <p>
                          Ngày đăng tuyển: <?php echo e(\Carbon\Carbon::parse($job->created_at)->format('d-m-Y')); ?>

                          <?php if($job->expiration_date): ?>
                            <?php
                              $daysLeft = \Carbon\Carbon::now()->diffInDays(
                                  \Carbon\Carbon::parse($job->expiration_date),
                                  false,
                              );
                              if ($daysLeft < 1) {
                                  $daysLeft = 1;
                              }
                              $textColor = '';
                              if ($daysLeft < 3) {
                                  $textColor = 'color: red;';
                              } elseif ($daysLeft < 10) {
                                  $textColor = 'color: #FBBF24;';
                              }
                            ?>
                            <?php if($daysLeft >= 0): ?>
                              - <span>Hết hạn trong: <span style="<?php echo e($textColor); ?>"><?php echo e($daysLeft); ?> ngày
                                  tới</span></span>
                            <?php endif; ?>
                          <?php endif; ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="jobs_right">
                  <div class="apply_now">
                    <a class="heart_mark" href="javascript:void(0);" onclick="saveJobHeart(<?php echo e($job->id); ?>, this)">
                      <i class="fa <?php echo e($count == 1 ? 'fa-heart' : 'fa-heart-o'); ?>" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="descript_wrap white-bg">
              <div class="single_wrap">
                <h4 style="color: #1E40AF; font-weight:600">Mô tả công việc</h4>
                <?php if(empty($job->description)): ?>
                  <?php echo nl2br('Chưa có thông tin'); ?>

                <?php endif; ?>
                <?php echo nl2br($job->description); ?>

              </div>
              <div class="single_wrap">
                <h4 style="color: #1E40AF; font-weight:600">Trách nhiệm công việc</h4>
                <?php if(empty($job->responsibility)): ?>
                  <?php echo nl2br('Chưa có thông tin'); ?>

                <?php endif; ?>
                <?php echo nl2br($job->responsibility); ?>

              </div>
              <div class="single_wrap">
                <h4 style="color: #1E40AF; font-weight:600">Kỹ năng & Chuyên môn</h4>
                <?php if(empty($job->qualifications)): ?>
                  <?php echo nl2br('Chưa có thông tin'); ?>

                <?php endif; ?>
                <?php echo nl2br($job->qualifications); ?>

              </div>
              <div class="single_wrap">
                <h4 style="color: #1E40AF; font-weight:600">Phúc lợi dành cho bạn</h4>
                <?php if(empty($job->benefits)): ?>
                  <?php echo nl2br('Chưa có thông tin'); ?>

                <?php endif; ?>
                <?php echo nl2br($job->benefits); ?>

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
              <?php
                  $hasApplied = \App\Models\JobApplication::where('job_id', $job->id)
                      ->where('user_id', Auth::id())
                      ->exists();
              ?>

              <?php if($hasApplied): ?>
                  <div class="pt-3">
                      <button class="btn btn-success w-100 fs-5" disabled>
                          Bạn đã nộp đơn cho công việc này
                      </button>
                  </div>
              <?php else: ?>
                  <div class="pt-3">
                      <button class="btn btn-primary w-100 fs-5" data-bs-toggle="modal" data-bs-target="#applyJobModal">
                          Xin việc ngay
                      </button>
                  </div>
              <?php endif; ?>
          <?php else: ?>
              <div class="pt-3">
                  <a href="<?php echo e(route('account.login')); ?>" class="btn btn-primary w-100 fs-5">Đăng nhập để xin việc</a>
              </div>
          <?php endif; ?>
          <div class="card shadow border-0 my-4">
            <div class="job_sumary">
              <div class="summery_header pb-1 pt-4">
                <h3>Thông tin chung</h3>
              </div>
              <div class="divider"><span></span></div>
              <div class="job_content pt-3">
                <ul>
                  <li>Thời điểm đăng: <span><?php echo e(\Carbon\Carbon::parse($job->created_at)->diffForHumans()); ?></span></li>
                  <li>
                    <?php if(empty($job->job_level)): ?>
                      Cấp bậc: <span style="color: red">chưa cập nhật</span>
                    <?php else: ?>
                      Cấp bậc: <span><?php echo e($job->job_level); ?></span>
                    <?php endif; ?>
                  </li>
                  <li>
                    <?php if(empty($job->salary)): ?>
                      Mức lương: <span style="color: red">chưa cập nhật</span>
                    <?php else: ?>
                      Mức lương: <span style="color: #0069DB "><?php echo e($job->salary); ?></span>
                    <?php endif; ?>
                  </li>
                  <li>
                    <?php if(empty($job->experience)): ?>
                      Năm kinh nghiệm tối thiểu: <span style="color: red">chưa cập nhật</span>
                    <?php else: ?>
                      Năm kinh nghiệm tối thiểu: <span><?php echo e($job->experience); ?> năm</span>
                    <?php endif; ?>
                  </li>
                  <li>
                    <?php if(empty($job->jobType->name)): ?>
                      Hình thức làm việc: <span style="color: red">chưa cập nhật</span>
                    <?php else: ?>
                      Hình thức làm việc: <span> <?php echo e($job->jobType->name); ?></span>
                    <?php endif; ?>
                  </li>
                  <li>
                    <?php if(empty($job->keywords)): ?>
                      Từ khoá: <span style="color: red">chưa cập nhật</span>
                    <?php else: ?>
                      <div class="keywords-section-detail">
                        <div class="d-flex flex-wrap gap-2 mt-2">
                          <?php
                            $keywords = explode(',', $job->keywords);
                          ?>
                          Từ khoá:
                          <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('jobs', ['keyword' => trim($keyword)])); ?>"
                              class="keyword-badge-detail"><?php echo e(trim($keyword)); ?></a>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card shadow border-0 my-4">
            <div class="job_sumary">
              <div class="summery_header pb-1 pt-4">
                <h3>Thông tin chi tiết công ty</h3>
              </div>
              <div class="divider"><span></span></div>
              <div class="job_content pt-3">
                <ul>
                  <li>Tên công ty: <span><?php echo e($job->company_name); ?></span></li>
                  <li>
                    <?php if(!empty($job->location_detail)): ?>
                      Địa chỉ: <span><?php echo e($job->location_detail); ?></span>
                    <?php elseif(!empty($job->district) && !empty($job->district)): ?>
                      Địa chỉ: <span> <?php echo e($job->district); ?>, <?php echo e($job->province); ?></span>
                    <?php else: ?>
                      Địa chỉ: <span><?php echo e($job->location_detail); ?></span>
                    <?php endif; ?>
                  </li>
                  <li>
                    <?php if(empty($job->company_website)): ?>
                      Webite: <span style="color: red">chưa cập nhật</span>
                    <?php else: ?>
                      Webite: <span><a href="<?php echo e($job->company_website); ?>"
                          style="color: #0069DB"><?php echo e($job->company_website); ?></a></span>
                    <?php endif; ?>
                  </li>
                  <li>Nhà tuyển dụng: <span><?php echo e($job->user->fullname); ?></span></li>
                  <li>Email liên hệ: <span><?php echo e($job->user->email); ?></span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
  </section>

  <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
    <div class="modal fade" id="applyJobModal" tabindex="-1" aria-labelledby="applyJobModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="applyJobModalLabel">Bạn đang ứng tuyển tại công ty <?php echo e($job->company_name); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form id="applyJobForm" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo e($job->id); ?>">
              <?php echo csrf_field(); ?>
              <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="name" name="name"
                  value="<?php echo e(Auth::user()->fullname); ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                  value="<?php echo e(Auth::user()->email); ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <?php if(Auth::user()->mobile): ?>
                  <input type="text" class="form-control" id="phone" name="phone"
                    value="<?php echo e(Auth::user()->mobile); ?>" readonly>
                <?php else: ?>
                  <input type="text" class="form-control text-danger" id="phone" name="phone"
                    value="Bạn chưa cập nhật số điện thoại" readonly>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="cv" class="form-label">Nộp CV</label>
                <input type="file" class="form-control" id="cv" name="cv" required>
                <p></p>
              </div>
            </form>
          </div>


          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" onclick="submitApplication(<?php echo e($job->id); ?>)">Nộp
              đơn</button>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- Notification -->
  <div id="loading-overlay"
    style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255, 255, 255, 0.7); z-index:9999; text-align:center;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
      <div class="spinner-border" role="status">
        <span class="sr-only">Đang xử lý...</span>
      </div>
      <p>Đang xử lý, vui lòng đợi...</p>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customJs'); ?>
  <script type="text/javascript">
    function applyJob(id) {
      event.preventDefault();
      $('#applyJobModal').modal('show');
    }

    function submitApplication(id) {
      event.preventDefault();
      var formData = new FormData($('#applyJobForm')[0]);
      formData.append('id', id);

      $('#loading-overlay').show();

      $.ajax({
        url: '<?php echo e(route('applyJob')); ?>',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
          $('#loading-overlay').hide();

          toastr.clear();

          if (response.status === true) {
            $("#cv").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            toastr.success(response.message);
            $('#applyJobModal').modal('hide');

            setTimeout(function() {
              location.reload();
            }, 1000);
          } else {
            var errors = response.errors;
            toastr.warning('Có lỗi xảy ra...');

            if (errors.cv) {
              $("#cv").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.cv);
            } else {
              $("#cv").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
          }
        },
        error: function() {
          $('#loading-overlay').hide();
          toastr.clear();
          toastr.error('Có lỗi xảy ra, vui lòng thử lại.');
        }
      });
    }

    function saveJob(id) {
      event.preventDefault();
      $.ajax({
        url: '<?php echo e(route('saveJob')); ?>',
        type: 'post',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          // Hiển thị Toastr dựa trên phản hồi
          if (response.status === true) {
            toastr.success(response.message);
          } else {
            toastr.error(response.message);
          }
        },
        error: function() {
          toastr.error("Có lỗi xảy ra, vui lòng thử lại.");
        }
      });
    }

    function saveJobHeart(id, element) {
      event.preventDefault();
      $.ajax({
        url: '<?php echo e(route('saveJob')); ?>',
        type: 'post',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          if (response.status === false) {
            toastr.error(response.message);
          } else {
            if (response.action === 'saved') {
              $(element).find('i').removeClass('fa-heart-o').addClass('fa-heart');
              toastr.success('Đã thêm vào yêu thích');
            } else {
              $(element).find('i').removeClass('fa-heart').addClass('fa-heart-o');
              toastr.warning('Đã hủy yêu thích');
            }
          }
        }
      });
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/jobDetail.blade.php ENDPATH**/ ?>