<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
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
    	<h2>添加积分商品</h2>
		<form action="insert.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>名称</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label>所需积分</label>
				<input type="text" class="form-control" name="price">
			</div>
			<div class="form-group">
				<label>购买商品获得积分</label>
				<input type="text" class="form-control" name="award">
			</div>
			<div class="form-group">
				<label>库存</label>
				<input type="text" class="form-control" name="repertory">
			</div>
			<div>
				<label>上下架</label>
				<div class="radio">
					<label>
						<input type="radio" name="goodsShelf" value="1" checked>上架
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="goodsShelf" value="0">下架
					</label>
				</div>
			</div>
			<div>
				<label>是否包邮</label>
				<div class="radio">
					<label>
						<input type="radio" name="mail" value="1" checked>包邮
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="mail" value="0">不包邮
					</label>
				</div>
			</div>

			<div class="form-group">
				<label>简介</label>
				<textarea name="intro" cols="30" rows="10" style="resize:none" class="form-control"></textarea>
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