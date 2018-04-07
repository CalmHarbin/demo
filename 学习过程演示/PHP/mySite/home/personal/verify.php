<?php 
if(!$_COOKIE['user']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";

$old=md5($_POST['old']);
$new=md5($_POST['new']);

$sql="select * from user where username='{$_COOKIE['user']}'&&password='{$old}'&&isadmin=0";
$smt=$pdo->prepare($sql);
$smt->execute();
$row=$smt->fetchColumn();
if($row){
	$sqlnew="update user set password='{$new}' where username='{$_COOKIE['user']}'&&isadmin=0";
	$smtnew=$pdo->prepare($sqlnew);
	if($smtnew->execute()){
		echo "<script>alert('修改成功,请重新登录')</script>";
		echo "<script>location.href='../logon.php'</script>";
	}
}else{
	echo "<script>alert('原密码不正确')</script>";
	echo "<script>location.href='../personal.php?page=6'</script>";
}
 ?>