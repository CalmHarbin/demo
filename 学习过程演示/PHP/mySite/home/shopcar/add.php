<?php 
if(!$_COOKIE['user']){
	echo "<script>location.href='/mySite/home/logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sqlid="select * from user where username='{$_COOKIE['user']}'";
$smtid=$pdo->prepare($sqlid);
$smtid->execute();
$rowid=$smtid->fetch();
$j=0;
for($i=0;$i<$_GET['num'];$i++){
	$sql="insert into shopping(user_id,shop_id) values({$rowid['id']},{$_GET['shop_id']})";
	$smt=$pdo->prepare($sql);
	if($smt->execute()){
		$j++;
	}
}
if($j==$_GET['num']){
		echo 1;
	}else{
		echo 0;
	}
 ?>