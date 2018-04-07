<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
//关键字查询
$sqlkey="select * from keywords";
$smtkey=$pdo->prepare($sqlkey);
$smtkey->execute();
$rowskey=$smtkey->fetchAll();

//分类查询
$sqlclass="select * from bclassify";
$smtclass=$pdo->prepare($sqlclass);
$smtclass->execute();
$rowsclass=$smtclass->fetchAll();

//价格区间查询
$sqlprice="select * from priceSection";
$smtprice=$pdo->prepare($sqlprice);
$smtprice->execute();
$rowsprice=$smtprice->fetchAll();
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
    	<h2>添加商品</h2>
		<form action="insert.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>名称</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label>现价</label>
				<input type="text" class="form-control" name="currentPrice">
			</div>
			<div class="form-group">
				<label>原价</label>
				<input type="text" class="form-control" name="originalPrice">
			</div>
			<div class="form-group">
				<label>奖励积分</label>
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

			<div>
				<label>关键字</label>
				<?php 
					foreach ($rowskey as $rowkey) {
						echo "<div class='checkbox-inline'>
								<label>
									<input type='checkbox' name='keyword_id[]' value='{$rowkey['id']}'>{$rowkey['keyword']}
								</label>
							</div>";
					}
				 ?>
			</div>

			<div class="form-group">
				<label>所在分类</label>
				<select name="lclassify_id">
					<?php 
						foreach ($rowsclass as $rowclass) {
							echo "<option value='{$rowclass['id']}' disabled>{$rowclass['name']}</option>";
							$sqllclass="select lclassify.* from lclassify,bclassify where lclassify.bclassify_id=bclassify.id&&bclassify.id={$rowclass['id']}";
							$smtlclass=$pdo->prepare($sqllclass);
							$smtlclass->execute();
							$rowslclass=$smtlclass->fetchAll();
							foreach ($rowslclass as $rowlclass) {
								echo "<option value='{$rowlclass['id']}'>{$rowlclass['name']}</option>";
							}
						}
					 ?>
				</select>
			</div>

			<div class="form-group">
				<label>所在价格区间</label>
				<?php 
					foreach ($rowsprice as $rowprice) {
						echo "<div class='radio'>
								<label>
									<input type='radio' name='pricesection_id' value='{$rowprice['id']}'>${rowprice['section']}
								</label>
							</div>";
					}
				 ?>
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