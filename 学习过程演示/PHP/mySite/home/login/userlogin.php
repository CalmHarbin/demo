<?php 
session_start();
include "../../public/common/config.php";
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql="insert into user(username,password,isadmin) values('{$username}','{$password}',0)";
$smt=$pdo->prepare($sql);
	//将字符串中空格去掉
	$str=str_replace(" ", "", $_SESSION["vcode"]);
	//把字符串转小写
	$str_old=strtolower($str);
	$str_new=strtolower($_POST["vcode"]);
	echo $str_old===$str_new;
	if($str_old===$str_new&&$smt->execute()){
		echo "<script>alert('注册成功,请登录!')</script>";
		echo "<script>location.href='../logon.php'</script>";
	}else{
		echo "<script>alert('验证码有误')</script>";
		echo "<script>location.href='../login.php'</script>";
	}
 ?>