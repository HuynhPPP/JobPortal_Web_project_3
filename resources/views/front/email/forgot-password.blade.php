<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quên mật khẩu</title>
</head>
<body>
    <h1>Xin chào {{ $mailData['user']->fullname }}</h1>
    <p>Nhấn vào đây để đổi mật khẩu</p>
        <a href="{{ route("account.resetPassword",$mailData['token']) }}">Lấy lại mật khẩu</a>
</body>
</html>