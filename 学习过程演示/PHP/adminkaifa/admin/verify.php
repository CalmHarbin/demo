<?php 
session_start();//开启session
include "public/config.ico.php";
$sql="select * from admin";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetchAll();
$num=0;
foreach ($rows as $value){
	var_dump($_POST['username']==$value['username']);
	var_dump($_POST['password']==$value['password']);
	if($_POST['username']==$value['username']&&$_POST['password']==$value['password']){
		$_SESSION["username"]=$_POST['username'];
		echo "<script>location.href='index.php'</script>";
	}else{
		$num++;
	}
	if($num==count($rows)){
		echo "<script>location.href='logon.php'</script>";
	}
}
 ?>