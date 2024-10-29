@extends('front.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-md-6 my-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Đăng nhập</h1>
                    <form action="{{ route('account.authenticate') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="mb-2">Email <span style="color: red">*</span></label>
                            <input type="text" 
                                    name="email" id="email" 
                                    value="{{ old('email') }}"
                                    class="form-control  @error('email') is-invalid @enderror" 
                                    placeholder="Ví dụ: example@example.com">

                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Mật khẩu <span style="color: red">*</span></label>
                            <input type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="Nhập mật khẩu...">

                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

                        </div> 
                        <div class="justify-content-between d-flex">
                        <button class="btn btn-primary mt-2">Đăng nhập</button>
                            <a href="{{ route("account.forgotPassword") }}" class="mt-3">Quên mật khẩu?</a>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Bạn muốn tìm một công việc? <a  href="{{ route("account.registration") }}">Đăng ký</a></p>
                </div>
            </div>
            <div class="col-md-6 my-5">
                <h1>Welcome</h1>
                
            </div>
        </div>
    </div>
</section>
@endsection