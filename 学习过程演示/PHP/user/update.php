<?php 
include "config.ico.php";
//任务开启
$pdo->beginTransaction();
try{
	$sql="update user set username={$_POST['password']} where id={$_POST['id']}";
    $smt=$pdo->prepare($sql);
    $smt->execute();

	$sql="update user set password={$_POST['password']} where id={$_POST['id']}";
	$smt=$pdo->prepare($sql);
	$smt->execute();

	if($pdo->commit()){
	echo "<script>location='index.php'</script>";
	}

}catch(PDOException $err){
	if($pdo->rollBack()){
	echo "<script>location='revamp.php'</script>";
	}
}
 ?>