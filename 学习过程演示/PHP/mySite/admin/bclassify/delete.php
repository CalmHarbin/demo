<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="delete from bclassify where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo 1;
}else{
	echo 0;
}
 ?>