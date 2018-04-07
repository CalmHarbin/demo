<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="select name,id from shop";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetchAll();
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
    	<h2>添加关键字</h2>
		<form action="insert.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label >关键字</label>
				<input type="text" name="keyword" required>
			</div>
			<input type="submit" value="添加">
			<input type="reset">
		</form>
    </div>
</body>
</html>