<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="select isshow from carousel where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetch();
$isshow=$rows['isshow'];
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
				<input type="hidden" name="id" value="<?php echo $id; ?>">
			</div>
			<input type="submit" value="确认修改">
		</form>
    </div>
</body>
</html>