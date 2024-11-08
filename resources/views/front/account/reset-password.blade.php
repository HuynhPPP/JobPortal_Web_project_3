@extends('front.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Khôi phục mật khẩu</h1>
                    <form action="{{ route('account.processResetPassword') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $tokenString }}">
                        <div class="mb-3">
                            <label for="" class="mb-2">Mật khẩu mới <span style="color: red">*</span></label>
                            <input type="password" 
                                    name="new_password" id="new_password" 
                                    value="{{ old('email') }}"
                                    class="form-control  @error('new_password') is-invalid @enderror" 
                                    placeholder="Nhập mật khẩu mới">

                            @error('new_password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

                        </div> 

                        <div class="mb-3">
                            <label for="" class="mb-2">Xác nhận mật khẩu <span style="color: red">*</span></label>
                            <input type="password" 
                                    name="confirm_password" id="confirm_password" 
                                    value="{{ old('email') }}"
                                    class="form-control  @error('confirm_password') is-invalid @enderror" 
                                    placeholder="Nhập mật khẩu mới">

                            @error('confirm_password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

                        </div> 

                        <div class="justify-content-between d-flex">
                            <button class="btn btn-primary mt-2">Xác nhận</button>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Bạn đã có tài khoản? <a  href="{{ route("account.login") }}">Đăng nhập</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
@endsection