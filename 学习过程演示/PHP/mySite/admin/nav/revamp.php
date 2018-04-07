<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="select * from nav where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetch();
$content=$rows['content'];
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
        <h2 class="page-header">修改导航栏内容</h2>
		<form action="update.php" method="post">
			<div class="form-group">
				<label for="">内容</label>
				<input type="text" name="content" value="<?php echo $content; ?>" class="form-control">
			</div>
			<div class="form-group">
				<label for="">url</label>
				<input type="url" name="url" value="<?php echo $url; ?>" >
			</div>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" value="确认修改">
		</form>
    </div>
</body>
</html>