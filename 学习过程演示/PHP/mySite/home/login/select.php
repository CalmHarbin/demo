<?php 
include "../../public/common/config.php";

$sql="select * from user where username='{$_GET['username']}'&&isadmin=0";
$smt=$pdo->prepare($sql);
$smt->execute();
$row=$smt->fetchColumn();
if($row){
	echo true;
}else{
	echo false;
}
 ?>