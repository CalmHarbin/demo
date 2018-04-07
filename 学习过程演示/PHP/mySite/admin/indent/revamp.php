<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="select * from states";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetchAll();

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
        <h2 class="page-header">修改内容</h2>
		<form action="update.php" method="post">
			<div class="form-group">
				<label for="">订单状态</label>
				<?php 
					foreach ($rows as $row) {
						if($row['id']==$_GET['states']){
							echo "<div class='radio'>
									<label>
										<input type='radio' name='states_id' value='{$row['id']}' checked>{$row['state']}
									</label>
								</div>";
						}else{
							echo "<div class='radio'>
									<label>
										<input type='radio' name='states_id' value='{$row['id']}'>{$row['state']}
									</label>
								</div>";
						}
					}
				 ?>
			</div>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" value="确认修改">
		</form>
    </div>
</body>
</html>