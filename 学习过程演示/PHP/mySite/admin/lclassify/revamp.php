<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";

$sqlB="select * from bclassify";
$smtB=$pdo->prepare($sqlB);
$smtB->execute();
$rowsB=$smtB->fetchAll();

$sql="select lclassify.*,bclassify.name bname from lclassify,bclassify where lclassify.bclassify_id=bclassify.id&&lclassify.id={$_GET['id']}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetch();
$name=$rows['name'];
$bname=$rows['bname'];
$id=$_GET['id'];
echo $bname;

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
        <h2 class="page-header">修改内容</h2>
		<form action="update.php" method="post">
			<div class="form-group">
				<label for="">内容</label>
				<input type="text" name="name" value="<?php echo $name; ?>" class="form-control">
			</div>
			<div class="form-group">
				<label>所在大分类</label>
				<select name="bclassify_id">
					<?php 
					foreach ($rowsB as $rowB) {
						if($bname==$rowB['name']){
							echo "<option value='{$rowB['id']}' selected>{$rowB['name']}</option>";
						}else{
							echo "<option value='{$rowB['id']}'>{$rowB['name']}</option>";
						}
					}
					 ?>
				</select>
			</div>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" value="确认修改">
		</form>
    </div>
</body>
</html>