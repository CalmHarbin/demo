<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$keyword=$_POST['keyword'];
$sql="insert into keywords(keyword,frequency) values('{$keyword}',0)";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo "<script>location.href='select.php'</script>";
}
 ?>