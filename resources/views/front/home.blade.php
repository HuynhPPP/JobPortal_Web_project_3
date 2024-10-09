@extends('front.layouts.app')

@section('main')
<section class="section-0 lazy d-flex bg-image-style dark align-items-center "   class="" data-bg="assets/images/banner5.jpg">
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
            <form action="{{ route("jobs") }}" method="GET">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Từ khoá">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Địa điểm">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="career" id="career" class="form-control">
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
                            {{-- <a href="jobs.html" class="btn btn-primary btn-block">Tìm kiếm</a> --}}
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
        <h2>Công việc phổ biến</h2>
        <div class="row pt-5">
            @if ($careers->isNotEmpty())
                @foreach ($careers as $career)
                    <div class="col-lg-4 col-xl-3 col-md-6">
                        <div class="single_catagory">
                            <a href="{{ route("jobs").'?career='.$career->id }}"><h4 class="pb-2">{{ $career->name }}</h4></a>
                            <p class="mb-0"> <span>50</span> vị trí còn trống</p>
                        </div>
                    </div>
                @endforeach
            @endif           
        </div>
    </div>
</section>

<section class="section-3  py-5">
    <div class="container">
        <h2>Công việc nổi bật</h2>
        <div class="row pt-5">
            <div class="job_listing_area">                    
                <div class="job_lists">
                    <div class="row">
                        @if ($featureJobs->isNotEmpty())
                            @foreach ($featureJobs as $featureJob)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $featureJob->title }}</h3>

                                            @if (empty($featureJob->description))
                                                <p style="color: red">Chưa có mô tả cho công việc này</p>
                                            @else 
                                                <p>{{ Str::words(strip_tags($featureJob->description), 10) }}</p>
                                            @endif

                                            <div class="bg-light p-3 border">
                                                @if (empty($featureJob->company_location))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1" style="color: red">Vị trí công ty chưa cập nhật</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $featureJob->company_location }}</span>
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

                                                @if (!is_null($featureJob->salary))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $featureJob->salary }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1" style="color: red">Mức lương chưa cập nhật</span>
                                                    </p>
                                                @endif                                              
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="{{ route('jobDetail',$featureJob->id) }}" class="btn btn-primary btn-lg">Chi tiết</a>
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
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $latesJob->title }}</h3>

                                            @if (empty($latesJob->description))
                                                <p style="color: red">Chưa có mô tả cho công việc này</p>
                                            @else 
                                                <p>{{ Str::words(strip_tags($latesJob->description), 10) }}</p>
                                            @endif
                                            

                                            <div class="bg-light p-3 border">
                                                @if (empty($latesJob->company_location))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1" style="color: red">Vị trí công ty chưa cập nhật</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $latesJob->company_location }}</span>
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

                                                @if (!is_null($latesJob->salary))
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $latesJob->salary }}</span>
                                                    </p>
                                                @else
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1" style="color: red">Mức lương chưa cập nhật</span>
                                                    </p>
                                                @endif                                             
                                            </div>
        
                                            <div class="d-grid mt-3">
                                                <a href="{{ route('jobDetail',$latesJob->id) }}" class="btn btn-primary btn-lg">Chi tiết</a>
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