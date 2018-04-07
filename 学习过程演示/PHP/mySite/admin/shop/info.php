<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
//查看商品详情
$sql="select * from shop where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
$smt->execute();
$row=$smt->fetch();

//关键字查询
$sqlkey="select keywords.keyword from shopkeywords,keywords where shopkeywords.keyword_id=keywords.id&&shop_id={$_GET['id']}";
$smtkey=$pdo->prepare($sqlkey);
$smtkey->execute();
$rowskey=$smtkey->fetchAll();
foreach ($rowskey as $rowkey) {
	$strkey=$strkey.$rowkey['keyword'].'、';
}
//分类查询
$sqlclass="select lclassify.name lname,bclassify.name bname from bclassify,lclassify where lclassify.bclassify_id=bclassify.id&&lclassify.id={$row['lclassify_id']}";
$smtclass=$pdo->prepare($sqlclass);
$smtclass->execute();
$rowclass=$smtclass->fetch();

//价格区间查询
$sqlprice="select * from priceSection where id={$row['pricesection_id']}";
$smtprice=$pdo->prepare($sqlprice);
$smtprice->execute();
$rowprice=$smtprice->fetch();
//更多商品图片查看
$sqlimg="select shopimg.* from shop,shopimg where shopimg.shop_id=shop.id&&shop.id={$_GET['id']}";
$smtimg=$pdo->prepare($sqlimg);
$smtimg->execute();
$rowsimg=$smtimg->fetchAll();
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
		<form action="insertimg.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>名称</label>
				<input type="text" class="form-control" value="<?php echo $row['name'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>图片</label>
				<img src='/mySite/public/uploads/shop/th_<?php echo $row['img'] ?>'>
				<?php 
				foreach ($rowsimg as $rowimg) {
					echo "<img src='/mySite/public/uploads/shop/th_{$rowimg['img']}' >";
				}
				 ?>
			</div>
			<div class="form-group">
				<label>上传商品图片</label>
				<input type="file" name="img">
			</div>
			<div class="form-group">
				<label>详细信息</label>
				<?php 
				foreach ($rowsimg as $rowimg) {
					echo "<img src='/mySite/public/uploads/shop/th_{$rowimg['info']}' >";
				}
				 ?>
			</div>
			
			<div class="form-group">
				<label>上传商品信息</label>
				<input type="file" name="info">
			</div>
			<input type="hidden" name="shop_id" value="<?php echo $_GET['id'] ?>">
			<div class="form-group">
				<input type="submit" value="确认上传">
			</div>
			<div class="form-group">
				<label>简介</label>
				<p class="lead"><?php echo $row['intro'] ?></p>
			</div>
			<div class="form-group">
				<label>现价</label>
				<input type="text" class="form-control" value="<?php echo $row['currentPrice'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>原价</label>
				<input type="text" class="form-control" value="<?php echo $row['originalPrice'] ?>" disabled>
			</div>
			<div>
				<label>所在价格区间</label>
				<input type="text" class="form-control" value="<?php echo $rowprice['section'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>奖励积分</label>
				<input type="text" class="form-control" value="<?php echo $row['award'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>销量</label>
				<input type="text" class="form-control" value="<?php echo $row['salesVolume'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>库存</label>
				<input type="text" class="form-control" value="<?php echo $row['repertory'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>上下架</label>
				<input type="text" class="form-control" value="<?php echo $row['goodsShelf']?"上架":"下架" ?>" disabled>
			</div>
			<div class="form-group">
				<label>是否包邮</label>
				<input type="text" class="form-control" value="<?php echo $row['mail']?"包邮":"不包邮" ?>" disabled>
			</div>
			<div class="form-group">
				<label>商品自身积分</label>
				<input type="text" class="form-control" value="<?php echo $row['integral'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>商品地址</label>
				<input type="text" class="form-control" value="<?php echo $row['address'] ?>" disabled>
			</div>
			<div class="form-group">
				<label>商品关键字</label>
				<input type="text" class="form-control" value="<?php echo $strkey ?>" disabled>
			</div>
			<div class="form-group">
				<label>商品所在分类</label>
				<input type="text" class="form-control" value="<?php echo $rowclass['lname'],"--------",$rowclass['bname'] ?>" disabled>
			</div>
		</form>
    </div>
</body>
</html>