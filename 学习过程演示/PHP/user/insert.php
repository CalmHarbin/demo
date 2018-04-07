<?php 
include "config.ico.php";
$sql="insert into user(username,password) values('{$_POST['username']}','{$_POST['password']}')";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo "<script>location='index.php'</script>";
}
 ?>