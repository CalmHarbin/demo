<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户登录</title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/login.css">
	<script src="../public/js/jquery.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
</head>
<body>
	<img src="public/images/logon.jpg" alt="" class="adv">
	<div class="wrap">
		<form action="logon/userlogon.php" method="post">
			<h4>用户登录</h4>
			<a href="login.php" class="have">还没账号<span class="origin">点击注册</span></a>
			<div class="form-group">
				<input type="text" class="form-control" name="username" required>
				<span class="hint">请输入账号</span>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" required>
				<span class="hint">请输入密码</span>
			</div>
			<div class="form-group">
				<input type="text" class="form-control code" name="vcode" required>
				<img src="/mySite/public/common//vcode.php" width="85px" height="35px" alt="">
				<span class="origin chenge">换一张</span>
				<span class="hint">按右图填写，不区分大小写</span>
				<input type="submit" class="btn btn-block btn-danger" value="登录">
			</div>
		</form>
	</div>
</body>
<script>
	$(".form-group .chenge").click(function(){
		$(this).prev().attr({"src":"/mySite/public/common//vcode.php?img="+Math.random()});
	});
</script>
</html>