<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='logon.php'</script>";
	exit;
}
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台首页</title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/index.css">
	<script src="../public/js/jquery.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
</head>
<body>
	<?php include "public/common/top.php" ?>
	<div class="container">
		<?php include"public/common/left.php" ?>
		<div class="col-md-10">
			<div class="thumbnail">
		      <form action="update.php" method="post">
		      	<div class="form-group">
		      		<label for="">请输入原密码</label>
		      		<input type="text" name="oldpassword" class="form-control">
		      	</div>
		      	<div class="form-group">
		      		<label for="">请输新密码</label>
		      		<input type="password" name="newpassword" id="newpassword" class="form-control">
		      	</div>
		      	<div class="form-group">
		      		<label for="">请确认密码</label>
		      		<input type="password" name="affirmPassword" id="affirmPassword" class="form-control">
		      	</div>
		      	<input type="submit" value="确认修改">
		      </form>
		    </div>
		</div>
	</div>
</body>
<script>
	$("#affirmPassword").blur(function(){
		if($(this).val()!=$("#newpassword").val()){
			alert("两次密码不一致");
		}
	});
</script>
</html>