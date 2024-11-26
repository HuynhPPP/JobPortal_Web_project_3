<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập- TopWork - Việc làm hàng đầu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/user/css/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/css/login_style.css') }}">
</head>

<body>
    <div class="form-wrapper">
        <main class="form-side">
            <h1>Lỗi 404 - Không tìm thấy trang bạn truy cập !</h1>
        </main>
        <aside class="info-side">
            <div class="blockquote-wrapper">
            </div>
        </aside>
    </div>

    <script src="{{ asset('assets/user/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/toastr.min.js') }}"></script>

    @if (session()->has('toastr'))
        <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "6000"
        };

        @foreach (session('toastr') as $type => $message)
            toastr.{{ $type }}('{{ $message }}');
        @endforeach
        </script>
    @endif
    
    
</body>

</html>