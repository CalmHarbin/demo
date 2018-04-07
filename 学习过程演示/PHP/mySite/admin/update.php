<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='logon.php'</script>";
	exit;
}
include "../public/common/config.php";
$oldPassword=md5($_POST['oldpassword']);
$sql="select * from user where isadmin=1&&username='{$_SESSION['username']}'&&password='{$oldPassword}'";
$smt=$pdo->prepare($sql);
$smt->execute();
$row=$smt->fetchColumn();
if($row){
	$newPassword=md5($_POST['newpassword']);
	$sql="update user set password='{$newPassword}' where isadmin=1&&username='{$_SESSION['username']}'&&password='{$oldPassword}'";
	$smt=$pdo->prepare($sql);
	if($smt->execute()){
		echo "<script>location.href='index/exit.php'</script>";
	}
}else{
	echo "<script>alert('原密码有误')</script>";
	echo "<script>location.href='amend.php'</script>";
}
 ?>