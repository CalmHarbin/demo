<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";

	$sql="update pricesection set section='{$_POST['section']}' where id={$_POST['id']}";
	$smt=$pdo->prepare($sql);
	if($smt->execute()){
	echo "<script>location.href='select.php'</script>";
}
 ?>