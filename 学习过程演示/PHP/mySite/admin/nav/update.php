<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
//任务开启
$pdo->beginTransaction();
try{
	$sql="update nav set content='{$_POST['content']}' where id={$_POST['id']}";
    $smt=$pdo->prepare($sql);
    $smt->execute();

	$sql="update nav set url='{$_POST['url']}' where id={$_POST['id']}";
	$smt=$pdo->prepare($sql);
	$smt->execute();

	if($pdo->commit()){
	echo "<script>location.href='select.php'</script>";
	}
}catch(PDOException $err){
	if($pdo->rollBack()){
	echo "<script>location.href='revamp.php'</script>";
	}
}
 ?>