<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
//查看商品详情
$sql="select * from awardshop where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
$smt->execute();
$row=$smt->fetch();

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
    	<h2>商品详细信息</h2>
		<form action="insert.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>名称</label>
				<input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>图片</label>
				<img src='/mySite/public/uploads/awardshop/th_<?php echo $row['img'] ?>'>
			</div>
			<div class="form-group">
				<label>简介</label>
				<p class="lead"><?php echo $row['intro'] ?></p>
			</div>
			<div class="form-group">
				<label>所需积分</label>
				<input type="text" class="form-control" name="price" value="<?php echo $row['price'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>扣除积分</label>
				<input type="text" class="form-control" name="award" value="<?php echo $row['award'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>销量</label>
				<input type="text" class="form-control" name="salesVolume" value="<?php echo $row['salesVolume'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>库存</label>
				<input type="text" class="form-control" name="repertory" value="<?php echo $row['repertory'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>上下架</label>
				<input type="text" class="form-control" name="goodsShelf" value="<?php echo $row['goodsShelf']?"上架":"下架" ?>" disabled>
			</div>
			<div class="form-group">
				<label>是否包邮</label>
				<input type="text" class="form-control" name="mail" value="<?php echo $row['mail']?"包邮":"不包邮" ?>" disabled>
			</div>
			<div class="form-group">
				<label>商品地址</label>
				<input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>" disabled>
			</div>
		</form>
    </div>
</body>
</html>