@extends('front.layouts.app')

@section('main')
<section class="section-0 lazy d-flex bg-image-style dark align-items-center "   class="" data-bg="assets/user/images/banner5.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Tìm công việc mơ ước của bạn</h1>
                <p>Hàng ngàn công việc đang chờ bạn.</p>
                <div class="banner-btn mt-5"><a href="{{ route("jobs") }}" class="btn btn-primary mb-4 mb-sm-0">Khám phá ngay</a></div>
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
                            <option selected>Chọn khu vực</option>
                        </select>
                        <input type="hidden" id="province_name" name="province_name" value="{{ Request::get('province_name') }}">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="career" id="career" class="form-select">
                            <option value="">Chọn lĩnh vực</option>
                            @if ($newCareers->isNotEmpty())
                                @foreach ($newCareers as $career)
                                    <option value="{{ $career->id }}">{{ $career->name }}</option>
                                @endforeach 
                            @endif
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
                                @if ($careers->isNotEmpty())   
                                    @foreach ($careers as $index => $group)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <div class="row justify-content-center text-center">
                                                @foreach ($group as $career)
                                                    <div class="col-md-3">
                                                        <a href="{{ route('jobs').'?career='.$career->id }}" class="card shadow-sm p-3 mb-4 fixed-card">
                                                            <div class="card-body">
                                                                <h5 class="card-title fs-5">{{ $career->name }}</h5>
                                                                <p class="card-text text-muted">{{ $career->jobs_count }} Việc Làm</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endif   
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
                        @if ($featureJobs->isNotEmpty())
                            @foreach ($featureJobs as $featureJob)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <div class="d-flex home_jobs">
                                                <div class="col-10">
                                                    <img alt="" 
                                                        class="company-logo" 
                                                        height="50" 
                                                        src="{{ asset('assets/user/profile_picture/thumb/'.($featureJob->user->image ?? 'logo-page.jpg')) }}" 
                                                        width="50"
                                                        style="max-width: 100px;
                                                                max-height: 100px;
                                                                "
                                                    />
                                                </div>
                                                <div class="jobs_right col-2">
                                                    <div class="apply_now">
                                                        <a class="heart_mark" href="javascript:void(0);" onclick="saveJobHeart({{ $featureJob->id }}, this)">
                                                            <i class="fa {{ $featureJob->is_saved ? 'fa-heart' : 'fa-heart-o' }}" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <h3 class="border-0 fs-5 pb-2 mb-0 mt-3">
                                                {{ Str::words(strip_tags($featureJob->title), 7) }}
                                            </h3>

                                            @if (!empty($featureJob->company_name))
                                                <p>{{ Str::words(strip_tags($featureJob->company_name), 8) }}</p>
                                            @endif

                                            <div class="bg-light p-3 border">
                                                @if (empty($featureJob->province) && empty($featureJob->district))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1" style="color: red">Vị trí công ty chưa cập nhật</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $featureJob->district }}, {{ $featureJob->province }}</span>
                                                    </p>
                                                @endif

                                                @if (empty($featureJob->jobType->name))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1" style="color: red">Hình thức làm việc chưa cập nhật</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $featureJob->jobType->name }}</span>
                                                    </p>
                                                @endif

                                                @if (Auth::check() && !is_null($featureJob->salary))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $featureJob->salary }}</span>
                                                    </p>
                                                @elseif (is_null($featureJob->salary))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1" style="color: red">Mức lương chưa cập nhật</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1" style="color: red">Đăng nhập để xem mức lương</span>
                                                    </p>
                                                @endif
                                          
                                            </div>

                                            <div class="keywords-section mt-3">
                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                    @php
                                                        $keywords = explode(',', $featureJob->keywords); 
                                                    @endphp
                                                    @foreach ($keywords as $index => $keyword)
                                                        @if ($index < 3) 
                                                            <a href="{{ route('jobs', ['keyword' => trim($keyword)]) }}" class="keyword-badge">
                                                                {{ trim($keyword) }}
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                    @if (count($keywords) > 3) 
                                                        <span>...</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="d-grid mt-3">
                                                @if (Auth::check() && Auth::user()->role === 'employer')
                                                    <a href="{{ route('JobDetail_employer',$featureJob->id) }}" class="btn bg-danger btn-lg text-white">Chi tiết</a>
                                                @else
                                                    <a href="{{ route('jobDetail',$featureJob->id) }}" class="btn bg-danger btn-lg text-white">Chi tiết</a>
                                                @endif       
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        @endif              
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

                        @if ($latesJobs->isNotEmpty())
                            @foreach ($latesJobs as $latesJob)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4" style="height: auto">
                                        <div class="card-body">
                                            <div class="d-flex home_jobs">
                                                <div class="col-10">
                                                    <img alt="" 
                                                        class="company-logo" 
                                                        height="50" 
                                                        src="{{ asset('assets/user/profile_picture/thumb/'.($latesJob->user->image ?? 'logo-page.jpg')) }}" 
                                                        width="50"
                                                        style="max-width: 100px; max-height: 100px;"
                                                    />
                                                </div>
                                                <div class="jobs_right col-2">
                                                    <div class="apply_now">
                                                        <a class="heart_mark" href="javascript:void(0);" onclick="saveJobHeart({{ $latesJob->id }}, this)">
                                                            <i class="fa {{ $latesJob->is_saved ? 'fa-heart' : 'fa-heart-o' }}" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="border-0 fs-5 pb-2 mb-0 mt-3">
                                                {{ Str::words(strip_tags($latesJob->title), 5) }}
                                            </h3>

                                            @if (!empty($latesJob->company_name))
                                                <p>{{ Str::words(strip_tags($latesJob->company_name), 6) }}</p>
                                            @endif
                                            

                                            <div class="bg-light p-3 border">
                                                @if (empty($latesJob->province) && empty($latesJob->district))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1" style="color: red">Vị trí công ty chưa cập nhật</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $latesJob->district }}, {{ $latesJob->province }}</span>
                                                    </p>
                                                @endif

                                                @if (empty($latesJob->jobType->name))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1" style="color: red">Hình thức làm việc chưa cập nhật</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $latesJob->jobType->name }}</span>
                                                    </p>
                                                @endif
 
                                                @if (Auth::check() && !is_null($latesJob->salary))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $latesJob->salary }}</span>
                                                    </p>
                                                @elseif (is_null($latesJob->salary))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1" style="color: red">Mức lương chưa cập nhật</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1" style="color: red">Đăng nhập để xem mức lương</span>
                                                    </p>
                                                @endif                                         
                                            </div>

                                            <div class="keywords-section mt-3">
                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                    @php
                                                        $keywords = explode(',', $latesJob->keywords); 
                                                    @endphp
                                                    @foreach ($keywords as $index => $keyword)
                                                        @if ($index < 3) 
                                                            <a href="{{ route('jobs', ['keyword' => trim($keyword)]) }}" class="keyword-badge">
                                                                {{ trim($keyword) }}
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                    @if (count($keywords) > 3) 
                                                        <span>...</span>
                                                    @endif
                                                </div>
                                            </div>
                                                                                       
        
                                            <div class="d-grid mt-3">
                                                @if (Auth::check() && Auth::user()->role === 'employer')
                                                    <a href="{{ route('JobDetail_employer',$latesJob->id) }}" class="btn btn-primary btn-lg">Chi tiết</a>
                                                @else
                                                    <a href="{{ route('jobDetail',$latesJob->id) }}" class="btn btn-primary btn-lg">Chi tiết</a>
                                                @endif  
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        @endif  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')

<script>
    $("#searchFormHome").submit(function(e){
        e.preventDefault();

        var url = '{{ route("jobs") }}?';

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
                url: '{{ route("saveJob") }}',
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

@endsection
