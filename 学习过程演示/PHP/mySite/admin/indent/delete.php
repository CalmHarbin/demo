<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="delete from indent where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	$sqlmessage="delete from message where id={$_GET['message_id']}";
	$smtmessage=$pdo->prepare($sqlmessage);
	if($smtmessage->execute()){
		echo 1;
	}else{
		echo 0;
	}
}else{
	echo 0;
}
 ?>