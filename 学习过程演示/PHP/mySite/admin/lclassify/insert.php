<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$name=$_POST['name'];
$bclassify_id=$_POST['bclassify_id'];
$sql="insert into lclassify(name,bclassify_id) values('{$name}',{$bclassify_id})";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo "<script>location.href='select.php'</script>";
}
 ?>