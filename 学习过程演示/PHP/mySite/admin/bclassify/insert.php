<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$name=$_POST['name'];
$sql="insert into bclassify(name) values('{$name}')";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo "<script>location.href='select.php'</script>";
}
 ?>