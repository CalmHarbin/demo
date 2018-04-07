<?php 
if(!$_COOKIE['user']){
	echo "<script>location.href='/mySite/home/logon.php'</script>";
	exit;
}
include '../../public/common/config.php';
$sql="delete from shopping where id={$_GET['shopping_id']}";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo true;
}else{
	echo false;
}
 ?>