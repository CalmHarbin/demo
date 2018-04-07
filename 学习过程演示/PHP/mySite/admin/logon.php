<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员登录</title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/logon.css">
	<script src="../public/js/jquery.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
	<script src="../public/js/holder.js"></script>
</head>
<body>
	<div class="wrap">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">请登录</div>
			</div>
			<div class="panel-body">
				<form action="logon/verify.php" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="" class="col-md-2 control-label">账号:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" placeholder="Username" name="username">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-md-2 control-label">密码:</label>
						<div class="col-md-10">
							<input type="password" class="form-control" placeholder="password" name="password">
						</div>
					</div>
					<div class="code">
						<img src="/mySite/public/common//vcode.php" alt="">
						<span>点击刷新</span>
					</div>
					<div class="code">
						<p>请输入验证码:</p>
						<input type="text" name="vcode">
					</div>
					<input type="submit" value="登录" class="btn btn-primary logon">
				</form>
			</div>
			<div class="panel-footer">
				<a href="#">忘记密码?</a>
			</div>
		</div>
	</div>
</body>
<script>
	$(".panel-body .code span").click(function(){
		$(this).prev().attr({"src":"/mySite/public/common//vcode.php?img="+Math.random()});
	});
</script>
</html>