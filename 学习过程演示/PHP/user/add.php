<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加用户</title>
	<link rel="stylesheet" href="../bs/bootstrap.min.css">
	<script src="j../bs/query-3.2.1.js"></script>
	<script src="../bs/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>添加用户</h2>
		<form action="insert.php" method="post">
			<div class="form-group">
				<label >用户名</label>
				<input type="text" name="username" class="form-control">
			</div>
			<div class="form-group">
				<label >密码</label>
				<input type="text" name="password" class="form-control">
			</div>
			<input type="submit" value="添加">
			<input type="reset">
		</form>
	</div>
</body>
</html>