<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";

$sql="update carousel set isshow='{$_POST['isshow']}' where id={$_POST['id']}";
$smt=$pdo->prepare($sql);

if($smt->execute()){
	echo "<script>location.href='select.php'</script>";
}else{
	echo "<script>alert('修改失败')</script>";
	echo "<script>location.href='revamp.php'</script>";
}
 ?>