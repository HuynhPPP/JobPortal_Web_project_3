<?php $__env->startSection('main'); ?>
    <section class="section-0 lazy d-flex bg-image-style dark align-items-center">
        <div class="container-fluid p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/user/images/banner6.jpg" class="d-block w-100 carousel-image" alt="Banner 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Tìm công việc mơ ước của bạn</h1>
                            <p>Hàng ngàn công việc đang chờ bạn.</p>
                            <a href="<?php echo e(route('jobs')); ?>" class="btn btn-primary mt-3">Khám phá ngay</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/user/images/banner4.jpg" class="d-block w-100 carousel-image" alt="Banner 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Cơ hội nghề nghiệp cho bạn</h1>
                            <p>Truy cập để khám phá cơ hội tuyệt vời.</p>
                            <a href="<?php echo e(route('jobs')); ?>" class="btn btn-primary mt-3">Khám phá ngay</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/user/images/banner5.jpg" class="d-block w-100 carousel-image" alt="Banner 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Kết nối với nhà tuyển dụng</h1>
                            <p>Tìm kiếm việc làm nhanh chóng và dễ dàng.</p>
                            <a href="<?php echo e(route('jobs')); ?>" class="btn btn-primary mt-3">Khám phá ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-1 py-5 "> 
        <div class="container">
            <div class="card border-0 shadow p-5">
                <form action="" name="searchFormHome" id="searchFormHome">
                    <div class="row">
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Ví dụ: PHP">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <select class="form-select" id="province" name="province">
                                <option selected>Chọn tỉnh / thành phố</option>
                            </select>
                            <input type="hidden" id="province_name" name="province_name" value="<?php echo e(Request::get('province_name')); ?>">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <select name="career" id="career" class="form-select">
                                <option value="">Chọn ngành nghề</option>
                                <?php if($newCareers->isNotEmpty()): ?>
                                    <?php $__currentLoopData = $newCareers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($career->id); ?>"><?php echo e($career->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </form>            
            </div>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>✨ Ngành nghề phổ biến</h2>
            <div class="row pt-5">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                        <div class="row">
                            <div id="careerCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php if($careers->isNotEmpty()): ?>   
                                        <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                                <div class="row justify-content-center text-center">
                                                    <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-3">
                                                            <a href="<?php echo e(route('jobs').'?career='.$career->id); ?>" class="card shadow-sm p-3 mb-4 fixed-card" style="z-index: 10">
                                                                <div class="card-body">
                                                                    <h5 class="card-title fs-5"><?php echo e($career->name); ?></h5>
                                                                    <p class="card-text text-muted"><?php echo e($career->jobs_count); ?> Việc Làm</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>   
                                </div>
                            </div>               
                    </div>
                    </div>
                </div>         
            </div>
        </div>
    </section>

    <section class="section-3 py-5 job_popular_home">
        <div class="container">
            <h2>🔥 Công việc nổi bật</h2>
            <div class="row pt-5">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                        <div class="row">
                            <?php if($featureJobs->isNotEmpty()): ?>
                                <?php $__currentLoopData = $featureJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featureJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4" style="height: auto">
                                            <div class="card-body">
                                                <div class="d-flex home_jobs">
                                                    <div class="col-10">
                                                        <img alt="" 
                                                            class="company-logo" 
                                                            height="50" 
                                                            src="<?php echo e(asset('assets/user/profile_picture/thumb/'.($featureJob->user->image ?? 'logo-page.jpg'))); ?>" 
                                                            width="50"
                                                            style="max-width: 100px;
                                                                    max-height: 100px;
                                                                    "
                                                        />
                                                    </div>
                                                    <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
                                                    <div class="jobs_right col-2">
                                                        <div class="apply_now">
                                                            <a class="heart_mark" href="javascript:void(0);" onclick="saveJobHeart(<?php echo e($featureJob->id); ?>, this)">
                                                                <i class="fa <?php echo e($featureJob->is_saved ? 'fa-heart' : 'fa-heart-o'); ?>" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                    
                                                <h3 class="border-0 fs-5 pb-2 mb-0 mt-3">
                                                    <?php echo e(Str::words(strip_tags($featureJob->title), 5)); ?>

                                                </h3>

                                                <?php if(!empty($featureJob->company_name)): ?>
                                                    <p><?php echo e(Str::words(strip_tags($featureJob->company_name), 6)); ?></p>
                                                <?php endif; ?>

                                                <div class="bg-light p-3 border">
                                                    <?php if(empty($featureJob->province) && empty($featureJob->district)): ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1" style="color: red">Vị trí công ty chưa cập nhật</span>
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1"><?php echo e($featureJob->district); ?>, <?php echo e($featureJob->province); ?></span>
                                                        </p>
                                                    <?php endif; ?>

                                                    <?php if(empty($featureJob->jobType->name)): ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1" style="color: red">Hình thức làm việc chưa cập nhật</span>
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1"><?php echo e($featureJob->jobType->name); ?></span>
                                                        </p>
                                                    <?php endif; ?>

                                                    <?php if(Auth::check() && !is_null($featureJob->salary)): ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1"><?php echo e($featureJob->salary); ?></span>
                                                        </p>
                                                    <?php elseif(is_null($featureJob->salary)): ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1" style="color: red">Mức lương chưa cập nhật</span>
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1" style="color: red">Đăng nhập để xem mức lương</span>
                                                        </p>
                                                    <?php endif; ?>
                                            
                                                </div>

                                                <div class="keywords-section mt-3">
                                                    <div class="d-flex gap-2 mt-2">
                                                        <?php
                                                            $keywords = explode(',', $featureJob->keywords); 
                                                        ?>
                                                        <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($index < 3): ?> 
                                                                <a href="<?php echo e(route('jobs', ['keyword' => trim($keyword)])); ?>" class="keyword-badge">
                                                                    <?php echo e(trim($keyword)); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(count($keywords) > 3): ?> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
                                                        <a href="<?php echo e(route('JobDetail_employer',$featureJob->id)); ?>" class="btn bg-danger btn-lg text-white">Chi tiết</a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('jobDetail',$featureJob->id)); ?>" class="btn bg-danger btn-lg text-white">Chi tiết</a>
                                                    <?php endif; ?>       
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>              
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Công việc mới nhất</h2>
            <div class="row pt-5">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                        <div class="row">
                            <?php if($latesJobs->isNotEmpty()): ?>
                                <?php $__currentLoopData = $latesJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latesJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4" style="height: auto">
                                            <div class="card-body">
                                                <div class="d-flex home_jobs">
                                                    <div class="col-10">
                                                        <img alt="" 
                                                            class="company-logo" 
                                                            height="50" 
                                                            src="<?php echo e(asset('assets/user/profile_picture/thumb/'.($latesJob->user->image ?? 'logo-page.jpg'))); ?>" 
                                                            width="50"
                                                            style="max-width: 100px; max-height: 100px;"
                                                        />
                                                    </div>
                                                    <?php if(Auth::check() && Auth::user()->role === 'user'): ?>
                                                    <div class="jobs_right col-2">
                                                        <div class="apply_now">
                                                            <a class="heart_mark" href="javascript:void(0);" onclick="saveJobHeart(<?php echo e($latesJob->id); ?>, this)">
                                                                <i class="fa <?php echo e($latesJob->is_saved ? 'fa-heart' : 'fa-heart-o'); ?>" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <h3 class="border-0 fs-5 pb-2 mb-0 mt-3">
                                                    <?php echo e(Str::words(strip_tags($latesJob->title), 5)); ?>

                                                </h3>

                                                <?php if(!empty($latesJob->company_name)): ?>
                                                    <p><?php echo e(Str::words(strip_tags($latesJob->company_name), 6)); ?></p>
                                                <?php endif; ?>
                                                

                                                <div class="bg-light p-3 border">
                                                    <?php if(empty($latesJob->province) && empty($latesJob->district)): ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1" style="color: red">Vị trí công ty chưa cập nhật</span>
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1"><?php echo e($latesJob->district); ?>, <?php echo e($latesJob->province); ?></span>
                                                        </p>
                                                    <?php endif; ?>

                                                    <?php if(empty($latesJob->jobType->name)): ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1" style="color: red">Hình thức làm việc chưa cập nhật</span>
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1"><?php echo e($latesJob->jobType->name); ?></span>
                                                        </p>
                                                    <?php endif; ?>
    
                                                    <?php if(Auth::check() && !is_null($latesJob->salary)): ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1"><?php echo e($latesJob->salary); ?></span>
                                                        </p>
                                                    <?php elseif(is_null($latesJob->salary)): ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1" style="color: red">Mức lương chưa cập nhật</span>
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1" style="color: red">Đăng nhập để xem mức lương</span>
                                                        </p>
                                                    <?php endif; ?>                                         
                                                </div>

                                                <?php if(empty($latesJob->keywords)): ?>
                                                    <p class="mt-3">Từ khoá: <span style="color: red">Chưa cập nhật</span></p>
                                                <?php else: ?>
                                                <div class="keywords-section mt-3">
                                                    <div class="d-flex gap-2 mt-2">
                                                        <?php
                                                            $keywords = explode(',', $latesJob->keywords); 
                                                        ?>
                                                        <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($index < 3): ?> 
                                                                <a href="<?php echo e(route('jobs', ['keyword' => trim($keyword)])); ?>" class="keyword-badge">
                                                                    <?php echo e(trim($keyword)); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(count($keywords) > 3): ?> 
                                                            <span>...</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                                                        
            
                                                <div class="d-grid mt-3">
                                                    <?php if(Auth::check() && Auth::user()->role === 'employer'): ?>
                                                        <a href="<?php echo e(route('JobDetail_employer',$latesJob->id)); ?>" class="btn btn-primary btn-lg">Chi tiết</a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('jobDetail',$latesJob->id)); ?>" class="btn btn-primary btn-lg">Chi tiết</a>
                                                    <?php endif; ?>  
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customJs'); ?>
    <script>
        $("#searchFormHome").submit(function(e){
            e.preventDefault();

            var url = '<?php echo e(route("jobs")); ?>?';

            var keyword = $("#keyword").val();
            var province = $("#province").val();
            var provinceName = $("#province_name").val();
            var career = $("#career").val();


        
            if (keyword != ""){
                url += '&keyword='+keyword;
            }

            if (province != ""){
                url += '&province='+encodeURIComponent(provinceName);
            } else if (province == "") {
                url += '&province='+'notfound';
            }

            if (career != ""){
                url += '&career='+career;
            }


            window.location.href=url;
        });
    </script>

    <script>
        $(document).ready(function() {
            $.getJSON('/api/proxy/provinces', function(data_tinh) {
                if (data_tinh.error === 0) {
                    $.each(data_tinh.data, function(key_tinh, val_tinh) {
                        $("#province").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
                    });
                }
            });

            $("#province").change(function() {
                var selectedOption = $(this).find("option:selected");
                $("#province_name").val(selectedOption.text());
            });
        });
    </script>

    <script>
        function saveJobHeart(id, element) {
            event.preventDefault();
            $.ajax({
                    url: '<?php echo e(route("saveJob")); ?>',
                    type: 'post',
                    data: {id: id},
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

    <script>
        $(document).ready(function () {
            var carousel = $("#careerCarousel");

            // Biến để lưu trạng thái kéo
            var isDragging = false;
            var startX;

            // Bắt đầu kéo
            carousel.on("mousedown touchstart", function (e) {
                isDragging = true;
                startX = e.pageX || e.originalEvent.touches[0].pageX;
            });

            // Kéo chuột hoặc chạm di chuyển
            carousel.on("mousemove touchmove", function (e) {
                if (!isDragging) return;
                var x = e.pageX || e.originalEvent.touches[0].pageX;
                if (x - startX > 50) {
                    // Di chuyển qua slide trước
                    $(this).carousel("prev");
                    isDragging = false;
                } else if (startX - x > 50) {
                    // Di chuyển qua slide sau
                    $(this).carousel("next");
                    isDragging = false;
                }
            });

            // Kết thúc kéo
            carousel.on("mouseup touchend", function () {
                isDragging = false;
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/front/home.blade.php ENDPATH**/ ?>