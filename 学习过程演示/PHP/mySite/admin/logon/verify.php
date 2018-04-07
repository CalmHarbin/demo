<?php 
include "../../public/common/config.php";
session_start();
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql="select * from user where isadmin='1'&&username='{$username}'&&password='{$password}'";
$smt=$pdo->prepare($sql);
$smt->execute();
$row=$smt->fetchColumn();
if($row){
	//将字符串中空格去掉
	$str=str_replace(" ", "", $_SESSION["vcode"]);
	//把字符串转小写
	$str_old=strtolower($str);
	$str_new=strtolower($_POST["vcode"]);
	echo $str_old===$str_new;
	if($str_old===$str_new){
		$_SESSION["username"]=$username;
		echo "<script>location.href='../index.php'</script>";
	}else{
		echo "<script>alert('验证码有误')</script>";
		echo "<script>location.href='../logon.php'</script>";
	}
}else{
	echo "<script>alert('用户名或密码错误')</script>";
	echo "<script>location.href='../logon.php'</script>";
}
 ?>