<?php 
include "config.ico.php";
$sql="delete from user where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo true;
}else{
	echo false;
}
 ?>