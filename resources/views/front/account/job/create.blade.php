@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Cài đặt tài khoản</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')

                <form action="" method="post" id="createJobForm" name="createJobForm">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Chi tiết công việc</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-3 fs-5 fst-italic">Tiêu đề<span class="req">*</span></label>
                                    <input type="text" 
                                           placeholder="Tiêu đề công việc" 
                                           id="title" 
                                           name="title" 
                                           class="form-control"
                                           value="{{ old('title') }}"
                                    >
                                    <p></p>
                                </div>
                                <div class="col-md-6 mb-4 search_select_box">
                                    <label for="" class="mb-3 fs-5 fst-italic">Ngành nghề<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        @if ($careers->isNotEmpty())
                                            @foreach ($careers as $career)
                                            <option value="{{ $career->id }}" {{ old('category') == $career->id ? 'selected' : '' }}>
                                                {{ $career->name }}
                                            </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-3 fs-5 fst-italic">Hình thức làm việc<span class="req">*</span></label>
                                    <select name="jobType" id="jobType" class="form-select">
                                        <option value="">Loại hợp đồng</option>
                                        @if ($jobtypes->isNotEmpty())
                                            @foreach ($jobtypes as $jobtype)
                                            <option value="{{ $jobtype->id }}" {{ old('jobType') == $jobtype->id ? 'selected' : '' }}>
                                                {{ $jobtype->name }}
                                            </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-3 fs-5 fst-italic">Số lượng tuyển<span class="req">*</span></label>
                                    <input type="number" 
                                           min="1" 
                                           placeholder="Số lượng tuyển" 
                                           id="vacancy" 
                                           name="vacancy" 
                                           class="form-control"
                                           value="{{ old('vacancy') }}">
                                    <p></p>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-3 fs-5 fst-italic">Mức lương</label>
                                    <input type="text" 
                                           placeholder="Mức lương" 
                                           id="salary" 
                                           name="salary" 
                                           class="form-control"
                                           value="{{ old('salary') }}"
                                    >
                                </div>
                
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-3 fs-5 fst-italic">Vị trí cần tuyển<span class="req">*</span></label>
                                    <input type="text" 
                                           placeholder="Ví dụ: Junior, Middle, Senior,..." 
                                           id="level" 
                                           name="level" 
                                           class="form-control" 
                                           value="{{ old('level') }}"
                                    >
                                    <p></p>
                                </div>
                            </div>
                
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5 fst-italic">Mô tả công việc</label>
                                <textarea class="textarea" name="description" id="description" cols="5" rows="5" placeholder="Mô tả công việc"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5 fst-italic">Phúc lợi</label>
                                <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Phúc lợi">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5 fst-italic">Trách nhiệm công việc</label>
                                <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Trách nhiệm">{{ old('responsibility') }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5 fst-italic">Kỹ năng & Chuyên môn</label>
                                <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Nhập yêu cầu công việc...">{{ old('qualifications') }}</textarea>
                            </div>
                
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5 fst-italic">Kinh nghiệm tối thiểu</label>
                                <select name="experience" id="experience" class="form-control">
                                    <option value="1" {{ old('experience') == '1' ? 'selected' : '' }}>1 năm</option>
                                    <option value="2" {{ old('experience') == '2' ? 'selected' : '' }}>2 năm</option>
                                    <option value="3" {{ old('experience') == '3' ? 'selected' : '' }}>3 năm</option>
                                    <option value="4" {{ old('experience') == '4' ? 'selected' : '' }}>4 năm</option>
                                    <option value="5" {{ old('experience') == '5' ? 'selected' : '' }}>5 năm</option>
                                    <option value="6" {{ old('experience') == '6' ? 'selected' : '' }}>6 năm</option>
                                    <option value="7" {{ old('experience') == '7' ? 'selected' : '' }}>7 năm</option>
                                    <option value="8" {{ old('experience') == '8' ? 'selected' : '' }}>8 năm</option>
                                    <option value="9" {{ old('experience') == '9' ? 'selected' : '' }}>9 năm</option>
                                    <option value="10" {{ old('experience') == '10' ? 'selected' : '' }}>10 năm</option>
                                    <option value="10_plus" {{ old('experience') == '10_plus' ? 'selected' : '' }}>Trên 10 năm</option>
                                </select>                                
                            </div>
                
                            <div class="mb-4">
                                <label for="keywords" class="mb-3 fs-5 fst-italic">Từ khóa</label>
                                <input type="text" placeholder="Ví dụ: PHP, Java,..." id="keywords" name="keywords" class="form-control">
                                <p></p>
                                <div id="keywords-list" class="d-flex flex-wrap mt-2"></div>
                            </div>
                            
                
                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Chi tiết công ty</h3>
                
                            <div class="row">
                                <div class="mb-4">
                                    <label for="" class="mb-3 fs-5 fst-italic">Tên công ty<span class="req">*</span></label>
                                    <input type="text" 
                                           placeholder="Ví dụ: TopWork" 
                                           id="company_name" 
                                           name="company_name" 
                                           class="form-control" 
                                            value="{{ old('company_name', $user->company_name) }}"
                                    >
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="address" class="form-label mb-3 fs-5 fst-italic">Địa chỉ</label>
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="province" name="province">
                                            <option value="">{{ old('province', $user->province) ?: 'Chọn tỉnh / thành' }}</option>
                                        </select>
                                        <input type="hidden" id="province_name" name="province_name" value="{{ old('province_name', $user->province) }}">
                                        
                                        <select class="form-select" id="district" name="district">
                                            <option value="">{{ old('district', $user->district) ?: 'Chọn quận / huyện' }}</option>
                                        </select>
                                        <input type="hidden" id="district_name" name="district_name" value="{{ old('district_name', $user->district) }}">
                                        
                                        <select class="form-select" id="wards" name="wards">
                                            <option value="">{{ old('wards', $user->wards) ?: 'Chọn phường / xã' }}</option>
                                        </select>
                                        <input type="hidden" id="ward_name" name="ward_name" value="{{ old('ward_name', $user->wards) }}">
                                    </div>
                                    
                                    <label for="" class="mb-3 fs-5 fst-italic">Địa điểm làm việc</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="location_detail" 
                                           name="location_detail" 
                                           placeholder="Ví dụ: Tầng 14, Richy Tower, Phường Yên Hoà, Quận Cầu Giấy, Thành phố Hà Nội" 
                                           value="{{ old('location_detail', $user->location_detail) }}">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5 fst-italic">Địa chỉ Website</label>
                                <input type="text" 
                                       placeholder="Ví dụ: https://topwork.vn/" 
                                       id="company_website" 
                                       name="company_website" 
                                       class="form-control" 
                                        value="{{ old('company_website', $user->company_website) }}">
                            </div>
                            
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Lưu công việc</button>
                        </div>
                    </div>
                </form>
                       
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script type="text/javascript">
    $("#createJobForm").submit(function(e){
        e.preventDefault();
        $("button[type=submit]").prop("disabled", true);
        $.ajax({
            url: '{{ route("account.saveJob") }}',
            type: 'POST',
            dataType: 'json',
            data: $("#createJobForm").serializeArray(),
            success: function(response){
                $("button[type=submit]").prop("disabled", false);
                if(response.status == true) {
                    $("#title").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#category").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#jobType").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#vacancy").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#level").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#company_name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    window.location.href="{{ route("account.myJobs") }}";
                } else {
                    var errors = response.errors;

                    toastr.warning('Có lỗi xảy ra, hãy kiểm tra lại !');
                    // Title
                    if (errors.title) {
                        $("#title").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.title);
                    } else {
                        $("#title").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                     // Category
                    if (errors.category) {
                        $("#category").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.category);
                    } else {
                        $("#category").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                    // JobType
                    if (errors.jobType) {
                        $("#jobType").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.jobType);
                    } else {
                        $("#jobType").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                    // Vacancy
                    if (errors.vacancy) {
                        $("#vacancy").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.vacancy);
                    } else {
                        $("#vacancy").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                    // Job_Level
                    if (errors.level) {
                        $("#level").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.level);
                    } else {
                        $("#level").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                    
                    
                    // Company_name
                    if (errors.company_name) {
                        $("#company_name").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.company_name);
                    } else {
                        $("#company_name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                }

            }
        });
    });
</script>

<script>
    $(document).ready(function() {
    $.getJSON('/api/proxy/provinces', function(data_tinh) {
        if (data_tinh.error === 0) {
            $.each(data_tinh.data, function(key_tinh, val_tinh) {
                $("#province").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
            });

            // Khi chọn tỉnh
            $("#province").change(function(e) {
                var idtinh = $(this).val();
                var tentinh = $("#province option:selected").text();
                $("#province_name").val(tentinh); // Lưu tên tỉnh

                $.getJSON('/api/proxy/districts/' + idtinh, function(data_quan) {
                    if (data_quan.error === 0) {
                        $("#district").html('<option value="0">Chọn Quận / Huyện</option>');
                        $("#wards").html('<option value="0">Chọn Phường / Xã</option>');

                        $.each(data_quan.data, function(key_quan, val_quan) {
                            $("#district").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
                        });

                        // Khi chọn quận
                        $("#district").change(function(e) {
                            var idquan = $(this).val();
                            var tenquan = $("#district option:selected").text();
                            $("#district_name").val(tenquan); // Lưu tên huyện

                            $.getJSON('/api/proxy/wards/' + idquan, function(data_phuong) {
                                if (data_phuong.error === 0) {
                                    $("#wards").html('<option value="0">Chọn Phường / Xã</option>');
                                    $.each(data_phuong.data, function(key_phuong, val_phuong) {
                                        $("#wards").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                                    });

                                    // Khi chọn xã
                                    $("#wards").change(function(e) {
                                        var tenxa = $("#wards option:selected").text();
                                        $("#ward_name").val(tenxa); // Lưu tên xã
                                    });
                                }
                            });
                        });
                    }
                });
            });
        }
    });
});
</script>

<script>
    const keywordsInput = document.getElementById('keywords');
    const keywordsList = document.getElementById('keywords-list');
    let keywords = [];

    keywordsInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && keywordsInput.value.trim() !== '') {
            e.preventDefault();
            addKeyword(keywordsInput.value.trim());
            keywordsInput.value = '';
        }
    });

    function addKeyword(keyword) {
        if (!keywords.includes(keyword)) {
            keywords.push(keyword);

            // Tạo thẻ từ khóa mới
            const keywordTag = document.createElement('span');
            keywordTag.className = 'keyword-tag';
            keywordTag.textContent = keyword;

            // Thêm thẻ vào danh sách hiển thị
            keywordsList.appendChild(keywordTag);

            // Bạn có thể lưu `keywords` vào database nếu cần
        }
    }

</script>
@endsection