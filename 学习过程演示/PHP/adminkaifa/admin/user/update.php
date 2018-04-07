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
	$sql="update user set username='{$_POST['username']}' where id={$_POST['id']}";
    $smt=$pdo->prepare($sql);
    $smt->execute();

	$sql="update user set password='{$_POST['password']}' where id={$_POST['id']}";
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