<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>404</title>

	<!-- Google font -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/user/images/logo_web.jpg')); ?>" />

	<!-- Custom stlylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/user/css/404_page.css')); ?>" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<div></div>
				<h1>404</h1>
			</div>
			<h2>Trang không tồn tại !</h2>
			<p>Bạn đang cố gắng truy cập trang không tồn tại hoặc đã bị xoá. Vui lòng thử lại !</p>
			<a href="<?php echo e(route('home')); ?>">Trang chủ</a>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<?php /**PATH D:\Learning\N4_HK1_2024_2025\Do_an_3\project_3\resources\views/errors/404.blade.php ENDPATH**/ ?>