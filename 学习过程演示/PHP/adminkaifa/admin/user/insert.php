<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../public/config.ico.php";
$username=$_POST['username'];
$password=$_POST['password'];
echo $username;
echo $password;
$sql="insert into user(username,password) values('{$username}','{$password}')";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo "<script>location.href='select.php'</script>";
}
 ?>