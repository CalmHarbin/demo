<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="select * from advertising where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetch();
$isshow=$rows['isshow'];
$place=$rows['place'];
$url=$rows['url'];
$id=$_GET['id'];
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
        <h2 class="page-header">修改状态</h2>
		<form action="update.php" method="post">
			<div class="form-group">
				<label >广告状态</label>
				<div class="radio">
					<label>
						<input type="radio" value="1" name="isshow" <?php if($isshow) echo "checked='checked'"; ?> >显示
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" value="0" name="isshow" <?php if(!$isshow) echo "checked='checked'"; ?> >不显示
					</label>
				</div>
			</div>
			<div class="form-group">
				<label>修改链接</label>
				<input type="url" name="url" value="<?php echo $url; ?>">
			</div>
			<div class="form-group">
				<label >修改位置</label>
				<select name="place" class="from-control">
					<option value="1" <?php if($place==1) echo 'selected'; ?> >1号位</option>
					<option value="2" <?php if($place==2) echo 'selected'; ?>>2号位</option>
					<option value="3" <?php if($place==3) echo 'selected'; ?>>3号位</option>
					<option value="4" <?php if($place==4) echo 'selected'; ?>>4号位</option>
					<option value="5" <?php if($place==5) echo 'selected'; ?>>5号位</option>
					<option value="6" <?php if($place==6) echo 'selected'; ?>>6号位</option>
					<option value="7" <?php if($place==7) echo 'selected'; ?>>7号位</option>
				</select>
			</div>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" value="确认修改">
		</form>
    </div>
</body>
</html>