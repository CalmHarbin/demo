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
			<iframe src="indexRight.php" frameborder="0" name="right" height="550px" width="100%"></iframe>
		</div>
	</div>
</body>
</html>