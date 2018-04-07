<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="select * from bclassify";
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
    	<h2>添加小分类内容</h2>
		<form action="insert.php" method="post">
			<div class="form-group">
				<label >内容</label>
				<input type="text" name="name" class="form-control" required>
			</div>
			<div class="form-group">
				<label>所在大分类</label>
				<select name="bclassify_id">
					<?php 
					foreach ($rows as $row) {
						echo "<option value='{$row['id']}'>{$row['name']}</option>";
					}
					 ?>
				</select>
			</div>
			<input type="submit" value="添加">
			<input type="reset">
		</form>
    </div>
</body>
</html>