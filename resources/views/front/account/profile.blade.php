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
                <div class="card border-0 shadow mb-4">
                    <form action="" method="post" id="userForm" name="userForm">
                        <div class="card-body  p-4">
                            @if (Auth::check() && Auth::user()->role === 'employer')
                                <h3 class="fs-4 mb-1">Thông tin người tuyển dụng</h3>
                            @else
                                <h3 class="fs-4 mb-1">Thông tin tài khoản</h3>
                            @endif
                            <p class="fs-5 fst-italic">Lưu ý: các trường chứa dấu <span style="color: red">*</span> là bắt buộc</p>
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5">Họ và tên <span style="color: red">*</span></label>
                                <input type="text" 
                                    name="name" id="name" 
                                    placeholder="Ví dụ: Nguyễn Văn A" 
                                    class="form-control" 
                                    value="{{ $user->fullname }}"
                                    >
                                <p></p>
                            </div>
                            <div class="mb-4">
                                @if (Auth::check() && Auth::user()->role === 'employer')
                                    <label for="" class="mb-3 fs-5">Email <span style="color: red">*</span> (vui lòng sử dụng email công ty)</label>
                                @else
                                    <label for="" class="mb-3 fs-5">Email <span style="color: red">*</span></label>
                                @endif
                                <input type="text" 
                                        name="email" 
                                        id="email" 
                                        placeholder="Ví dụ: hr@topwork.vn" 
                                        class="form-control"
                                        value="{{ $user->email }}"
                                        >
                                <p></p>
                            </div>
                            
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5">Số điện thoại</label>
                                <input type="text" 
                                    name="mobile" 
                                    id="mobile" 
                                    placeholder="Ví dụ: 0912345678" 
                                    class="form-control"
                                    value="{{ $user->mobile }}"
                                    >
                                <p></p>
                            </div>                        
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>

                @if (Auth::check() && Auth::user()->role === 'employer')
                <div class="card border-0 shadow mb-4">
                    <form action="" method="post" id="userFormCompany" name="userFormCompany">
                        <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">Thông tin công ty (Trụ sở chính)</h3>    
                                <p class="fs-5 fst-italic">Lưu ý: các trường chứa dấu <span style="color: red">*</span> là bắt buộc</p>
                                <div class="mb-4">
                                    <label for="" class="mb-3 fs-5">Tên công ty <span style="color: red">*</span></label>
                                    <input type="text" 
                                        name="company_name" id="company_name" 
                                        placeholder="Ví dụ: TopWork" 
                                        class="form-control" 
                                        value="{{ $user->company_name }}"
                                        >
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="address" class="form-label mb-3 fs-5">Địa chỉ</label>
                                        <div class="input-group mb-3">
                                            <select class="form-select" id="province" name="province">
                                                @if(!empty($user->province))
                                                    <option selected>{{ $user->province }}</option>
                                                @else
                                                    <option selected>Chọn tỉnh / thành</option>
                                                @endif
                                            </select>
                                            <input type="hidden" id="province_name" name="province_name">
                                    
                                            <select class="form-select" id="district" name="district">
                                                @if(!empty($user->district))
                                                    <option selected>{{ $user->district }}</option>
                                                @else
                                                    <option selected>Chọn quận / huyện</option>
                                                @endif
                                            </select>
                                            <input type="hidden" id="district_name" name="district_name">
                                    
                                            <select class="form-select" id="wards" name="wards">
                                                @if(!empty($user->wards))
                                                    <option selected>{{ $user->wards }}</option>
                                                @else
                                                    <option selected>Chọn phường / xã</option>
                                                @endif
                                            </select>
                                            <input type="hidden" id="ward_name" name="ward_name">
                                    
                                        </div>
                                    <label for="" class="mb-3 fs-5">Địa chỉ chi tiết</label>
                                    <input type="text" 
                                        class="form-control" 
                                        id="location_detail" 
                                        name="location_detail" 
                                        placeholder="Ví dụ: Tầng 14, Richy Tower, Phường Yên Hoà, Quận Cầu Giấy, Thành phố Hà Nội"
                                        value="{{ $user->location_detail }}"
                                        >
                                </div>
                                
                                <div class="mb-4">
                                    <div class="mb-4">
                                        <label for="" class="mb-3 fs-5">Địa chỉ Website</label>
                                        <input type="text" 
                                            placeholder="Ví dụ: https://topwork.vn/" 
                                            id="company_website" 
                                            name="company_website" 
                                            class="form-control"
                                            value="{{ $user->company_website }}"
                                            >
                                    </div>
                                </div>   
                                                 
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                        
                    </form>
                </div>
                @endif
                
                <div class="card border-0 shadow mb-4">
                    <form action="" method="POST" id="changePasswordForm" name="changePasswordForm">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Thay đổi mật khẩu</h3>
                            <p class="fs-5 fst-italic">Các trường chứa dấu <span style="color: red">*</span> là bắt buộc</p>
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5">Mật khẩu cũ <span style="color: red">*</span></label>
                                <input type="password" name="old_password" id="old_password" placeholder="Nhập mật khẩu cũ..." class="form-control">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5">Mật khẩu mới <span style="color: red">*</span></label>
                                <input type="password" name="new_password" id="new_password" placeholder="Nhập mật khẩu mới..." class="form-control">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-3 fs-5">Xác nhận mật khẩu <span style="color: red">*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu mới..." class="form-control">
                                <p></p>
                            </div>                        
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>     

            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script type="text/javascript">
    $("#userForm").submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '{{ route("account.updateProfile") }}',
            type: 'put',
            dataType: 'json',
            data: $("#userForm").serializeArray(),
            success: function(response){
                if(response.status == true) {
                    $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#mobile").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                        window.location.href="{{ route("account.profile") }}";
                } else {
                    var errors = response.errors;

                    // Name
                    if (errors.name) {
                        $("#name").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                     // Email
                    if (errors.email) {
                        $("#email").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }

                     // Mobile
                     if (errors.mobile) {
                        $("#mobile").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.mobile);
                    } else {
                        $("#mobile").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                }

            }
        });
    });

    $("#userFormCompany").submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '{{ route("account.updateProfileCompany") }}',
            type: 'put',
            dataType: 'json',
            data: $("#userFormCompany").serializeArray(),
            success: function(response){
                if(response.status == true) {
                    $("#company_name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                        window.location.href="{{ route("account.profile") }}";
                } else {
                    var errors = response.errors;

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

    $("#changePasswordForm").submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '{{ route("account.updatePassword") }}',
            type: 'post',
            dataType: 'json',
            data: $("#changePasswordForm").serializeArray(),
            success: function(response){
                if(response.status == true) {
                    $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                        window.location.href="{{ route("account.profile") }}";
                } else {
                    var errors = response.errors;

                    // Old_password
                    if (errors.old_password) {
                        $("#old_password").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.old_password);
                    } else {
                        $("#old_password").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                    // New_password
                    if (errors.new_password) {
                        $("#new_password").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.new_password);
                    } else {
                        $("#new_password").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                    // Confirm_password
                    if (errors.confirm_password) {
                        $("#confirm_password").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.confirm_password);
                    } else {
                        $("#confirm_password").removeClass('is-invalid')
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
@endsection