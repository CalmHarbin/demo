<?php 
if(!$_COOKIE['user']){
	echo "<script>location.href='/mySite/home/logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="delete from address where id={$_GET['address_id']}";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo 1;
}else{
	echo 0;
}
 ?>