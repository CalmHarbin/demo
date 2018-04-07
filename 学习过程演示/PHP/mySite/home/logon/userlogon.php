<?php 
session_start();
include "../../public/common/config.php";
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql="select * from user where isadmin='0'&&username='{$username}'&&password='{$password}'";
$smt=$pdo->prepare($sql);
$smt->execute();
$rowid=$smt->fetch();
if($rowid){
	//将字符串中空格去掉
	$str=str_replace(" ", "", $_SESSION["vcode"]);
	//把字符串转小写
	$str_old=strtolower($str);
	$str_new=strtolower($_POST["vcode"]);
	if($str_old===$str_new){
		setcookie("user","{$username}",0,"/");

		$sqldatum="select * from datum where user_id={$rowid['id']}";
		$smtdatum=$pdo->prepare($sqldatum);
		$smtdatum->execute();
		$rowdatum=$smtdatum->fetchColumn();
		if(!$rowdatum){
			//第一次登录则创建自己的信息
			$sqlinfo="insert into datum(img,sex,award,phone,QQ,birthday,address,user_id) values('',1,0,0,0,0,'',{$rowid['id']})";
			$smtinfo=$pdo->prepare($sqlinfo);
			$smtinfo->execute();
		}
		if($_COOKIE['url']){
			echo "<script>location.href='{$_COOKIE['url']}'</script>";
		}else{
			echo "<script>location.href='../personal.php'</script>";
		}
	}else{
		echo "<script>alert('验证码有误')</script>";
		echo "<script>location.href='../logon.php'</script>";
	}
}else{
	echo "<script>alert('用户名或密码错误')</script>";
	echo "<script>location.href='../logon.php'</script>";
}
 ?>