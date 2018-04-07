<?php 
include "config.ico.php";
$sql="select * from user where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetch();
$username=$rows['username'];
$password=$rows['password'];
$id=$rows['id'];
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改用户</title>
	<link rel="stylesheet" href="../bs/bootstrap.min.css">
	<script src="../bs/jquery-3.2.1.js"></script>
	<script src="../bs/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2 class="page-header">修改信息</h2>
		<form action="update.php" method="post">
			<div class="form-group">
				<label for="">用户名</label>
				<input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
			</div>
			<div class="form-group">
				<label for="">密码</label>
				<input type="text" name="password" value="<?php echo $password; ?>" class="form-control">
			</div>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" value="确认修改">
		</form>
	</div>
</body>
</html>