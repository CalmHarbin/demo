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
    	<h2>添加广告</h2>
		<form action="insert.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label >广告位置</label>
				<select name="place" class="from-control">
					<option value="1">1号位</option>
					<option value="2">2号位</option>
					<option value="3">3号位</option>
					<option value="4">4号位</option>
					<option value="5">5号位</option>
					<option value="6">6号位</option>
					<option value="7">7号位</option>
				</select>
			</div>
			<div class="form-group">
				<label >广告状态</label>
				<div class="radio">
					<label>
						<input type="radio" value="1" name="isshow" checked="checked">显示
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" value="0" name="isshow">不显示
					</label>
				</div>
			</div>
			<div class="form-group">
				<label>广告链接</label>
				<input type="url" name="url">
			</div>
			<div class="form-group">
				<label >图片</label>
				<input type="file" name="file">
			</div>
			<input type="submit" value="添加">
			<input type="reset">
		</form>
    </div>
</body>
</html>