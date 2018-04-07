<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台首页</title>
	<link rel="stylesheet" href="../../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/index.css">
	<script src="../../public/js/jquery.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="thumbnail">
    	<h2>添加导航栏内容</h2>
		<form action="insert.php" method="post">
			<div class="form-group">
				<label >内容</label>
				<input type="text" name="content" class="form-control" required>
			</div>
			<div class="form-group">
				<label >url</label>
				<input type="url" name="url">
			</div>
			<input type="submit" value="添加">
			<input type="reset">
		</form>
    </div>
</body>
</html>