<?php 
if(!$_COOKIE['user']){
	echo "<script>location.href='/mySite/home/logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
$sql="insert into address(name,phone,address,user_id,isdefault) values('{$_POST['name']}',{$_POST['phone']},'{$_POST['address']}',{$_POST['user_id']},0)";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo "<script>location.href='../personal.php?page=5'</script>";
}else{
	echo "<script>history.back();</script>";
}
 ?>