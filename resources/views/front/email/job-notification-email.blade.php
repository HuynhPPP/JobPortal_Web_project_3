<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông báo công việc</title>
</head>
<body>
    <h1>Xin chào {{ $mailData['employer']->fullname }}</h1>
    <p>Tiêu đề: {{ $mailData['job']->title }}</p>
    <br>
    <p>Thông tin nhân viên:</p>
    <p>Họ và tên: {{ $mailData['user']->fullname }}</p>
    <p>Email: {{ $mailData['user']->email }}</p>
    <p>Số điện thoại: {{ $mailData['user']->mobile }}</p>
</body>
</html>