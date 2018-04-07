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
		<form action="update.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>名称</label>
				<input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
			</div>
			<div class="form-group">
				<label>所需积分</label>
				<input type="text" class="form-control" name="price" value="<?php echo $row['price'] ?>">
			</div>
			<div class="form-group">
				<label>扣除积分</label>
				<input type="text" class="form-control" name="award" value="<?php echo $row['award'] ?>">
			</div>
			<div class="form-group">
				<label>库存</label>
				<input type="text" class="form-control" name="repertory" value="<?php echo $row['repertory'] ?>">
			</div>
			<div class="form-group">
				<label>商品地址</label>
				<input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>" >
			</div>
			
			<div>
				<label>上下架</label>
				<div class="radio">
					<label>
						<input type="radio" name="goodsShelf" value="1" <?php if($row['goodsShelf'])echo "checked"; ?>>上架
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="goodsShelf" value="0" <?php if(!$row['goodsShelf'])echo "checked"; ?>>下架
					</label>
				</div>
			</div>
			<div>
				<label>是否包邮</label>
				<div class="radio">
					<label>
						<input type="radio" name="mail" value="1" <?php if($row['mail'])echo "checked"; ?>>包邮
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="mail" value="0" <?php if(!$row['mail'])echo "checked"; ?>>不包邮
					</label>
				</div>
			</div>
			
			<div class="form-group">
				<label>图片</label>
				<img src='/mySite/public/uploads/shop/th_<?php echo $row['img'] ?>'>
				<input type="file" name="file">
			</div>
			<div class="form-group">
				<label>简介</label>
				<textarea name="intro" cols="30" rows="10" style="resize:none" class="form-control"><?php echo $row['intro'] ?></textarea>
			</div>
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
			<div class="form-group">
				<input type="submit" value="确认修改">
			</div>
		</form>
    </div>
</body>
</html>