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
                            <h3 class="fs-4 mb-1">Thông tin tài khoản</h3>
                            <p>Các trường chứa dấu <span style="color: red">*</span> là bắt buộc</p>
                            <div class="mb-4">
                                <label for="" class="mb-2">Họ và tên <span style="color: red">*</span></label>
                                <input type="text" 
                                    name="name" id="name" 
                                    placeholder="Nhập tên..." 
                                    class="form-control" 
                                    value="{{ $user->fullname }}"
                                    >
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Email <span style="color: red">*</span></label>
                                <input type="text" 
                                        name="email" 
                                        id="email" 
                                        placeholder="Nhập email..." 
                                        class="form-control"
                                        value="{{ $user->email }}"
                                        >
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Vai trò</label>
                                <input type="text" 
                                    name="designation" 
                                    id="designation" 
                                    placeholder="Nhập vai trò..." 
                                    class="form-control"
                                    value="{{ $user->designation }}">
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Số điện thoại</label>
                                <input type="text" 
                                    name="mobile" 
                                    id="mobile" 
                                    placeholder="Nhập số điện thoại..." 
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

                <div class="card border-0 shadow mb-4">
                    <form action="" method="POST" id="changePasswordForm" name="changePasswordForm">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Thay đổi mật khẩu</h3>
                            <p>Các trường chứa dấu <span style="color: red">*</span> là bắt buộc</p>
                            <div class="mb-4">
                                <label for="" class="mb-2">Mật khẩu cũ <span style="color: red">*</span></label>
                                <input type="password" name="old_password" id="old_password" placeholder="Nhập mật khẩu cũ..." class="form-control">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Mật khẩu mới <span style="color: red">*</span></label>
                                <input type="password" name="new_password" id="new_password" placeholder="Nhập mật khẩu mới..." class="form-control">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Xác nhận mật khẩu <span style="color: red">*</span></label>
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
@endsection