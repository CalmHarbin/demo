<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户注册</title>
</head>
<body>
	<h1>用户注册</h1>
	<form action="vcodesubmit.php" method="post">
		<p>用户名:</p>
		<p><input type="text" name="username"></p>
		<p>密码:</p>
		<p><input type="password" name="password"></p>
		<p>请输入验证码</p>
		<p><img src="vcode.php" alt="" onclick="this.src='vcode.php?rand='+Math.random()"></p>
		<p><input type="text" name="vcode"></p>
		<input type="submit" value="提交">
		<input type="reset">
	</form>
</body>
</html>