<?php 
$pdo=new PDO('mysql:host=localhost;dbname=test','root','123');
$pdo->exec('set names utf8');
$sql="delete from user where id={$_GET['id']}";
$smt=$pdo->prepare($sql);
if($smt->execute()){
	echo 1;
}
 ?>