@extends('front.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Quên mật khẩu</h1>
                    <form action="{{ route('account.processForgotPassword') }}" method="post">
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